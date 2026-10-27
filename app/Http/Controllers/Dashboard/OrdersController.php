<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * The customer's orders with a small account summary.
     */
    public function index(Request $request): View
    {
        $email = $request->user()->email;

        $orders = Order::query()
            ->where('customer_email', $email)
            ->latest('placed_on')
            ->latest('id')
            ->paginate(10);

        $stats = [
            'total' => Order::query()->where('customer_email', $email)->count(),
            'active' => Order::query()->where('customer_email', $email)->whereIn('status', ['pending', 'paid', 'in_progress'])->count(),
            'completed' => Order::query()->where('customer_email', $email)->where('status', 'completed')->count(),
            'value' => Order::query()->where('customer_email', $email)->paid()->sum('amount'),
        ];

        return view('dashboard.orders.index', [
            'orders' => $orders,
            'stats' => $stats,
        ]);
    }

    /**
     * The conversation attached to one of the customer's orders.
     */
    public function chat(Request $request, Order $order): View
    {
        $this->authorizeOrder($request, $order);

        return view('dashboard.orders.chat', [
            'order' => $order,
            'messages' => $order->messages()->with('user')->orderBy('created_at')->get(),
        ]);
    }

    /**
     * Append the customer's message to the order conversation.
     */
    public function sendChat(Request $request, Order $order): RedirectResponse
    {
        $this->authorizeOrder($request, $order);

        $data = $request->validate([
            'body' => ['required', 'string', 'max:4000'],
        ]);

        $order->messages()->create([
            'user_id' => $request->user()->id,
            'body' => $data['body'],
        ]);

        return redirect()->route('dashboard.orders.chat', $order)->with('status', 'Message sent — our team will reply here.');
    }

    /**
     * Orders belong to the signed-in customer by email; anyone else 404s.
     */
    private function authorizeOrder(Request $request, Order $order): void
    {
        abort_unless($order->customer_email === $request->user()->email, 404);
    }
}
