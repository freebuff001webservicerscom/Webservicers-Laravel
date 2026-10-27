@extends('admin.layout')

@section('pageTitle', $title)

@section('content')
    <div class="page-head">
      <div>
        <h1>{{ $title }}<span class="dot">.</span></h1>
        <p class="page-sub">Computed live from the workspace database — no sample data, no stale exports.</p>
      </div>
      <div class="page-actions">
        <select class="select" onchange="if (this.value) window.location = this.value">
            @foreach (['sales', 'orders', 'products', 'customers', 'returns', 'channels', 'payments', 'marketing'] as $name)
                <option value="{{ route('admin.reports.'.$name) }}" @selected($report === $name)>{{ ucfirst($name) }} report</option>
            @endforeach
        </select>
      </div>
    </div>

    <div class="stat-grid">
        @foreach ($cards as $card)
            <div class="stat-card">
                <div class="stat-top">
                    <span class="chip tone-{{ $card['tone'] }}">@include('partials.admin.icon', ['name' => $card['icon']])</span>
                    <span class="stat-hint">{{ $card['hint'] }}</span>
                </div>
                <div class="stat-value"><strong>{{ $card['value'] }}</strong><span class="stat-label">{{ $card['label'] }}</span></div>
            </div>
        @endforeach
    </div>

    <div class="two-col">
        <div class="card card-pad">
            <p class="card-eyebrow">Breakdown</p>
            <h3 class="card-title" style="margin-bottom: 18px;">Distribution</h3>

            @php
                $maxBar = max(1, (float) collect($bars)->max('value'));
            @endphp

            @if (count($bars) === 0)
                <div class="empty"><h3>No data yet</h3><p>Data appears as orders and records accumulate.</p></div>
            @else
                <div class="bars">
                    @foreach ($bars as $bar)
                        <div class="bar-row">
                            <span class="bar-label">{{ $bar['label'] }}</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="width: {{ max(2, round(($bar['value'] / $maxBar) * 100)) }}%"></div>
                            </div>
                            <span class="bar-value">{{ is_float($bar['value']) ? '$'.number_format($bar['value'], 0) : number_format($bar['value']) }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="card card-pad">
            <p class="card-eyebrow">Summary</p>
            <h3 class="card-title" style="margin-bottom: 14px;">How to read this</h3>
            <p style="color: var(--sub); font-size: 13.5px; line-height: 1.7; margin: 0;">
                Figures update the moment an order, customer or record changes anywhere in the workspace.
                Use the picker above to jump between report views —
                <strong>sales</strong>, <strong>orders</strong>, <strong>products</strong>, <strong>customers</strong>,
                <strong>returns</strong>, <strong>channels</strong>, <strong>payments</strong> and <strong>marketing</strong>.
            </p>
        </div>
    </div>

    <div class="card">
        <div class="card-head bordered">
            <div>
                <p class="card-eyebrow">Detail</p>
                <h3 class="card-title">Recent rows</h3>
            </div>
            <span class="card-note">{{ count($rows) }} shown</span>
        </div>

        @if (count($rows) === 0)
            <div class="empty"><h3>Nothing to show yet</h3><p>Rows appear as activity accumulates.</p></div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ $report === 'products' ? 'Service' : 'Reference' }}</th>
                            <th>{{ $report === 'customers' ? 'Orders' : 'Customer / label' }}</th>
                            <th>{{ $report === 'sales' ? 'Service' : 'Detail' }}</th>
                            <th class="num">Value</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                            <tr>
                                <td class="cell-main">{{ $row['a'] }}</td>
                                <td>{{ $row['b'] }}</td>
                                <td>{{ $row['c'] }}</td>
                                <td class="num">{{ $row['d'] }}</td>
                                <td>@include('partials.admin.pill', ['value' => $row['status']])</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
