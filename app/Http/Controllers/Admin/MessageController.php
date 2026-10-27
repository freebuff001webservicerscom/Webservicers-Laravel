<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Online store → Contact messages (full table).
     */
    public function index(): View
    {
        return view('admin.messages.index', [
            'messages' => ContactMessage::query()->latest()->get(),
            'totals' => [
                'all' => ContactMessage::query()->count(),
                'new' => ContactMessage::query()->unread()->count(),
                'replied' => ContactMessage::query()->where('status', 'replied')->count(),
            ],
        ]);
    }

    /**
     * Communication → Customer inbox (conversation-style view).
     */
    public function inbox(Request $request): View
    {
        $messages = ContactMessage::query()->latest()->get();

        $activeId = $request->query('id');
        $active = $messages->firstWhere('id', $activeId) ?? $messages->first();

        if ($active && $active->status === 'new') {
            $active->update(['status' => 'read']);
            $active->refresh();
        }

        return view('admin.inbox.index', [
            'messages' => $messages,
            'active' => $active,
        ]);
    }

    /**
     * Mark a message read / replied.
     */
    public function update(Request $request, ContactMessage $message): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:new,read,replied'],
        ]);

        $message->update(['status' => $request->input('status')]);

        Activity::record('message.status', 'Message from '.$message->name.' marked '.$request->input('status'));

        return back()->with('status', 'Message updated.');
    }

    /**
     * Delete a message.
     */
    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        Activity::record('message.deleted', 'Message deleted');

        return back()->with('status', 'Message deleted.');
    }
}
