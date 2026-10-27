@extends('admin.layout')

@section('pageTitle', 'Overview')

@section('content')
    <div class="page-head">
      <div>
        <h1>Overview<span class="dot">.</span></h1>
        <p class="page-sub">Your store, in motion — every number below is computed live from the workspace database.</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('admin.reports.sales') }}">View reports</a>
        <button class="btn btn-dark" type="button" data-open-modal="newOrderModal">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
          New order
        </button>
      </div>
    </div>

    <div class="greeting">
      <div class="greeting-left">
        <span class="chip tone-amber">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
        </span>
        <div>
          <h2>Good {{ now()->format('H') < 12 ? 'morning' : (now()->format('H') < 18 ? 'afternoon' : 'evening') }}, {{ auth()->user()->name }}</h2>
          <p>{{ $unreadMessages }} unread messages · {{ $pages }} pages live on the site</p>
        </div>
      </div>
      <div class="greeting-meta">
        <div><strong>{{ $customers }}</strong>customers</div>
        <div><strong>{{ $openNotices }}</strong>notifications</div>
        <div><strong>{{ $recentOrders->count() }}</strong>recent orders</div>
      </div>
    </div>

    <div class="stat-grid">
      @foreach ($cards as $card)
        <div class="stat-card">
          <div class="stat-top">
            <span class="chip tone-{{ $card['tone'] }}">@include('partials.admin.icon', ['name' => $card['icon']])</span>
            <span class="stat-hint">{{ $card['hint'] }}</span>
          </div>
          <div class="stat-value">
            <strong>{{ $card['value'] }}</strong>
            <span class="delta{{ $card['delta'] < 0 ? ' down' : '' }}">↑ {{ abs($card['delta']) }}%</span>
            <span class="stat-label">{{ $card['label'] }}</span>
          </div>
        </div>
      @endforeach
    </div>

    <div class="two-col">
      <div class="card chart-card">
        <div class="chart-head">
          <h3>Revenue trend</h3>
          <div class="chart-legend">
            <span><i style="background: var(--accent)"></i>This period</span>
            <span><i style="background: var(--muted)"></i>Weekly</span>
          </div>
        </div>

        @php
            $max = max(1, $trend->max('value'));
            $points = $trend->values();
            $step = 100 / max(1, $points->count() - 1);
            $linePoints = $points->map(fn ($row, $i) => round($i * $step, 2).','.round(100 - ($row['value'] / $max) * 92, 2))->implode(' ');
            $areaPoints = '0,100 '.$linePoints.' 100,100';
        @endphp

        <svg class="chart" viewBox="0 0 100 100" preserveAspectRatio="none" role="img" aria-label="Revenue over the last 8 weeks">
          <defs>
            <linearGradient id="areaFill" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="var(--accent)" stop-opacity="0.28"/>
              <stop offset="100%" stop-color="var(--accent)" stop-opacity="0"/>
            </linearGradient>
          </defs>
          <line class="grid-line" x1="0" y1="25" x2="100" y2="25" vector-effect="non-scaling-stroke"/>
          <line class="grid-line" x1="0" y1="50" x2="100" y2="50" vector-effect="non-scaling-stroke"/>
          <line class="grid-line" x1="0" y1="75" x2="100" y2="75" vector-effect="non-scaling-stroke"/>
          <polygon class="area" points="{{ $areaPoints }}"/>
          <polyline class="line" points="{{ $linePoints }}" vector-effect="non-scaling-stroke"/>
        </svg>
        <div class="chart-legend" style="justify-content: space-between; padding: 6px 2px 10px;">
          @foreach ($points as $row)
            <span style="font-size: 10.5px;">{{ $row['label'] }}</span>
          @endforeach
        </div>
      </div>

      <div class="card">
        <div class="card-head">
          <div>
            <p class="card-eyebrow">Activity</p>
            <h3 class="card-title">Latest movement</h3>
          </div>
          <a class="card-link" href="{{ route('admin.activity.index') }}">View all →</a>
        </div>
        <div class="feed">
          @forelse ($activities as $activity)
            <div class="feed-item">
              <span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'activity'])</span>
              <div class="feed-body">
                <p>{{ $activity->subject ?? $activity->action }}</p>
                <time>{{ $activity->created_at?->diffForHumans() }}</time>
              </div>
            </div>
          @empty
            <div class="empty"><h3>No activity yet</h3><p>Actions you take in the workspace show up here.</p></div>
          @endforelse
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-head">
        <div>
          <p class="card-eyebrow">Orders</p>
          <h3 class="card-title">Recent orders</h3>
        </div>
        <a class="card-link" href="{{ route('admin.orders.index') }}">View all →</a>
      </div>
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
            </tr>
          </thead>
          <tbody>
            @forelse ($recentOrders as $order)
              <tr>
                <td class="cell-main">{{ $order->reference }}</td>
                <td>
                  <div class="cell-main">{{ $order->customer_name }}</div>
                  <div class="cell-sub">{{ $order->customer_email }}</div>
                </td>
                <td>{{ $order->service ?? '—' }}</td>
                <td>{{ $order->placed_on?->format('j M Y') }}</td>
                <td class="num">${{ number_format((float) $order->amount, 2) }}</td>
                <td>@include('partials.admin.pill', ['value' => $order->status])</td>
              </tr>
            @empty
              <tr><td colspan="6"><div class="empty"><h3>No orders yet</h3><p>Create the first one with the New order button.</p></div></td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
@endsection
