<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Customer list with lifetime value.
     */
    public function index(Request $request): View
    {
        $query = Customer::query()->orderBy('name');

        if ($search = $request->query('q')) {
            $query->where(function ($inner) use ($search): void {
                $inner->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%");
            });
        }

        $customers = $query->get();

        $spend = Order::query()->paid()
            ->get()
            ->groupBy('customer_email')
            ->map(fn ($orders) => (float) $orders->sum('amount'));

        return view('admin.customers.index', [
            'customers' => $customers,
            'spend' => $spend,
            'totals' => [
                'all' => Customer::query()->count(),
                'active' => Customer::query()->where('status', 'active')->count(),
                'leads' => Customer::query()->where('status', 'lead')->count(),
                'value' => (float) Order::query()->paid()->sum('amount'),
            ],
        ]);
    }

    /**
     * Create a customer.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190', 'unique:customers,email'],
            'phone' => ['nullable', 'string', 'max:60'],
            'company' => ['nullable', 'string', 'max:120'],
            'status' => ['required', 'in:active,lead,churned'],
        ]);

        Customer::create($data + ['last_active_on' => now()->toDateString()]);

        Activity::record('customer.created', 'Customer '.$data['name'].' added');

        return redirect()->route('admin.customers.index')->with('status', 'Customer created.');
    }

    /**
     * Update a customer.
     */
    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190', 'unique:customers,email,'.$customer->id],
            'phone' => ['nullable', 'string', 'max:60'],
            'company' => ['nullable', 'string', 'max:120'],
            'status' => ['required', 'in:active,lead,churned'],
        ]);

        $customer->update($data);

        Activity::record('customer.updated', 'Customer '.$data['name'].' updated');

        return back()->with('status', 'Customer updated.');
    }

    /**
     * Delete a customer.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();

        Activity::record('customer.deleted', 'Customer deleted');

        return redirect()->route('admin.customers.index')->with('status', 'Customer deleted.');
    }
}
