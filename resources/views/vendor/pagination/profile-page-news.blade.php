@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="#" class="prevposts-link" style="pointer-events: none"><i class="fas fa-caret-left"></i></a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="prevposts-link"><i class="fas fa-caret-left"></i></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a href="#">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="#" class="current-page">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="nextposts-link"><i class="fas fa-caret-right"></i></a>
        @else
            <a href="#" class="nextposts-link" style="pointer-events: none"><i class="fas fa-caret-right"></i></a>
        @endif
    </div>
@endif
