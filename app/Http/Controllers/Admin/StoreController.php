<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Page;
use App\Models\Record;
use Illuminate\Contracts\View\View;

class StoreController extends Controller
{
    /**
     * Online store overview: the public site's health at a glance.
     */
    public function index(): View
    {
        $byType = Page::query()
            ->selectRaw('type, count(*) as total, sum(case when status = \'published\' then 1 else 0 end) as published')
            ->groupBy('type')
            ->get()
            ->keyBy('type');

        return view('admin.store.index', [
            'sections' => [
                ['label' => 'Service pages', 'type' => 'service', 'route' => 'admin.products.index', 'total' => (int) ($byType['service']->total ?? 0), 'published' => (int) ($byType['service']->published ?? 0)],
                ['label' => 'Company pages', 'type' => 'company', 'route' => 'admin.store.pages', 'total' => (int) ($byType['company']->total ?? 0), 'published' => (int) ($byType['company']->published ?? 0)],
                ['label' => 'Legal pages', 'type' => 'legal', 'route' => 'admin.store.pages', 'total' => (int) ($byType['legal']->total ?? 0), 'published' => (int) ($byType['legal']->published ?? 0)],
            ],
            'stats' => [
                ['label' => 'Published pages', 'value' => (string) Page::query()->published()->count(), 'hint' => 'live on the site', 'icon' => 'store', 'tone' => 'green'],
                ['label' => 'Draft pages', 'value' => (string) Page::query()->where('status', 'draft')->count(), 'hint' => 'hidden from visitors', 'icon' => 'doc', 'tone' => 'amber'],
                ['label' => 'Contact messages', 'value' => (string) ContactMessage::query()->count(), 'hint' => ContactMessage::query()->unread()->count().' unread', 'icon' => 'inbox', 'tone' => 'blue'],
                ['label' => 'Catalogue items', 'value' => (string) Record::query()->count(), 'hint' => 'records in workspace', 'icon' => 'box', 'tone' => 'violet'],
            ],
            'recentPages' => Page::query()->latest('updated_at')->take(6)->get(),
            'orders' => Order::query()->count(),
            'customers' => Customer::query()->count(),
        ]);
    }
}
