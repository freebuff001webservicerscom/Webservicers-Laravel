<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Customer;
use App\Models\Notice;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Order list with stats and filters.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status');

        $query = Order::query()->latest('placed_on')->latest('id');

        if (is_string($status) && $status !== '' && $status !== 'all') {
            $query->where('status', $status);
        }

        if ($search = $request->query('q')) {
            $query->where(function ($inner) use ($search): void {
                $inner->where('reference', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        return view('admin.orders.index', [
            'orders' => $query->paginate(15)->withQueryString(),
            'status' => $status ?: 'all',
            'statuses' => ['pending', 'paid', 'in_progress', 'completed', 'cancelled', 'refunded'],
            'totals' => [
                'all' => Order::query()->count(),
                'revenue' => (float) Order::query()->paid()->sum('amount'),
                'pending' => Order::query()->where('status', 'pending')->count(),
                'completed' => Order::query()->where('status', 'completed')->count(),
            ],
        ]);
    }

    /**
     * Create an order (the "+ New order" button).
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'customer_email' => ['required', 'email', 'max:190'],
            'service' => ['nullable', 'string', 'max:80'],
            'amount' => ['required', 'numeric', 'min:0', 'max:999999'],
            'status' => ['required', 'in:pending,paid,in_progress,completed'],
        ]);

        $highest = (int) Order::query()->max('id');
        $reference = 'WS-'.(1043 + $highest);

        $order = Order::create($data + [
            'reference' => $reference,
            'placed_on' => now()->toDateString(),
        ]);

        Customer::firstOrCreate(
            ['email' => $data['customer_email']],
            ['name' => $data['customer_name'], 'status' => 'lead', 'last_active_on' => now()->toDateString()],
        );

        Activity::record('order.created', "Order {$order->reference} created");

        if (Setting::enabled('notify_new_orders', true)) {
            Notice::create([
                'title' => "New order {$order->reference}",
                'body' => $order->service.' for '.$order->customer_name.' — $'.number_format((float) $order->amount, 2).'.',
                'kind' => 'order',
            ]);
        }

        return redirect()
            ->route('admin.orders.index')
            ->with('status', "Order {$order->reference} created.");
    }

    /**
     * Change an order's status (the row status select).
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,paid,in_progress,completed,cancelled,refunded'],
        ]);

        $order->update(['status' => $request->input('status')]);

        Activity::record('order.status', "{$order->reference} marked ".$request->input('status'));

        return back()->with('status', "{$order->reference} updated.");
    }

    /**
     * Delete an order.
     */
    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        Activity::record('order.deleted', 'Order deleted');

        return redirect()->route('admin.orders.index')->with('status', 'Order deleted.');
    }
}
