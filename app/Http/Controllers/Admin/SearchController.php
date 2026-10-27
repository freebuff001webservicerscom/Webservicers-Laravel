<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Page;
use App\Models\Record;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Global workspace search (topbar field and ⌘K).
     */
    public function __invoke(Request $request): View
    {
        $query = trim((string) $request->query('q', ''));
        $results = [];

        if ($query !== '') {
            $like = "%{$query}%";

            $results['pages'] = Page::query()
                ->where(fn ($q) => $q->where('slug', 'like', $like)->orWhere('title', 'like', $like))
                ->take(6)->get();
            $results['orders'] = Order::query()
                ->where(fn ($q) => $q->where('reference', 'like', $like)->orWhere('customer_name', 'like', $like))
                ->take(6)->get();
            $results['customers'] = Customer::query()
                ->where(fn ($q) => $q->where('name', 'like', $like)->orWhere('company', 'like', $like)->orWhere('email', 'like', $like))
                ->take(6)->get();
            $results['messages'] = ContactMessage::query()
                ->where(fn ($q) => $q->where('name', 'like', $like)->orWhere('message', 'like', $like))
                ->take(6)->get();
            $results['records'] = Record::query()
                ->where('data', 'like', $like)
                ->take(8)->get();

            $results = array_filter($results);
        }

        return view('admin.search', [
            'query' => $query,
            'results' => $results,
            'total' => array_reduce($results, fn (int $carry, $group) => $carry + $group->count(), 0),
        ]);
    }
}
