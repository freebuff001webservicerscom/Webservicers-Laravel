<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketsController extends Controller
{
    /**
     * The customer's support tickets, newest activity first.
     */
    public function index(Request $request): View
    {
        $mine = $request->user()->tickets();

        return view('dashboard.tickets.index', [
            'tickets' => (clone $mine)
                ->withCount('replies')
                ->orderByDesc('last_message_at')
                ->orderByDesc('id')
                ->paginate(10),
            'stats' => [
                'total' => (clone $mine)->count(),
                'open' => (clone $mine)->whereIn('status', ['open', 'pending'])->count(),
                'resolved' => (clone $mine)->where('status', 'resolved')->count(),
            ],
            'statuses' => Ticket::STATUSES,
            'priorities' => Ticket::PRIORITIES,
        ]);
    }

    /**
     * Open a new ticket with its first message.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'subject' => ['required', 'string', 'max:160'],
            'body' => ['required', 'string', 'max:4000'],
            'priority' => ['required', 'in:low,normal,high'],
        ]);

        $ticket = DB::transaction(function () use ($data, $request): Ticket {
            $ticket = Ticket::create([
                'user_id' => $request->user()->id,
                'subject' => $data['subject'],
                'priority' => $data['priority'],
                'status' => 'open',
                'last_message_at' => now(),
            ]);

            $ticket->replies()->create([
                'user_id' => $request->user()->id,
                'body' => $data['body'],
            ]);

            return $ticket;
        });

        Activity::record('ticket.created', 'Ticket "'.$ticket->subject.'" opened');

        return redirect()->route('dashboard.tickets.show', $ticket)->with('status', 'Ticket opened — we typically reply within one working day.');
    }

    /**
     * One ticket's conversation thread.
     */
    public function show(Request $request, Ticket $ticket): View
    {
        $this->authorizeTicket($request, $ticket);

        return view('dashboard.tickets.show', [
            'ticket' => $ticket,
            'replies' => $ticket->replies()->with('user')->get(),
        ]);
    }

    /**
     * Append the customer's reply to a ticket.
     */
    public function reply(Request $request, Ticket $ticket): RedirectResponse
    {
        $this->authorizeTicket($request, $ticket);

        $data = $request->validate([
            'body' => ['required', 'string', 'max:4000'],
        ]);

        $ticket->replies()->create([
            'user_id' => $request->user()->id,
            'body' => $data['body'],
        ]);

        $ticket->update(['last_message_at' => now()]);

        return back()->with('status', 'Reply added to the ticket.');
    }

    /**
     * Tickets belong to the signed-in customer; anyone else 404s.
     */
    private function authorizeTicket(Request $request, Ticket $ticket): void
    {
        abort_unless($ticket->user_id === $request->user()->id, 404);
    }
}
