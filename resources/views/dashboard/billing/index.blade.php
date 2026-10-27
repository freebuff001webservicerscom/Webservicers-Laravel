@extends('dashboard.layout')

@section('pageTitle', 'Billing & invoices')
@section('crumb', 'Billing & invoices')

@section('content')
    <div class="page-head">
      <div>
        <h1>Billing &amp; invoices<span class="dot">.</span></h1>
        <p class="page-sub">Every invoice issued to your account — open one to view the full statement.</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('dashboard.balance') }}">Account balance</a>
      </div>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-amber">@include('partials.admin.icon', ['name' => 'clock'])</span><span class="stat-hint">to settle</span></div>
            <div class="stat-value"><strong>${{ number_format((float) $stats['open'], 2) }}</strong><span class="stat-label">Open balance</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-green">@include('partials.admin.icon', ['name' => 'shield'])</span><span class="stat-hint">settled</span></div>
            <div class="stat-value"><strong>${{ number_format((float) $stats['paid'], 2) }}</strong><span class="stat-label">Paid to date</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'doc'])</span><span class="stat-hint">unpaid count</span></div>
            <div class="stat-value"><strong>{{ $stats['unpaid'] }}</strong><span class="stat-label">Awaiting payment</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-violet">@include('partials.admin.icon', ['name' => 'receipt'])</span><span class="stat-hint">all time</span></div>
            <div class="stat-value"><strong>{{ $stats['total'] }}</strong><span class="stat-label">Invoices issued</span></div>
        </div>
    </div>

    <div class="card">
        <div class="card-head bordered">
            <div>
                <p class="card-eyebrow">Documents</p>
                <h3 class="card-title">All invoices</h3>
            </div>
            <span class="card-note">{{ $invoices->total() }} {{ Str::plural('invoice', $invoices->total()) }}</span>
        </div>

        @if ($invoices->isEmpty())
            <div class="empty">
                <span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'doc'])</span>
                <h3>No invoices yet</h3>
                <p>Invoices appear here as soon as an order is billed to your account.</p>
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Description</th>
                            <th>Issued</th>
                            <th>Due</th>
                            <th class="num">Amount</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td class="cell-main">{{ $invoice->number }}</td>
                                <td>{{ $invoice->description }}@if ($invoice->order) <span class="cell-sub">{{ $invoice->order->reference }}</span>@endif</td>
                                <td>{{ $invoice->issued_on?->format('j M Y') ?? '—' }}</td>
                                <td>{{ $invoice->due_on?->format('j M Y') ?? '—' }}</td>
                                <td class="num">${{ number_format((float) $invoice->amount, 2) }}</td>
                                <td>@include('partials.admin.pill', ['value' => $invoice->status])</td>
                                <td>
                                    <div class="row-actions">
                                        <a class="icon-btn" href="{{ route('dashboard.billing.show', $invoice) }}" title="View invoice">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3h9l3 3v15H6V3Z"/><path d="M9 10h6M9 14h6"/></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @include('partials.admin.pagination', ['paginator' => $invoices])
        @endif
    </div>
@endsection
