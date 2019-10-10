@if ($paginator->hasPages())
<div id="pagination" class="pagination">
    <ul class="clearfix">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled prev_pagination" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span class="page-link" aria-hidden="true"> < </span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="ico-arrow-left4"></i></a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item active" aria-current="page"><a href={{$url}} class="active">{{ $page }}</a></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="ico-arrow-right4"></i></a>
        </li>
        @else
        <li class="page-item disabled next_pagination" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span class="page-link" aria-hidden="true"> > </span>
        </li>
        @endif
    </ul>
</div>
@endif
