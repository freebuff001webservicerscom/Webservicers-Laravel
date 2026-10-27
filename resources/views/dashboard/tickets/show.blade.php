@extends('dashboard.layout')

@section('pageTitle', $ticket->subject)
@section('crumb', 'Support tickets')

@section('content')
    <div class="page-head">
      <div>
        <h1>{{ $ticket->subject }}<span class="dot">.</span></h1>
        <p class="page-sub">Opened {{ $ticket->created_at->diffForHumans(short: true) }} · {{ $replies->count() }} {{ Str::plural('message', $replies->count()) }} in this ticket</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('dashboard.tickets.index') }}">Back to tickets</a>
        <span class="btn" style="pointer-events:none;">@include('partials.admin.pill', ['value' => $ticket->status])</span>
        <span class="btn" style="pointer-events:none;">@include('partials.admin.pill', ['value' => $ticket->priority])</span>
      </div>
    </div>

    <div class="card card-pad">
        <div class="thread-head">
            <div>
                <p class="card-eyebrow">Ticket conversation</p>
                <h2>Thread</h2>
                <p class="thread-meta">Replies from you and the {{ $siteName }} support team, oldest first.</p>
            </div>
        </div>

        <div class="chat-list">
            @foreach ($replies as $reply)
                @php
                    $mine = $reply->user_id !== null && $reply->user_id === auth()->id();
                    $who = $reply->user_id === null ? 'Support team' : ($mine ? 'You' : ($reply->user?->name ?? 'Support team'));
                    $initials = trim(strtoupper(implode('', array_map(fn (string $p): string => mb_substr($p, 0, 1), preg_split('/\s+/', trim($who)) ?: []))));
                @endphp
                <div class="chat-row{{ $mine ? ' mine' : '' }}">
                    <span class="chat-avatar">{{ mb_substr($initials, 0, 2) }}</span>
                    <div class="chat-msg">
                        <div class="chat-bubble">{{ $reply->body }}</div>
                        <div class="chat-meta">{{ $who }} · {{ $reply->created_at->diffForHumans(short: true) }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <form class="chat-composer" method="post" action="{{ route('dashboard.tickets.reply', $ticket) }}">
            @csrf
            <textarea name="body" maxlength="4000" required placeholder="Add a reply to this ticket…"></textarea>
            <div class="chat-send">
                <button class="btn btn-dark" type="submit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m4 12 16-7-5 15-3.5-5.5L4 12Z"/></svg>
                    Send reply
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
  setTimeout(function () {
    var box = document.querySelector('.chat-composer textarea');
    if (!box || !box.value.trim()) window.location.reload();
  }, 15000);
</script>
@endsection
