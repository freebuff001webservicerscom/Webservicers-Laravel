{{-- Inline SVG icon set — keys match the reference site's ICONS dictionary. --}}
@switch($name)
    @case('search')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="10.5" cy="10.5" r="6.5" stroke="currentColor" stroke-width="1.7"/><path d="M15.4 15.4 21 21" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
        @break

    @case('target')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="12" r="4.5" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="12" r="1.3" fill="currentColor"/></svg>
        @break

    @case('chart')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 19V5M4 19h16" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M7.5 15.5 11 11l3 2.5L19 7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @break

    @case('users')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="9" cy="9" r="3.2" stroke="currentColor" stroke-width="1.7"/><path d="M3.5 19c.6-3 2.8-4.6 5.5-4.6s4.9 1.6 5.5 4.6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M16 6.5a3 3 0 0 1 0 5.6M17.5 14.6c2 .4 3.3 1.9 3.7 4.4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
        @break

    @case('shield')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3l7 3v5.5c0 4.4-2.9 7.9-7 9.5-4.1-1.6-7-5.1-7-9.5V6l7-3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 12.2l2.2 2.2L15.5 10" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @break

    @case('wallet')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="6" width="18" height="13" rx="3" stroke="currentColor" stroke-width="1.7"/><path d="M3 10h18" stroke="currentColor" stroke-width="1.7"/><circle cx="16.5" cy="14.5" r="1.1" fill="currentColor"/></svg>
        @break

    @case('layers')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3 3.5 7.5 12 12l8.5-4.5L12 3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="m3.5 12.5 8.5 4.5 8.5-4.5M3.5 17l8.5 4.5L20.5 17" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @break

    @case('tag')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12.5 3H20a1 1 0 0 1 1 1v7.5L11 21.5 2.5 13 12.5 3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><circle cx="17" cy="7" r="1.4" fill="currentColor"/></svg>
        @break

    @case('refresh')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M20 12a8 8 0 1 1-2.4-5.7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M20 3.5V8h-4.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @break

    @case('gauge')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 17a9 9 0 1 1 16 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M12 13.5 16 9" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><circle cx="12" cy="14" r="1.6" fill="currentColor"/></svg>
        @break

    @case('wand')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 20 15 9" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="m17 3 1 2.5L20.5 7 18 8.5 17 11l-1-2.5L13.5 7 16 5.5 17 3ZM7 4l.7 1.8L9.5 7 7.7 7.8 7 9.5l-.7-1.7L4.5 7l1.8-1.2L7 4Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
        @break

    @case('camera')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="7" width="18" height="13" rx="3" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="13.5" r="3.6" stroke="currentColor" stroke-width="1.7"/><path d="M8 7l1.5-2.5h5L16 7" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
        @break

    @case('heart')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 20s-7.5-4.4-7.5-9.2A4.3 4.3 0 0 1 12 7.6a4.3 4.3 0 0 1 7.5 3.2C19.5 15.6 12 20 12 20Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
        @break

    @case('bolt')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M13 2 4.5 13.5H11L10 22l8.5-11.5H12L13 2Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
        @break

    @case('clock')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.7"/><path d="M12 7.5V12l3 2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @break

    @case('code')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m8 8-4 4 4 4M16 8l4 4-4 4M13.5 5l-3 14" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @break

    @case('doc')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 3h8l4 4v14H6V3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M14 3v5h4M9 12h6M9 16h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
        @break

    @case('link')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M10 14a4 4 0 0 0 5.7 0l2.6-2.6a4 4 0 1 0-5.7-5.7L11.5 7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M14 10a4 4 0 0 0-5.7 0l-2.6 2.6a4 4 0 1 0 5.7 5.7L12.5 17" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
        @break

    @case('map')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 21s7-6 7-11a7 7 0 1 0-14 0c0 5 7 11 7 11Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><circle cx="12" cy="10" r="2.6" stroke="currentColor" stroke-width="1.7"/></svg>
        @break

    @case('star')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 3 2.6 5.6 6.1.8-4.5 4.2 1.2 6-5.4-3.1L6.6 19.6l1.2-6L3.3 9.4l6.1-.8L12 3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
        @break

    @case('message')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 5h16v11H9l-5 4V5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M8 9h8M8 12.5h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
        @break

    @case('globe')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.7"/><path d="M3.5 12h17M12 3.5c5 4.5 5 12.5 0 17-5-4.5-5-12.5 0-17Z" stroke="currentColor" stroke-width="1.7"/></svg>
        @break

    @case('palette')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3a9 9 0 1 0 0 18c1.4 0 2-1 2-2s-.6-2-.6-2.8c0-1 .8-1.7 1.8-1.7H18a3 3 0 0 0 3-3A9 9 0 0 0 12 3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><circle cx="8" cy="9" r="1.3" fill="currentColor"/><circle cx="12" cy="7" r="1.3" fill="currentColor"/><circle cx="16" cy="9" r="1.3" fill="currentColor"/></svg>
        @break

    @case('mail')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="3" stroke="currentColor" stroke-width="1.7"/><path d="m4.5 7.5 7.5 6 7.5-6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @break

    @case('phone')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 3.5h3l1.5 4-2 1.5a11 11 0 0 0 5 5l1.5-2 4 1.5v3a2 2 0 0 1-2.2 2A16.5 16.5 0 0 1 5 5.7 2 2 0 0 1 7 3.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
        @break

    @case('rocket')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M14 4c3-1 6-1 6-1s0 3-1 6-3 5-6 7l-3-3c2-3 4-6 4-9Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="m10 13-4 4M7 9l-3 1 1 3M15 17l-1 3-3-1" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><circle cx="15.5" cy="8.5" r="1.4" fill="currentColor"/></svg>
        @break

    @case('play')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.7"/><path d="M10 8.5 16 12l-6 3.5v-7Z" fill="currentColor"/></svg>
        @break

    @case('cart')
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 4h2l2.2 10.2h10.5L20 7H6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><circle cx="9" cy="19" r="1.4" fill="currentColor"/><circle cx="17" cy="19" r="1.4" fill="currentColor"/></svg>
        @break

    @case('arrow')
        <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @break

    @default
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3.5 8h8.5M8.5 4.5 12 8l-3.5 3.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
@endswitch
