@extends('admin.layout')

@section('pageTitle', 'Customers')

@section('content')
    <div class="page-head">
      <div>
        <h1>Customers<span class="dot">.</span></h1>
        <p class="page-sub">Everyone who buys, enquires or goes quiet — with lifetime value calculated from paid orders.</p>
      </div>
      <div class="page-actions">
        <button class="btn btn-dark" type="button" data-open-modal="customerModal">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
          New customer
        </button>
      </div>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-green">@include('partials.admin.icon', ['name' => 'users'])</span><span class="stat-hint">all time</span></div>
            <div class="stat-value"><strong>{{ number_format($totals['all']) }}</strong><span class="stat-label">Total customers</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'target'])</span><span class="stat-hint">currently buying</span></div>
            <div class="stat-value"><strong>{{ number_format($totals['active']) }}</strong><span class="stat-label">Active</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-amber">@include('partials.admin.icon', ['name' => 'clock'])</span><span class="stat-hint">in conversation</span></div>
            <div class="stat-value"><strong>{{ number_format($totals['leads']) }}</strong><span class="stat-label">Leads</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-violet">@include('partials.admin.icon', ['name' => 'chart'])</span><span class="stat-hint">paid orders</span></div>
            <div class="stat-value"><strong>${{ number_format($totals['value'], 0) }}</strong><span class="stat-label">Lifetime value</span></div>
        </div>
    </div>

    <div class="filterbar">
        <span class="pill neutral">All customers</span>
        <form class="filter-search" method="get" action="{{ route('admin.customers.index') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m16.5 16.5 4 4"/></svg>
            <input class="input" type="search" name="q" placeholder="Search name, company, email…" value="{{ request('q') }}" />
        </form>
    </div>

    <div class="card">
        <div class="card-head bordered">
            <div>
              <p class="card-eyebrow">Workspace</p>
              <h3 class="card-title">Customer list</h3>
            </div>
            <span class="card-note">{{ $customers->count() }} matching {{ Str::plural('customer', $customers->count()) }}</span>
        </div>

        @if ($customers->isEmpty())
            <div class="empty">
                <span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'users'])</span>
                <h3>No customers match</h3>
                <p>Try a different search or add a customer manually.</p>
                <button class="btn btn-dark" type="button" data-open-modal="customerModal">New customer</button>
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Company</th>
                            <th>Phone</th>
                            <th>Last active</th>
                            <th class="num">Lifetime value</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>
                                    <div class="cell-with-avatar">
                                        <span class="avatar {{ ['v2', 'v3', 'v4'][($customer->id ?? 0) % 3] }}">{!! strtoupper(mb_substr($customer->name, 0, 1)) !!}</span>
                                        <div>
                                            <div class="cell-main">{{ $customer->name }}</div>
                                            <div class="cell-sub">{{ $customer->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $customer->company ?? '—' }}</td>
                                <td>{{ $customer->phone ?? '—' }}</td>
                                <td>{{ $customer->last_active_on?->format('j M Y') ?? '—' }}</td>
                                <td class="num">${{ number_format($spend[$customer->email] ?? 0, 2) }}</td>
                                <td>@include('partials.admin.pill', ['value' => $customer->status])</td>
                                <td>
                                    <div class="row-actions">
                                        <button class="icon-btn" type="button" title="Edit customer" data-open-modal="customer-{{ $customer->id }}">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h4L20 8l-4-4L4 16v4Z"/><path d="m14 6 4 4"/></svg>
                                        </button>
                                        <form class="inline-form" method="post" action="{{ route('admin.customers.destroy', $customer) }}" data-confirm="Delete {{ $customer->name }}?">
                                            @csrf
                                            @method('DELETE')
                                            <button class="icon-btn" type="submit" title="Delete customer">
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
        @endif
    </div>

    @foreach ($customers as $customer)
        @include('partials.admin.customer-modal', ['customer' => $customer])
    @endforeach

    {{-- create customer modal --}}
    <div class="modal-backdrop" id="customerModal" hidden>
        <div class="modal" role="dialog" aria-modal="true" aria-label="New customer">
            <div class="modal-head">
                <h3>New customer</h3>
                <button class="icon-btn" type="button" data-close-modal aria-label="Close">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
                </button>
            </div>
            <form method="post" action="{{ route('admin.customers.store') }}">
                @csrf
                <div class="form-grid">
                    <label class="field"><span>Name <em>*</em></span><input type="text" name="name" required placeholder="Alex Morgan" /></label>
                    <label class="field"><span>Email <em>*</em></span><input type="email" name="email" required placeholder="you@business.com" /></label>
                    <label class="field"><span>Phone</span><input type="text" name="phone" placeholder="+1 555 000 0000" /></label>
                    <label class="field"><span>Company</span><input type="text" name="company" placeholder="Bright Bloom Ltd" /></label>
                    <label class="field"><span>Status</span>
                        <select name="status">
                            <option value="active">Active</option>
                            <option value="lead">Lead</option>
                            <option value="churned">Churned</option>
                        </select>
                    </label>
                </div>
                <div class="modal-actions">
                    <button class="btn btn-ghost" type="button" data-close-modal>Cancel</button>
                    <button class="btn btn-dark" type="submit">Create customer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
