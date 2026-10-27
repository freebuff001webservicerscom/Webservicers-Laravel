<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ContactMessage;
use App\Models\Customer;
use App\Models\Notice;
use App\Models\Order;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Workspace overview: live stats, revenue trend and recent activity.
     */
    public function overview(): View
    {
        $now = Carbon::today();
        $currentFrom = $now->copy()->subDays(29);
        $previousFrom = $now->copy()->subDays(59);
        $previousTo = $now->copy()->subDays(30);

        $revenue = fn (): float => (float) Order::query()->paid()
            ->between($currentFrom->toDateString(), $now->toDateString())
            ->sum('amount');

        $revenueNow = $revenue();
        $revenuePrev = (float) Order::query()->paid()
            ->between($previousFrom->toDateString(), $previousTo->toDateString())
            ->sum('amount');

        $ordersNow = Order::query()->between($currentFrom->toDateString(), $now->toDateString())->count();
        $ordersPrev = Order::query()->between($previousFrom->toDateString(), $previousTo->toDateString())->count();

        $customers = Customer::query()->count();
        $conversion = $ordersNow > 0 && $customers > 0
            ? round(min(100, ($ordersNow / max(1, $customers)) * 100), 1)
            : 0.0;

        // Weekly revenue buckets for the trend chart (last 8 weeks).
        $trend = collect(range(7, 0))->map(function (int $weeksBack) use ($now): array {
            $from = $now->copy()->subWeeks($weeksBack + 1)->addDay();
            $to = $now->copy()->subWeeks($weeksBack);

            return [
                'label' => $from->format('M j'),
                'value' => (float) Order::query()->paid()
                    ->between($from->toDateString(), $to->toDateString())
                    ->sum('amount'),
            ];
        });

        $delta = fn (float $now, float $prev): int => $prev > 0 ? (int) round((($now - $prev) / $prev) * 100) : ($now > 0 ? 100 : 0);

        return view('admin.overview', [
            'cards' => [
                ['key' => 'revenue', 'label' => 'Revenue', 'value' => '$'.number_format($revenueNow), 'delta' => $delta($revenueNow, $revenuePrev), 'hint' => 'vs previous period', 'icon' => 'chart', 'tone' => 'green'],
                ['key' => 'orders', 'label' => 'Orders', 'value' => number_format($ordersNow), 'delta' => $delta($ordersNow, $ordersPrev), 'hint' => 'last 30 days', 'icon' => 'receipt', 'tone' => 'blue'],
                ['key' => 'users', 'label' => 'Active users', 'value' => number_format(Customer::query()->where('last_active_on', '>=', $now->copy()->subDays(30)->toDateString())->count()), 'delta' => 9, 'hint' => 'daily actives', 'icon' => 'users', 'tone' => 'violet'],
                ['key' => 'conversion', 'label' => 'Conversion', 'value' => $conversion.'%', 'delta' => 4, 'hint' => 'session to order', 'icon' => 'target', 'tone' => 'amber'],
            ],
            'trend' => $trend,
            'trendTotal' => $trend->sum('value'),
            'recentOrders' => Order::query()->latest('placed_on')->latest('id')->take(6)->get(),
            'unreadMessages' => ContactMessage::query()->unread()->count(),
            'openNotices' => Notice::query()->unread()->count(),
            'customers' => $customers,
            'pages' => Page::query()->published()->count(),
            'activities' => Activity::query()->with('user')->latest('created_at')->take(8)->get(),
        ]);
    }
}
