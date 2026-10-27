@if ($paginator->hasPages())
    @php
        $start = max(1, $paginator->currentPage() - 2);
        $end = min($paginator->lastPage(), $paginator->currentPage() + 2);
    @endphp
    <nav class="pagination" aria-label="Pagination">
        @if ($paginator->onFirstPage())
            <span>←</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">←</a>
        @endif

        @if ($start > 1)
            <a href="{{ $paginator->url(1) }}">1</a>
            @if ($start > 2)<span>…</span>@endif
        @endif

        @for ($page = $start; $page <= $end; $page++)
            @if ($page === $paginator->currentPage())
                <span class="active">{{ $page }}</span>
            @else
                <a href="{{ $paginator->url($page) }}">{{ $page }}</a>
            @endif
        @endfor

        @if ($end < $paginator->lastPage())
            @if ($end < $paginator->lastPage() - 1)<span>…</span>@endif
            <a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">→</a>
        @else
            <span>→</span>
        @endif
    </nav>
@endif
