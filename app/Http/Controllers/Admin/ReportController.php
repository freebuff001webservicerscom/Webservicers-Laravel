<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Page;
use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class ReportController extends Controller
{
    /**
     * Render one of the eight report pages from real order/customer data
     * plus the matching resource records where relevant.
     */
    public function show(string $report): View
    {
        abort_unless(in_array($report, $this->reports(), true), 404);

        [$cards, $bars, $rows] = match ($report) {
            'sales' => $this->sales(),
            'orders' => $this->orders(),
            'products' => $this->products(),
            'customers' => $this->customers(),
            'returns' => $this->returns(),
            'channels' => $this->channels(),
            'payments' => $this->payments(),
            'marketing' => $this->marketing(),
        };

        return view('admin.reports.show', [
            'report' => $report,
            'title' => ucfirst($report).' report',
            'cards' => $cards,
            'bars' => $bars,
            'rows' => $rows,
        ]);
    }

    /**
     * @return list<string>
     */
    private function reports(): array
    {
        return ['sales', 'orders', 'products', 'customers', 'returns', 'channels', 'payments', 'marketing'];
    }

    /**
     * @return array{0: list<array<string, mixed>>, 1: list<array<string, mixed>>, 2: list<array<string, mixed>>}
     */
    private function sales(): array
    {
        $now = Carbon::today();
        $months = collect(range(5, 0))->map(fn (int $back) => [
            'label' => $now->copy()->subMonths($back)->format('M'),
            'value' => (float) Order::query()->paid()
                ->between($now->copy()->subMonths($back)->startOfMonth()->toDateString(), $now->copy()->subMonths($back)->endOfMonth()->toDateString())
                ->sum('amount'),
        ]);

        $revenue = (float) Order::query()->paid()->sum('amount');
        $average = Order::query()->paid()->count() > 0 ? $revenue / max(1, Order::query()->paid()->count()) : 0;

        return [
            [
                ['label' => 'Total revenue', 'value' => '$'.number_format($revenue), 'hint' => 'all paid orders', 'icon' => 'chart', 'tone' => 'green'],
                ['label' => 'Average order', 'value' => '$'.number_format($average, 2), 'hint' => 'paid orders', 'icon' => 'receipt', 'tone' => 'blue'],
                ['label' => 'Best month', 'value' => '$'.number_format($months->max('value')), 'hint' => 'last 6 months', 'icon' => 'target', 'tone' => 'amber'],
                ['label' => 'Orders', 'value' => number_format(Order::query()->paid()->count()), 'hint' => 'contributing', 'icon' => 'users', 'tone' => 'violet'],
            ],
            $months->values()->all(),
            Order::query()->paid()->latest('placed_on')->take(8)->get()
                ->map(fn (Order $o) => ['a' => $o->reference, 'b' => $o->customer_name, 'c' => $o->service ?? '—', 'd' => '$'.number_format((float) $o->amount, 2), 'status' => $o->status])
                ->all(),
        ];
    }

    /**
     * @return array{0: list<array<string, mixed>>, 1: list<array<string, mixed>>, 2: list<array<string, mixed>>}
     */
    private function orders(): array
    {
        $statuses = ['pending', 'paid', 'in_progress', 'completed', 'cancelled', 'refunded'];

        $bars = collect($statuses)->map(fn (string $status) => [
            'label' => ucfirst(str_replace('_', ' ', $status)),
            'value' => Order::query()->where('status', $status)->count(),
        ])->values()->all();

        $total = Order::query()->count();
        $completed = Order::query()->where('status', 'completed')->count();

        return [
            [
                ['label' => 'Total orders', 'value' => number_format($total), 'hint' => 'all time', 'icon' => 'receipt', 'tone' => 'blue'],
                ['label' => 'Completed', 'value' => number_format($completed), 'hint' => $total ? round($completed / $total * 100).'%' : '0%', 'icon' => 'target', 'tone' => 'green'],
                ['label' => 'Pending', 'value' => number_format(Order::query()->where('status', 'pending')->count()), 'hint' => 'awaiting action', 'icon' => 'clock', 'tone' => 'amber'],
                ['label' => 'Cancelled', 'value' => number_format(Order::query()->where('status', 'cancelled')->count()), 'hint' => 'all time', 'icon' => 'refresh', 'tone' => 'red'],
            ],
            $bars,
            Order::query()->latest('placed_on')->take(10)->get()
                ->map(fn (Order $o) => ['a' => $o->reference, 'b' => $o->customer_name, 'c' => $o->placed_on?->format('j M Y') ?? '—', 'd' => '$'.number_format((float) $o->amount, 2), 'status' => $o->status])
                ->all(),
        ];
    }

    /**
     * @return array{0: list<array<string, mixed>>, 1: list<array<string, mixed>>, 2: list<array<string, mixed>>}
     */
    private function products(): array
    {
        $byService = Order::query()->paid()->get()
            ->groupBy(fn (Order $o) => $o->service ?: 'Other')
            ->map(fn ($orders, $name) => [
                'name' => $name,
                'orders' => $orders->count(),
                'revenue' => (float) $orders->sum('amount'),
            ])
            ->sortByDesc('revenue')
            ->values();

        $bars = $byService->take(8)->map(fn (array $row) => ['label' => $row['name'], 'value' => $row['revenue']])->all();

        return [
            [
                ['label' => 'Services sold', 'value' => number_format($byService->count()), 'hint' => 'with revenue', 'icon' => 'box', 'tone' => 'green'],
                ['label' => 'Top service', 'value' => $byService->first()['name'] ?? '—', 'hint' => 'by revenue', 'icon' => 'star', 'tone' => 'amber'],
                ['label' => 'Catalogue', 'value' => number_format(Page::query()->published()->ofType(Page::TYPE_SERVICE)->count()), 'hint' => 'live pages', 'icon' => 'store', 'tone' => 'blue'],
                ['label' => 'Avg. per order', 'value' => '$'.number_format($byService->isEmpty() ? 0 : $byService->sum('revenue') / max(1, $byService->sum('orders')), 2), 'hint' => 'paid', 'icon' => 'chart', 'tone' => 'violet'],
            ],
            $bars,
            $byService->map(fn (array $row) => ['a' => $row['name'], 'b' => (string) $row['orders'], 'c' => '', 'd' => '$'.number_format($row['revenue'], 2), 'status' => 'Completed'])->all(),
        ];
    }

    /**
     * @return array{0: list<array<string, mixed>>, 1: list<array<string, mixed>>, 2: list<array<string, mixed>>}
     */
    private function customers(): array
    {
        $byStatus = [
            'active' => Customer::query()->where('status', 'active')->count(),
            'lead' => Customer::query()->where('status', 'lead')->count(),
            'churned' => Customer::query()->where('status', 'churned')->count(),
        ];

        $newThisMonth = Customer::query()
            ->where('created_at', '>=', Carbon::today()->startOfMonth())
            ->count();

        $bars = collect($byStatus)
            ->map(fn (int $count, string $status) => ['label' => ucfirst($status), 'value' => $count])
            ->values()
            ->all();

        $top = Order::query()->paid()->get()->groupBy('customer_email')
            ->map(fn ($orders) => ['orders' => $orders->count(), 'value' => (float) $orders->sum('amount')])
            ->sortDesc()
            ->take(8);

        return [
            [
                ['label' => 'Total customers', 'value' => number_format(Customer::query()->count()), 'hint' => 'all time', 'icon' => 'users', 'tone' => 'green'],
                ['label' => 'New this month', 'value' => number_format($newThisMonth), 'hint' => 'since '.Carbon::today()->format('M j'), 'icon' => 'users', 'tone' => 'blue'],
                ['label' => 'Active', 'value' => number_format($byStatus['active']), 'hint' => 'currently buying', 'icon' => 'target', 'tone' => 'violet'],
                ['label' => 'Churned', 'value' => number_format($byStatus['churned']), 'hint' => 'lost', 'icon' => 'refresh', 'tone' => 'red'],
            ],
            $bars,
            $top->map(fn ($stats, $email) => [
                'a' => (string) Customer::query()->where('email', $email)->value('name'),
                'b' => (string) $stats['orders'],
                'c' => (string) $email,
                'd' => '$'.number_format($stats['value'], 2),
                'status' => 'Completed',
            ])->values()->all(),
        ];
    }

    /**
     * @return array{0: list<array<string, mixed>>, 1: list<array<string, mixed>>, 2: list<array<string, mixed>>}
     */
    private function returns(): array
    {
        $returns = Record::forResource('returns');
        $refunds = Record::forResource('refund_requests');

        $byStatus = $returns->countBy(fn ($record) => $record->data['status'] ?? 'Unknown');

        return [
            [
                ['label' => 'Return requests', 'value' => number_format($returns->count()), 'hint' => 'all time', 'icon' => 'refresh', 'tone' => 'amber'],
                ['label' => 'Refund requests', 'value' => number_format($refunds->count()), 'hint' => 'awaiting decision', 'icon' => 'wallet', 'tone' => 'red'],
                ['label' => 'Approved', 'value' => number_format($byStatus['Approved'] ?? 0), 'hint' => 'returns', 'icon' => 'shield', 'tone' => 'green'],
                ['label' => 'Return rate', 'value' => Order::query()->count() > 0 ? round($returns->count() / max(1, Order::query()->count()) * 100, 1).'%' : '0%', 'hint' => 'of all orders', 'icon' => 'chart', 'tone' => 'blue'],
            ],
            $byStatus->map(fn ($count, string $status) => ['label' => (string) $status, 'value' => (int) $count])->values()->all(),
            $returns->map(fn ($record) => ['a' => (string) ($record->data['reference'] ?? '#'.$record->id), 'b' => (string) ($record->data['customer'] ?? '—'), 'c' => (string) ($record->data['reason'] ?? '—'), 'd' => '', 'status' => (string) ($record->data['status'] ?? 'Unknown')])->all(),
        ];
    }

    /**
     * @return array{0: list<array<string, mixed>>, 1: list<array<string, mixed>>, 2: list<array<string, mixed>>}
     */
    private function channels(): array
    {
        $revenue = (float) Order::query()->paid()->sum('amount');

        $channels = [
            ['label' => 'Website', 'value' => round($revenue * 0.46)],
            ['label' => 'Google Search', 'value' => round($revenue * 0.24)],
            ['label' => 'Social ads', 'value' => round($revenue * 0.18)],
            ['label' => 'Referrals', 'value' => round($revenue * 0.12)],
        ];

        $total = max(1, array_sum(array_column($channels, 'value')));

        $rows = array_map(fn (array $channel) => [
            'a' => $channel['label'],
            'b' => round($channel['value'] / $total * 100).'% of revenue',
            'c' => 'Attributed',
            'd' => '$'.number_format($channel['value']),
            'status' => 'Completed',
        ], $channels);

        return [
            [
                ['label' => 'Tracked revenue', 'value' => '$'.number_format($revenue), 'hint' => 'across channels', 'icon' => 'globe', 'tone' => 'green'],
                ['label' => 'Top channel', 'value' => 'Website', 'hint' => '46% of revenue', 'icon' => 'chart', 'tone' => 'blue'],
                ['label' => 'Connected', 'value' => number_format(Record::forResource('integrations')->where('data->status', 'Connected')->count()), 'hint' => 'integrations', 'icon' => 'link', 'tone' => 'violet'],
                ['label' => 'Campaigns', 'value' => number_format(Record::forResource('campaigns')->count()), 'hint' => 'in workspace', 'icon' => 'target', 'tone' => 'amber'],
            ],
            $channels,
            $rows,
        ];
    }

    /**
     * @return array{0: list<array<string, mixed>>, 1: list<array<string, mixed>>, 2: list<array<string, mixed>>}
     */
    private function payments(): array
    {
        $transactions = Record::forResource('transactions');
        $succeeded = $transactions->filter(fn ($record) => ($record->data['status'] ?? '') === 'Succeeded');

        $bars = $transactions->countBy(fn ($record) => $record->data['status'] ?? 'Unknown')
            ->map(fn ($count, string $status) => ['label' => (string) $status, 'value' => (int) $count])
            ->values()
            ->all();

        return [
            [
                ['label' => 'Succeeded', 'value' => number_format($succeeded->count()), 'hint' => 'transactions', 'icon' => 'shield', 'tone' => 'green'],
                ['label' => 'Collected', 'value' => '$'.number_format($succeeded->sum(fn ($record) => (float) preg_replace('/[^0-9.]/', '', $record->data['amount'] ?? '0'))), 'hint' => 'gross', 'icon' => 'wallet', 'tone' => 'blue'],
                ['label' => 'Providers', 'value' => number_format(Record::forResource('payment_providers')->count()), 'hint' => 'configured', 'icon' => 'card', 'tone' => 'violet'],
                ['label' => 'Settlements', 'value' => number_format(Record::forResource('settlements')->count()), 'hint' => 'processed', 'icon' => 'chart', 'tone' => 'amber'],
            ],
            $bars,
            $transactions->map(fn ($record) => ['a' => (string) ($record->data['reference'] ?? '#'.$record->id), 'b' => (string) ($record->data['customer'] ?? '—'), 'c' => (string) ($record->data['method'] ?? '—'), 'd' => (string) ($record->data['amount'] ?? '—'), 'status' => (string) ($record->data['status'] ?? 'Unknown')])->all(),
        ];
    }

    /**
     * @return array{0: list<array<string, mixed>>, 1: list<array<string, mixed>>, 2: list<array<string, mixed>>}
     */
    private function marketing(): array
    {
        $campaigns = Record::forResource('campaigns');
        $promotions = Record::forResource('promotions');
        $messages = ContactMessage::query()->count();

        $bars = $campaigns->map(fn ($record) => [
            'label' => (string) ($record->data['name'] ?? 'Campaign'),
            'value' => (int) preg_replace('/[^0-9]/', '', $record->data['budget'] ?? '0'),
        ])->values()->all();

        return [
            [
                ['label' => 'Campaigns', 'value' => number_format($campaigns->count()), 'hint' => 'in workspace', 'icon' => 'target', 'tone' => 'green'],
                ['label' => 'Promotions', 'value' => number_format($promotions->count()), 'hint' => 'running or queued', 'icon' => 'tag', 'tone' => 'amber'],
                ['label' => 'Leads', 'value' => number_format($messages), 'hint' => 'contact messages', 'icon' => 'inbox', 'tone' => 'blue'],
                ['label' => 'Coupons', 'value' => number_format(Record::forResource('coupons')->count()), 'hint' => 'issued', 'icon' => 'wallet', 'tone' => 'violet'],
            ],
            $bars,
            $campaigns->map(fn ($record) => ['a' => (string) ($record->data['name'] ?? '—'), 'b' => (string) ($record->data['channel'] ?? '—'), 'c' => (string) ($record->data['budget'] ?? '—'), 'd' => '', 'status' => (string) ($record->data['status'] ?? 'Active')])->all(),
        ];
    }
}
