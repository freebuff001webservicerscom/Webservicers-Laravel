@extends('admin.layout')

@section('pageTitle', 'Store pages')

@section('content')
    <div class="page-head">
      <div>
        <h1>Store pages<span class="dot">.</span></h1>
        <p class="page-sub">Company and legal pages served by the public site — about, careers, press, help, terms and privacy.</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('admin.products.index') }}">Service pages</a>
      </div>
    </div>

    @foreach (['company' => 'Company pages', 'legal' => 'Legal pages'] as $type => $label)
        @php $group = $pages->where('type', $type); @endphp

        <div class="card">
            <div class="card-head bordered">
                <div>
                    <p class="card-eyebrow">{{ $type }}</p>
                    <h3 class="card-title">{{ $label }}</h3>
                </div>
                <span class="card-note">{{ $group->count() }} pages</span>
            </div>
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Page</th>
                            <th>Slug</th>
                            <th>Theme</th>
                            <th>Status</th>
                            <th>Sections</th>
                            <th>Updated</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($group as $page)
                            <tr>
                                <td>
                                    <div class="cell-main">{{ $page->title }}</div>
                                    <div class="cell-sub">{{ \Illuminate\Support\Str::limit($page->description, 70) }}</div>
                                </td>
                                <td>/{{ $page->slug }}</td>
                                <td><span class="pill">{{ $page->theme ?? '—' }}</span></td>
                                <td>@include('partials.admin.pill', ['value' => $page->status])</td>
                                <td>{{ count($page->content ?? []) }} keys</td>
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
                            <tr><td colspan="7"><div class="empty"><h3>Nothing here</h3><p>Run the seeder to import this content.</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
@endsection
