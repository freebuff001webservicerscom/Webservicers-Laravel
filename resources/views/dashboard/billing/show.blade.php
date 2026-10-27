@extends('dashboard.layout')

@section('pageTitle', 'Invoice '.$invoice->number)
@section('crumb', 'Billing & invoices')

@section('content')
    <div class="page-head">
      <div>
        <h1>{{ $invoice->number }}<span class="dot">.</span></h1>
        <p class="page-sub">Issued {{ $invoice->issued_on?->format('j M Y') ?? '—' }}{{ $invoice->due_on ? ' · due '.$invoice->due_on->format('j M Y') : '' }}</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('dashboard.billing.index') }}">Back to invoices</a>
        <button class="btn btn-dark" type="button" onclick="window.print()">Print / save PDF</button>
      </div>
    </div>

    <div class="card card-pad">
        <div class="invoice-sheet">
            <div class="invoice-top">
                <div>
                    <p class="card-eyebrow">Invoice</p>
                    <h2 style="margin:0; font-family: var(--display); font-weight:800; letter-spacing:-.02em;">{{ $invoice->number }}</h2>
                    <p class="thread-meta">{{ $siteName }}</p>
                </div>
                <div style="text-align:right;">
                    @include('partials.admin.pill', ['value' => $invoice->status])
                    <p class="thread-meta" style="margin-top:8px;">
                        {{ $invoice->status === 'paid' && $invoice->paid_on ? 'Paid '.$invoice->paid_on->format('j M Y') : ($invoice->due_on ? 'Payable until '.$invoice->due_on->format('j M Y') : 'No due date') }}
                    </p>
                </div>
            </div>

            <div class="two-col">
                <div>
                    <p class="card-eyebrow">Billed to</p>
                    <p style="margin:6px 0 0; font-weight:600;">{{ $user->name }}</p>
                    <p style="margin:2px 0 0; color:var(--sub); font-size:13.5px;">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="card-eyebrow">Issued by</p>
                    <p style="margin:6px 0 0; font-weight:600;">{{ $siteName }}</p>
                    <p style="margin:2px 0 0; color:var(--sub); font-size:13.5px;">{{ $siteName }} HQ</p>
                </div>
            </div>

            <div class="table-wrap">
                <table class="table invoice-lines">
                    <thead>
                        <tr>
                            <th>Description</th>
                            @if ($invoice->order)<th>Order</th>@endif
                            <th class="num">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $invoice->description }}</td>
                            @if ($invoice->order)<td>{{ $invoice->order->reference }} · {{ $invoice->order->service ?? 'Service' }}</td>@endif
                            <td class="num">${{ number_format((float) $invoice->amount, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="invoice-total">
                <span>Total</span>
                <span>${{ number_format((float) $invoice->amount, 2) }}</span>
            </div>
        </div>
    </div>
@endsection
