@extends('admin.layout')

@section('pageTitle', 'Contact messages')

@section('content')
    <div class="page-head">
      <div>
        <h1>Contact messages<span class="dot">.</span></h1>
        <p class="page-sub">Every form submission from the public site lands here — opened, triaged and marked replied.</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('admin.inbox.index') }}">Open inbox</a>
      </div>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'inbox'])</span><span class="stat-hint">all time</span></div>
            <div class="stat-value"><strong>{{ $totals['all'] }}</strong><span class="stat-label">Total messages</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-amber">@include('partials.admin.icon', ['name' => 'bell'])</span><span class="stat-hint">waiting on you</span></div>
            <div class="stat-value"><strong>{{ $totals['new'] }}</strong><span class="stat-label">Unread</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-green">@include('partials.admin.icon', ['name' => 'send'])</span><span class="stat-hint">answered</span></div>
            <div class="stat-value"><strong>{{ $totals['replied'] }}</strong><span class="stat-label">Replied</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-violet">@include('partials.admin.icon', ['name' => 'globe'])</span><span class="stat-hint">connected</span></div>
            <div class="stat-value"><strong>Live</strong><span class="stat-label">Frontend form</span></div>
        </div>
    </div>

    <div class="card">
        <div class="card-head bordered">
            <div>
                <p class="card-eyebrow">Communication</p>
                <h3 class="card-title">All messages</h3>
            </div>
            <span class="card-note">{{ $messages->count() }} {{ Str::plural('message', $messages->count()) }}</span>
        </div>

        @if ($messages->isEmpty())
            <div class="empty">
                <span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'mail'])</span>
                <h3>No messages yet</h3>
                <p>Submissions to the site's contact form appear here instantly.</p>
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>From</th>
                            <th>Message</th>
                            <th>Service</th>
                            <th>Received</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                            <tr>
                                <td>
                                    <div class="cell-main">{{ $message->name }}</div>
                                    <div class="cell-sub">{{ $message->email }}{{ $message->phone ? ' · '.$message->phone : '' }}</div>
                                </td>
                                <td style="max-width: 380px;">
                                    <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $message->message }}</div>
                                </td>
                                <td>{{ $message->service ?? '—' }}</td>
                                <td>{{ $message->created_at->diffForHumans(short: true) }}</td>
                                <td>@include('partials.admin.pill', ['value' => $message->status])</td>
                                <td>
                                    <div class="row-actions">
                                        <a class="icon-btn" href="{{ route('admin.inbox.index', ['id' => $message->id]) }}" title="Open in inbox">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h16v11H9l-5 4V5Z"/><path d="M8 9h8M8 12.5h5"/></svg>
                                        </a>
                                        <form class="inline-form" method="post" action="{{ route('admin.messages.destroy', $message) }}" data-confirm="Delete this message?">
                                            @csrf
                                            @method('DELETE')
                                            <button class="icon-btn" type="submit" title="Delete">
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
@endsection
