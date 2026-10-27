@extends('dashboard.layout')

@section('pageTitle', 'Order '.$order->reference)
@section('crumb', 'Orders')

@section('content')
    <div class="page-head">
      <div>
        <h1>{{ $order->reference }}<span class="dot">.</span></h1>
        <p class="page-sub">{{ $order->service ?? 'Service' }} · ${{ number_format((float) $order->amount, 2) }} · placed {{ $order->placed_on?->format('j M Y') ?? 'recently' }}</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('dashboard.orders.index') }}">Back to orders</a>
        <span class="btn" style="pointer-events:none;">@include('partials.admin.pill', ['value' => $order->status])</span>
      </div>
    </div>

    <div class="card card-pad">
        <div class="thread-head">
            <div>
                <p class="card-eyebrow">Order conversation</p>
                <h2>{{ $order->service ?? 'Your order' }}</h2>
                <p class="thread-meta">Messages here are seen by you and the {{ $siteName }} team working on this order.</p>
            </div>
        </div>

        @if ($messages->isEmpty())
            <div class="empty">
                <span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'message'])</span>
                <h3>No messages yet</h3>
                <p>Say hello, share assets or ask a question — the team replies right here.</p>
            </div>
        @else
            <div class="chat-list">
                @foreach ($messages as $message)
                    @php
                        $mine = $message->user_id !== null && $message->user_id === auth()->id();
                        $who = $message->user_id === null ? 'Support team' : ($mine ? 'You' : ($message->user?->name ?? 'Support team'));
                        $initials = trim(strtoupper(implode('', array_map(fn (string $p): string => mb_substr($p, 0, 1), preg_split('/\s+/', trim($who)) ?: []))));
                    @endphp
                    <div class="chat-row{{ $mine ? ' mine' : '' }}">
                        <span class="chat-avatar">{{ mb_substr($initials, 0, 2) }}</span>
                        <div class="chat-msg">
                            <div class="chat-bubble">{{ $message->body }}</div>
                            <div class="chat-meta">{{ $who }} · {{ $message->created_at->diffForHumans(short: true) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <form class="chat-composer" method="post" action="{{ route('dashboard.orders.chat.send', $order) }}">
            @csrf
            <textarea name="body" maxlength="4000" required placeholder="Write a message about this order…"></textarea>
            <div class="chat-send">
                <button class="btn btn-dark" type="submit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m4 12 16-7-5 15-3.5-5.5L4 12Z"/></svg>
                    Send message
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
  // Gentle refresh — only when nothing is being typed, so drafts survive.
  setTimeout(function () {
    var box = document.querySelector('.chat-composer textarea');
    if (!box || !box.value.trim()) window.location.reload();
  }, 15000);
</script>
@endsection
