@extends('admin.layout')

@section('pageTitle', 'Online store')

@section('content')
    <div class="page-head">
      <div>
        <h1>Online store<span class="dot">.</span></h1>
        <p class="page-sub">The public website at a glance — what is published, what is hidden, and what visitors are sending in.</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('home') }}" target="_blank" rel="noopener">Visit site ↗</a>
        <a class="btn btn-dark" href="{{ route('admin.store.pages') }}">Edit pages</a>
      </div>
    </div>

    <div class="stat-grid">
        @foreach ($stats as $stat)
            <div class="stat-card">
                <div class="stat-top">
                    <span class="chip tone-{{ $stat['tone'] }}">@include('partials.admin.icon', ['name' => $stat['icon']])</span>
                    <span class="stat-hint">{{ $stat['hint'] }}</span>
                </div>
                <div class="stat-value"><strong>{{ $stat['value'] }}</strong><span class="stat-label">{{ $stat['label'] }}</span></div>
            </div>
        @endforeach
    </div>

    <div class="store-sections">
        @foreach ($sections as $section)
            <div class="store-section">
                <span class="chip tone-{{ ['green', 'blue', 'violet'][$loop->index] }}">@include('partials.admin.icon', ['name' => 'globe'])</span>
                <h3>{{ $section['label'] }}</h3>
                <span class="ss-count">{{ $section['published'] }}<span style="font-size: 14px; color: var(--muted); font-weight: 600;"> / {{ $section['total'] }} published</span></span>
                <span class="ss-sub">{{ $section['total'] - $section['published'] === 0 ? 'Everything is live.' : ($section['total'] - $section['published']).' draft hidden from visitors.' }}</span>
                <a class="btn btn-white btn-sm" style="margin-top: 6px; align-self: flex-start;" href="{{ route($section['route']) }}">Manage →</a>
            </div>
        @endforeach
    </div>

    <div class="two-col">
        <div class="card">
            <div class="card-head">
                <div>
                    <p class="card-eyebrow">Content</p>
                    <h3 class="card-title">Recently updated pages</h3>
                </div>
                <a class="card-link" href="{{ route('admin.products.index') }}">All pages →</a>
            </div>
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Page</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Updated</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentPages as $page)
                            <tr>
                                <td>
                                    <div class="cell-main">{{ $page->title }}</div>
                                    <div class="cell-sub">/{{ $page->slug }}</div>
                                </td>
                                <td>{{ ucfirst($page->type) }}</td>
                                <td>@include('partials.admin.pill', ['value' => $page->status])</td>
                                <td>{{ $page->updated_at->diffForHumans(short: true) }}</td>
                                <td><a class="btn btn-white btn-sm" href="{{ route('admin.pages.edit', $page) }}">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card card-pad">
            <p class="card-eyebrow">Storefront</p>
            <h3 class="card-title" style="margin-bottom: 16px;">Live connections</h3>
            <div class="meta-grid">
                <div class="meta-tile"><span>Orders in system</span><strong>{{ $orders }}</strong></div>
                <div class="meta-tile"><span>Customers</span><strong>{{ $customers }}</strong></div>
                <div class="meta-tile"><span>Domain</span><strong>{{ parse_url(url('/'), PHP_URL_HOST) }}</strong></div>
                <div class="meta-tile"><span>Database</span><strong>SQLite</strong></div>
            </div>
            <div class="form-actions">
                <a class="btn btn-dark btn-sm" href="{{ route('admin.settings.general') }}">Store settings</a>
                <a class="btn btn-white btn-sm" href="{{ route('admin.settings.seo') }}">SEO</a>
                <a class="btn btn-white btn-sm" href="{{ route('admin.settings.maintenance') }}">Maintenance</a>
            </div>
        </div>
    </div>
@endsection
