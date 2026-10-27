@extends('admin.layout')

@section('pageTitle', 'Search')

@section('content')
    <div class="page-head">
      <div>
        <h1>Search<span class="dot">.</span></h1>
        <p class="page-sub">One query across pages, orders, customers, messages and every workspace record.</p>
      </div>
    </div>

    <div class="filterbar">
        <form class="filter-search" method="get" action="{{ route('admin.search') }}" style="width: 100%; margin: 0;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m16.5 16.5 4 4"/></svg>
            <input class="input" type="search" name="q" placeholder="Search pages, orders, customers, records…" value="{{ $query }}" autofocus style="flex: 1; min-width: 0;" />
            <button class="btn btn-dark" type="submit">Search</button>
        </form>
    </div>

    @if ($query === '')
        <div class="card">
            <div class="empty">
                <span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'search'])</span>
                <h3>Search the workspace</h3>
                <p>Type a query above — try a customer name, an order reference like WS-1040, or a page slug.</p>
            </div>
        </div>
    @elseif ($total === 0)
        <div class="card">
            <div class="empty">
                <span class="chip tone-amber">@include('partials.admin.icon', ['name' => 'search'])</span>
                <h3>No results for “{{ $query }}”</h3>
                <p>Check the spelling or try a shorter query.</p>
            </div>
        </div>
    @else
        <p class="search-group-label">{{ $total }} {{ Str::plural('result', $total) }} for “{{ $query }}”</p>

        @if (isset($results['pages']))
            <div class="card">
                <div class="card-head bordered"><div><p class="card-eyebrow">Content</p><h3 class="card-title">Pages</h3></div></div>
                <div class="result-list">
                    @foreach ($results['pages'] as $page)
                        <a class="result-row" href="{{ route('admin.pages.edit', $page) }}">
                            <span class="chip tone-green">@include('partials.admin.icon', ['name' => 'globe'])</span>
                            <div class="rr-body">
                                <p>{{ $page->title }}</p>
                                <small>/{{ $page->slug }} · {{ ucfirst($page->type) }} · {{ $page->status }}</small>
                            </div>
                            <span class="card-link">Edit →</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if (isset($results['orders']))
            <div class="card">
                <div class="card-head bordered"><div><p class="card-eyebrow">Commerce</p><h3 class="card-title">Orders</h3></div></div>
                <div class="result-list">
                    @foreach ($results['orders'] as $order)
                        <a class="result-row" href="{{ route('admin.orders.index') }}?q={{ urlencode($query) }}">
                            <span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'receipt'])</span>
                            <div class="rr-body">
                                <p>{{ $order->reference }} — {{ $order->customer_name }}</p>
                                <small>{{ $order->service ?? '—' }} · ${{ number_format((float) $order->amount, 2) }} · {{ $order->status }}</small>
                            </div>
                            <span class="card-link">View →</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if (isset($results['customers']))
            <div class="card">
                <div class="card-head bordered"><div><p class="card-eyebrow">Workspace</p><h3 class="card-title">Customers</h3></div></div>
                <div class="result-list">
                    @foreach ($results['customers'] as $customer)
                        <a class="result-row" href="{{ route('admin.customers.index') }}?q={{ urlencode($query) }}">
                            <span class="avatar">{!! strtoupper(mb_substr($customer->name, 0, 1)) !!}</span>
                            <div class="rr-body">
                                <p>{{ $customer->name }}</p>
                                <small>{{ $customer->company ?? '—' }} · {{ $customer->email }} · {{ $customer->status }}</small>
                            </div>
                            <span class="card-link">View →</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if (isset($results['messages']))
            <div class="card">
                <div class="card-head bordered"><div><p class="card-eyebrow">Communication</p><h3 class="card-title">Messages</h3></div></div>
                <div class="result-list">
                    @foreach ($results['messages'] as $message)
                        <a class="result-row" href="{{ route('admin.inbox.index', ['id' => $message->id]) }}">
                            <span class="chip tone-violet">@include('partials.admin.icon', ['name' => 'mail'])</span>
                            <div class="rr-body">
                                <p>{{ $message->name }} — {{ \Illuminate\Support\Str::limit($message->message, 60) }}</p>
                                <small>{{ $message->created_at->diffForHumans(short: true) }} · {{ $message->status }}</small>
                            </div>
                            <span class="card-link">Open →</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if (isset($results['records']))
            <div class="card">
                <div class="card-head bordered"><div><p class="card-eyebrow">Records</p><h3 class="card-title">Workspace records</h3></div></div>
                <div class="result-list">
                    @foreach ($results['records'] as $record)
                        <a class="result-row" href="{{ route('admin.records.edit', [$record->resource, $record]) }}">
                            <span class="chip tone-amber">@include('partials.admin.icon', ['name' => 'box'])</span>
                            <div class="rr-body">
                                <p>{{ $record->data['name'] ?? $record->data['title'] ?? $record->data['code'] ?? $record->data['reference'] ?? $record->resource.' #'.$record->id }}</p>
                                <small>{{ $record->resource }} · {{ \Illuminate\Support\Str::limit(json_encode($record->data), 70) }}</small>
                            </div>
                            <span class="card-link">Edit →</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
@endsection
