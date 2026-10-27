@extends('admin.layout')

@section('pageTitle', 'Activity log')

@section('content')
    <div class="page-head">
      <div>
        <h1>Activity log<span class="dot">.</span></h1>
        <p class="page-sub">A complete audit trail of workspace actions — who changed what, and when.</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('admin.notifications.index') }}">Notifications</a>
      </div>
    </div>

    <div class="card">
        <div class="card-head bordered">
            <div>
                <p class="card-eyebrow">Audit</p>
                <h3 class="card-title">All activity</h3>
            </div>
            <span class="card-note">{{ $activities->total() }} entries</span>
        </div>

        @forelse ($activities as $activity)
            <div class="notif-item">
                <span class="chip tone-{{ str_contains($activity->action, 'deleted') || str_contains($activity->action, 'removed') ? 'red' : (str_contains($activity->action, 'created') || str_contains($activity->action, 'added') ? 'green' : 'blue') }}">
                    @include('partials.admin.icon', ['name' => str_contains($activity->action, 'page') ? 'globe' : (str_contains($activity->action, 'order') ? 'receipt' : 'activity')])
                </span>
                <div class="n-body">
                    <p>{{ $activity->subject ?? $activity->action }}</p>
                    <span>{{ $activity->user?->name ?? 'System' }} · <code style="font-size: 11.5px;">{{ $activity->action }}</code></span>
                </div>
                <time>{{ $activity->created_at?->format('j M Y, H:i') }}</time>
            </div>
        @empty
            <div class="empty">
                <span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'activity'])</span>
                <h3>No activity recorded</h3>
                <p>Edits to pages, orders, customers and settings appear here.</p>
            </div>
        @endforelse

        <div class="pagination-wrap">
            @include('partials.admin.pagination', ['paginator' => $activities])
        </div>
    </div>
@endsection
