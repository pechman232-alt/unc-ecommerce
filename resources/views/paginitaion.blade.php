@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link page-link-prev" href="javascript:void(0)" aria-label="Previous" tabindex="-1"
                        aria-disabled="true">
                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link page-link-prev" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous" tabindex="-1"
                        aria-disabled="true">
                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                    </a>
                </li>
            @endif
            
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><a class="page-link" href="javascript:void(0)">{{ $element }}</a></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page =>$url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><a class="page-link" href="javascript:void(0)">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link page-link-next" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                        Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link page-link-next" href="javascript:void(0)" aria-label="Next">
                        Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                    </a>
                </li>
            @endif
            
        </ul>
    </nav>
@endif