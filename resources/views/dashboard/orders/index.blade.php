@extends('dashboard.layout')

@section('pageTitle', 'Orders')
@section('crumb', 'Orders')

@section('content')
    <div class="page-head">
      <div>
        <h1>My orders<span class="dot">.</span></h1>
        <p class="page-sub">Every service you've bought with us — open a conversation on any order below.</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('dashboard.billing.index') }}">Billing &amp; invoices</a>
      </div>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'receipt'])</span><span class="stat-hint">all time</span></div>
            <div class="stat-value"><strong>{{ $stats['total'] }}</strong><span class="stat-label">Total orders</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-amber">@include('partials.admin.icon', ['name' => 'clock'])</span><span class="stat-hint">in flight</span></div>
            <div class="stat-value"><strong>{{ $stats['active'] }}</strong><span class="stat-label">Active</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-green">@include('partials.admin.icon', ['name' => 'target'])</span><span class="stat-hint">delivered</span></div>
            <div class="stat-value"><strong>{{ $stats['completed'] }}</strong><span class="stat-label">Completed</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-violet">@include('partials.admin.icon', ['name' => 'wallet'])</span><span class="stat-hint">paid orders</span></div>
            <div class="stat-value"><strong>${{ number_format((float) $stats['value'], 2) }}</strong><span class="stat-label">Lifetime value</span></div>
        </div>
    </div>

    <div class="card">
        <div class="card-head bordered">
            <div>
                <p class="card-eyebrow">History</p>
                <h3 class="card-title">All orders</h3>
            </div>
            <span class="card-note">{{ $orders->total() }} {{ Str::plural('order', $orders->total()) }}</span>
        </div>

        @if ($orders->isEmpty())
            <div class="empty">
                <span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'receipt'])</span>
                <h3>No orders yet</h3>
                <p>When you buy a service it appears here with its full conversation and invoices.</p>
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Service</th>
                            <th>Placed</th>
                            <th class="num">Amount</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="cell-main">{{ $order->reference }}</td>
                                <td>{{ $order->service ?? '—' }}</td>
                                <td>{{ $order->placed_on?->format('j M Y') ?? '—' }}</td>
                                <td class="num">${{ number_format((float) $order->amount, 2) }}</td>
                                <td>@include('partials.admin.pill', ['value' => $order->status])</td>
                                <td>
                                    <div class="row-actions">
                                        <a class="icon-btn" href="{{ route('dashboard.orders.chat', $order) }}" title="Order conversation">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h16v11H9l-5 4V5Z"/><path d="M8 9h8M8 12.5h5"/></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @include('partials.admin.pagination', ['paginator' => $orders])
        @endif
    </div>
@endsection
