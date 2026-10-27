<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\WalletEntry;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     * Account balance (the sum of the wallet ledger) plus its history.
     */
    public function index(Request $request): View
    {
        $entries = WalletEntry::query()
            ->where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(12);

        $ledger = WalletEntry::query()->where('user_id', $request->user()->id);

        return view('dashboard.balance', [
            'entries' => $entries,
            'balance' => (float) (clone $ledger)->sum('amount'),
            'credited' => (float) (clone $ledger)->where('amount', '>', 0)->sum('amount'),
            'spent' => (float) (clone $ledger)->where('amount', '<', 0)->sum('amount'),
        ]);
    }
}
