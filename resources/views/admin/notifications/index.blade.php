@extends('admin.layout')

@section('pageTitle', 'Notifications & activity')

@section('content')
    <div class="page-head">
      <div>
        <h1>Notifications<span class="dot">.</span></h1>
        <p class="page-sub">Workspace bells and the audit trail behind them — new orders, messages and settings changes.</p>
      </div>
      <div class="page-actions">
        <form method="post" action="{{ route('admin.notifications.read-all') }}">
          @csrf
          <button class="btn btn-white" type="submit">Mark all read</button>
        </form>
        <a class="btn btn-dark" href="{{ route('admin.activity.index') }}">Full activity log</a>
      </div>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-amber">@include('partials.admin.icon', ['name' => 'bell'])</span><span class="stat-hint">need attention</span></div>
            <div class="stat-value"><strong>{{ $unread }}</strong><span class="stat-label">Unread</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'inbox'])</span><span class="stat-hint">all time</span></div>
            <div class="stat-value"><strong>{{ $notices->count() }}</strong><span class="stat-label">Notifications</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-green">@include('partials.admin.icon', ['name' => 'activity'])</span><span class="stat-hint">recorded</span></div>
            <div class="stat-value"><strong>{{ $activities->total() }}</strong><span class="stat-label">Activity entries</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-violet">@include('partials.admin.icon', ['name' => 'users'])</span><span class="stat-hint">contributing</span></div>
            <div class="stat-value"><strong>{{ \App\Models\User::count() }}</strong><span class="stat-label">Team members</span></div>
        </div>
    </div>

    <div class="card">
        <div class="card-head bordered">
            <div>
                <p class="card-eyebrow">Inbox</p>
                <h3 class="card-title">Notifications</h3>
            </div>
            <span class="card-note">{{ $unread }} unread</span>
        </div>

        @forelse ($notices as $notice)
            <div class="notif-item{{ $notice->read_at ? '' : ' unread' }}">
                <span class="chip tone-{{ ['order' => 'green', 'message' => 'blue', 'success' => 'green', 'warning' => 'amber', 'info' => 'violet'][$notice->kind] ?? 'blue' }}">
                    @include('partials.admin.icon', ['name' => $notice->kind === 'order' ? 'receipt' : ($notice->kind === 'message' ? 'mail' : 'bell')])
                </span>
                <div class="n-body">
                    <p>{{ $notice->title }}</p>
                    <span>{{ $notice->body }}</span>
                </div>
                <time>{{ $notice->created_at->diffForHumans(short: true) }}</time>
                @unless ($notice->read_at)
                    <form class="inline-form" method="post" action="{{ route('admin.notifications.read', $notice) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-white btn-sm" type="submit">Mark read</button>
                    </form>
                @endunless
            </div>
        @empty
            <div class="empty">
                <span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'bell'])</span>
                <h3>No notifications</h3>
                <p>New orders and contact messages will ping you here.</p>
            </div>
        @endforelse
    </div>

    <div class="card">
        <div class="card-head bordered">
            <div>
                <p class="card-eyebrow">Audit</p>
                <h3 class="card-title">Recent activity</h3>
            </div>
            <span class="card-note">{{ $activities->total() }} entries</span>
        </div>

        @forelse ($activities as $activity)
            <div class="notif-item">
                <span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'activity'])</span>
                <div class="n-body">
                    <p>{{ $activity->subject ?? $activity->action }}</p>
                    <span>{{ $activity->user?->name ?? 'System' }} · {{ $activity->action }}</span>
                </div>
                <time>{{ $activity->created_at?->diffForHumans(short: true) }}</time>
            </div>
        @empty
            <div class="empty"><h3>No activity yet</h3><p>Every change you make in the workspace is logged here.</p></div>
        @endforelse

        <div class="pagination-wrap">
            @include('partials.admin.pagination', ['paginator' => $activities])
        </div>
    </div>
@endsection
