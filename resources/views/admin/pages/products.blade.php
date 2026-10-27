@extends('admin.layout')

@section('pageTitle', 'Products')

@section('content')
    <div class="page-head">
      <div>
        <h1>Products<span class="dot">.</span></h1>
        <p class="page-sub">The nine service pages powering the public site. Edit hero copy, pricing, FAQs and CTA — changes go live immediately.</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('admin.store.pages') }}">Company &amp; legal pages</a>
        <a class="btn btn-dark" href="{{ route('home') }}#categories" target="_blank" rel="noopener">View site</a>
      </div>
    </div>

    @php
        $published = $pages->where('status', 'published')->count();
        $draft = $pages->count() - $published;
    @endphp

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-green">@include('partials.admin.icon', ['name' => 'box'])</span><span class="stat-hint">in catalogue</span></div>
            <div class="stat-value"><strong>{{ $pages->count() }}</strong><span class="stat-label">Service pages</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'globe'])</span><span class="stat-hint">visible to visitors</span></div>
            <div class="stat-value"><strong>{{ $published }}</strong><span class="stat-label">Published</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-amber">@include('partials.admin.icon', ['name' => 'doc'])</span><span class="stat-hint">hidden from site</span></div>
            <div class="stat-value"><strong>{{ $draft }}</strong><span class="stat-label">Drafts</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-violet">@include('partials.admin.icon', ['name' => 'database'])</span><span class="stat-hint">source of truth</span></div>
            <div class="stat-value"><strong>SQLite</strong><span class="stat-label">Content storage</span></div>
        </div>
    </div>

    <div class="card">
        <div class="card-head bordered">
            <div>
                <p class="card-eyebrow">Catalog</p>
                <h3 class="card-title">Service pages</h3>
            </div>
            <span class="card-note">{{ $pages->count() }} pages</span>
        </div>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Page</th>
                        <th>Slug</th>
                        <th>Type</th>
                        <th>Theme</th>
                        <th>Status</th>
                        <th>Updated</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pages as $page)
                        <tr>
                            <td>
                                <div class="cell-with-avatar">
                                    <span class="avatar {{ ['v2', 'v3', 'v4'][$page->id % 3] }}">{!! strtoupper(mb_substr($page->slug, 0, 1)) !!}</span>
                                    <div>
                                        <div class="cell-main">{{ $page->title }}</div>
                                        <div class="cell-sub">/{{ $page->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $page->slug }}</td>
                            <td>{{ ucfirst($page->type) }}</td>
                            <td><span class="pill">{{ $page->theme ?? '—' }}</span></td>
                            <td>@include('partials.admin.pill', ['value' => $page->status])</td>
                            <td>{{ $page->updated_at->diffForHumans(short: true) }}</td>
                            <td>
                                <div class="row-actions">
                                    <a class="icon-btn" href="{{ route('home') }}/{{ $page->slug }}" target="_blank" rel="noopener" title="View on site">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M14 4h6v6M20 4 10 14"/><path d="M19 13v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h6"/></svg>
                                    </a>
                                    <a class="btn btn-white btn-sm" href="{{ route('admin.pages.edit', $page) }}">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7"><div class="empty"><h3>No pages yet</h3><p>Run the seeder to import the catalogue.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
