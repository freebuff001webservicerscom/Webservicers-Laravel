@php
    $raw = trim((string) $value);
    $lower = strtolower($raw);
    $tone = match (true) {
        in_array($lower, ['active', 'published', 'completed', 'paid', 'succeeded', 'approved', 'granted', 'connected', 'resolved', 'replied', 'stored', 'delivered', 'indexed', 'redeemed', 'recovered', 'live', 'received']) => 'green',
        in_array($lower, ['pending', 'draft', 'paused', 'scheduled', 'new', 'read', 'preparing', 'in transit', 'open', 'expected', 'indexing', 'requested', 'in transit', 'normal', 'low', 'scheduled', 'pending']) => 'amber',
        in_array($lower, ['cancelled', 'failed', 'refunded', 'rejected', 'declined', 'lost', 'churned', 'expired', 'error', 'trashed', 'closed', 'denied', 'disabled', 'hidden', 'urgent', 'not connected', 'broken']) => 'red',
        in_array($lower, ['in_progress', 'processing', 'out for delivery', 'sent', 'shipped', 'high', 'recovered']) => 'blue',
        default => 'neutral',
    };
@endphp
<span class="pill {{ $tone }}"><i></i>{{ $raw }}</span>
