@if ($paginator->hasPages())
    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
        @if ($paginator->onFirstPage())
        <a class="pagination-previous disabled">Previous</a>
        @else
        <a class="pagination-previous disabled" href="{{ $paginator->previousPageUrl() }}">Previous</a>
        @endif
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next">Next page</a>
            @else
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next disabled">Next page</a>
            @endif
            <ul class="pagination-list">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                        <li><a class="pagination-link" aria-label="Goto page {{ $element }}">{{ $element }}</a></li>
                    @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                                <li><a class="pagination-link is-current" aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
                            @else
                            <li><a class="pagination-link" href="{{ $url }}"  aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
                            @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
@endif
