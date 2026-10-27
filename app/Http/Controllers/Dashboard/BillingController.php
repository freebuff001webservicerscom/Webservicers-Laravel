<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    /**
     * The customer's invoices with a small billing summary.
     */
    public function index(Request $request): View
    {
        $invoices = $request->user()->invoices()
            ->orderByDesc('issued_on')
            ->paginate(10);

        $open = Invoice::query()->where('user_id', $request->user()->id)->open();

        return view('dashboard.billing.index', [
            'invoices' => $invoices,
            'stats' => [
                'open' => (float) (clone $open)->sum('amount'),
                'paid' => (float) Invoice::query()->where('user_id', $request->user()->id)->where('status', 'paid')->sum('amount'),
                'unpaid' => (clone $open)->count(),
                'total' => Invoice::query()->where('user_id', $request->user()->id)->count(),
            ],
        ]);
    }

    /**
     * A printable invoice belonging to the signed-in customer.
     */
    public function show(Request $request, Invoice $invoice): View
    {
        abort_unless($invoice->user_id === $request->user()->id, 404);

        return view('dashboard.billing.show', [
            'invoice' => $invoice->load('order'),
            'user' => $request->user(),
        ]);
    }
}
