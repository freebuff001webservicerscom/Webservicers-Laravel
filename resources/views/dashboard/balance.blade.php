@extends('dashboard.layout')

@section('pageTitle', 'Balance')
@section('crumb', 'Balance')

@section('content')
    <div class="page-head">
      <div>
        <h1>Balance<span class="dot">.</span></h1>
        <p class="page-sub">Your prepaid credit with {{ $siteName }} — top-ups and every spend, itemised below.</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('dashboard.billing.index') }}">Billing &amp; invoices</a>
      </div>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-green">@include('partials.admin.icon', ['name' => 'wallet'])</span><span class="stat-hint">available now</span></div>
            <div class="stat-value"><strong>${{ number_format($balance, 2) }}</strong><span class="stat-label">Account balance</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'plus'])</span><span class="stat-hint">all time</span></div>
            <div class="stat-value"><strong>${{ number_format($credited, 2) }}</strong><span class="stat-label">Total credited</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-amber">@include('partials.admin.icon', ['name' => 'chart'])</span><span class="stat-hint">all time</span></div>
            <div class="stat-value"><strong>${{ number_format(abs($spent), 2) }}</strong><span class="stat-label">Total spent</span></div>
        </div>
    </div>

    <div class="card">
        <div class="card-head bordered">
            <div>
                <p class="card-eyebrow">Ledger</p>
                <h3 class="card-title">Balance history</h3>
            </div>
            <span class="card-note">{{ $entries->total() }} {{ Str::plural('entry', $entries->total()) }}</span>
        </div>

        @if ($entries->isEmpty())
            <div class="empty">
                <span class="chip tone-green">@include('partials.admin.icon', ['name' => 'wallet'])</span>
                <h3>No activity yet</h3>
                <p>Top-ups and order spending will appear here the moment they happen.</p>
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th class="num">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entries as $entry)
                            @php $credit = (float) $entry->amount > 0; @endphp
                            <tr>
                                <td>{{ $entry->created_at->format('j M Y, H:i') }}</td>
                                <td class="cell-main">{{ $entry->description }}</td>
                                <td class="num {{ $credit ? 'money-in' : 'money-out' }}">{{ $credit ? '+' : '−' }}${{ number_format(abs((float) $entry->amount), 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @include('partials.admin.pagination', ['paginator' => $entries])
        @endif
    </div>
@endsection
