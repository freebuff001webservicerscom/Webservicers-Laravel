@extends('admin.layout')

@section('pageTitle', 'Orders')

@section('content')
    <div class="page-head">
      <div>
        <h1>Orders<span class="dot">.</span></h1>
        <p class="page-sub">Every order in the workspace — create, progress and refund without leaving the dashboard.</p>
      </div>
      <div class="page-actions">
        <button class="btn btn-dark" type="button" data-open-modal="newOrderModal">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
          New order
        </button>
      </div>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'receipt'])</span><span class="stat-hint">all time</span></div>
            <div class="stat-value"><strong>{{ number_format($totals['all']) }}</strong><span class="stat-label">Total orders</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-green">@include('partials.admin.icon', ['name' => 'chart'])</span><span class="stat-hint">paid work</span></div>
            <div class="stat-value"><strong>${{ number_format($totals['revenue'], 0) }}</strong><span class="stat-label">Revenue</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-amber">@include('partials.admin.icon', ['name' => 'clock'])</span><span class="stat-hint">awaiting action</span></div>
            <div class="stat-value"><strong>{{ number_format($totals['pending']) }}</strong><span class="stat-label">Pending</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-violet">@include('partials.admin.icon', ['name' => 'target'])</span><span class="stat-hint">finished</span></div>
            <div class="stat-value"><strong>{{ number_format($totals['completed']) }}</strong><span class="stat-label">Completed</span></div>
        </div>
    </div>

    <div class="filterbar">
        <span class="pill neutral" style="gap: 8px;">@include('partials.admin.icon', ['name' => 'filter'])</span>
        <select class="select" onchange="if (this.value) window.location = this.dataset.base.replace('__s__', this.value)">
            <option data-base="{{ route('admin.orders.index') }}?status=__s__" value="all" @selected($status === 'all')>All statuses</option>
            @foreach ($statuses as $option)
                <option data-base="{{ route('admin.orders.index') }}?status=__s__" value="{{ $option }}" @selected($status === $option)>{{ ucfirst(str_replace('_', ' ', $option)) }}</option>
            @endforeach
        </select>
        <form class="filter-search" method="get" action="{{ route('admin.orders.index') }}">
            @if ($status !== 'all')<input type="hidden" name="status" value="{{ $status }}" @endif
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m16.5 16.5 4 4"/></svg>
            <input class="input" type="search" name="q" placeholder="Search orders…" value="{{ request('q') }}" />
        </form>
    </div>

    <div class="card">
        <div class="card-head bordered">
            <div>
                <p class="card-eyebrow">Workspace</p>
                <h3 class="card-title">Order list</h3>
            </div>
            <span class="card-note">{{ $orders->total() }} matching {{ Str::plural('order', $orders->total()) }}</span>
        </div>

        @if ($orders->isEmpty())
            <div class="empty">
                <span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'receipt'])</span>
                <h3>No orders match</h3>
                <p>Adjust the filters or create a new order.</p>
                <button class="btn btn-dark" type="button" data-open-modal="newOrderModal">New order</button>
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th class="num">Amount</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="cell-main">{{ $order->reference }}</td>
                                <td>
                                    <div class="cell-main">{{ $order->customer_name }}</div>
                                    <div class="cell-sub">{{ $order->customer_email }}</div>
                                </td>
                                <td>{{ $order->service ?? '—' }}</td>
                                <td>{{ $order->placed_on?->format('j M Y') }}</td>
                                <td class="num">${{ number_format((float) $order->amount, 2) }}</td>
                                <td>
                                    <form method="post" action="{{ route('admin.orders.update', $order) }}" class="inline-form">
                                        @csrf
                                        @method('PATCH')
                                        <select class="select" name="status" style="height: 32px; padding: 0 8px; font-size: 12.5px;" onchange="this.form.submit()">
                                            @foreach (['pending', 'paid', 'in_progress', 'completed', 'cancelled', 'refunded'] as $option)
                                                <option value="{{ $option }}" @selected($order->status === $option)>{{ ucfirst(str_replace('_', ' ', $option)) }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <div class="row-actions">
                                        <form class="inline-form" method="post" action="{{ route('admin.orders.destroy', $order) }}" data-confirm="Delete order {{ $order->reference }}?">
                                            @csrf
                                            @method('DELETE')
                                            <button class="icon-btn" type="submit" title="Delete order">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h16M9 7V4h6v3M6.5 7l1 13h9l1-13M10 11v5M14 11v5"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrap">
                @include('partials.admin.pagination', ['paginator' => $orders])
            </div>
        @endif
    </div>
@endsection
