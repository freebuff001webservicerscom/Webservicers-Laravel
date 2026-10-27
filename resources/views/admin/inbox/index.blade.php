@extends('admin.layout')

@section('pageTitle', 'Customer inbox')

@section('content')
    <div class="page-head">
      <div>
        <h1>Customer inbox<span class="dot">.</span></h1>
        <p class="page-sub">Conversations started from the public contact form, in one thread view.</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('admin.messages.index') }}">Table view</a>
        <button class="btn btn-dark" type="button" onclick="document.getElementById('markAllForm').submit()">Mark all read</button>
      </div>
    </div>

    <form id="markAllForm" method="post" action="{{ route('admin.notifications.read-all') }}" hidden>
        @csrf
    </form>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'inbox'])</span><span class="stat-hint">all conversations</span></div>
            <div class="stat-value"><strong>{{ $messages->count() }}</strong><span class="stat-label">Messages</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-amber">@include('partials.admin.icon', ['name' => 'bell'])</span><span class="stat-hint">need a reply</span></div>
            <div class="stat-value"><strong>{{ $messages->where('status', 'new')->count() }}</strong><span class="stat-label">Unread</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-green">@include('partials.admin.icon', ['name' => 'send'])</span><span class="stat-hint">closed loops</span></div>
            <div class="stat-value"><strong>{{ $messages->where('status', 'replied')->count() }}</strong><span class="stat-label">Replied</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-violet">@include('partials.admin.icon', ['name' => 'clock'])</span><span class="stat-hint">first response</span></div>
            <div class="stat-value"><strong>&lt; 1 day</strong><span class="stat-label">Target</span></div>
        </div>
    </div>

    @if ($messages->isEmpty())
        <div class="card">
            <div class="empty">
                <span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'mail'])</span>
                <h3>Your inbox is empty</h3>
                <p>When visitors submit the contact form on the site, their message appears here.</p>
            </div>
        </div>
    @else
        <div class="inbox-split">
            <div class="card inbox-list">
                @foreach ($messages as $message)
                    <a class="inbox-item{{ $active && $active->id === $message->id ? ' is-active' : '' }}" href="{{ route('admin.inbox.index', ['id' => $message->id]) }}">
                        <span class="avatar {{ ['v2', 'v3', 'v4'][$message->id % 3] }}">{!! strtoupper(mb_substr($message->name, 0, 1)) !!}</span>
                        <div class="ib-body">
                            <div class="ib-top">
                                <strong>{{ $message->name }}</strong>
                                <time>{{ $message->created_at->diffForHumans(short: true) }}</time>
                            </div>
                            <div class="ib-sub">{{ $message->service ?? 'General' }} — {{ \Illuminate\Support\Str::limit($message->message, 42) }}</div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="card thread">
                @if ($active)
                    <div class="thread-head">
                        <div>
                            <h2>{{ $active->name }}</h2>
                            <p class="thread-meta">{{ $active->email }}@if($active->phone) · {{ $active->phone }}@endif · {{ $active->created_at->format('j M Y, H:i') }}</p>
                        </div>
                        <div class="thread-actions">
                            @include('partials.admin.pill', ['value' => $active->status])
                        </div>
                    </div>

                    <div class="meta-grid">
                        <div class="meta-tile"><span>Interested in</span><strong>{{ $active->service ?? 'General' }}</strong></div>
                        <div class="meta-tile"><span>Received</span><strong>{{ $active->created_at->diffForHumans(short: true) }}</strong></div>
                        <div class="meta-tile"><span>Status</span><strong>{{ ucfirst($active->status) }}</strong></div>
                    </div>

                    <div class="thread-body">{{ $active->message }}</div>

                    <div class="thread-actions">
                        <a class="btn btn-dark" href="mailto:{{ $active->email }}?subject=Re: your enquiry to WebServicers">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M21 3 10.5 13.5M21 3l-6.5 18-4-8-8-4L21 3Z"/></svg>
                            Reply by email
                        </a>

                        @if ($active->status !== 'replied')
                            <form class="inline-form" method="post" action="{{ route('admin.messages.update', $active) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="replied" />
                                <button class="btn btn-white" type="submit">Mark as replied</button>
                            </form>
                        @endif

                        <form class="inline-form" method="post" action="{{ route('admin.messages.destroy', $active) }}" data-confirm="Delete this message?">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </div>
                @else
                    <div class="empty"><h3>No message selected</h3><p>Pick a conversation from the list.</p></div>
                @endif
            </div>
        </div>
    @endif
@endsection
