@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="m-4">
    <div class="float-right">

        Showing
        <span class="font-medium">{{ $paginator->firstItem() }}</span>
        to
        <span class="font-medium">{{ $paginator->lastItem() }}</span>
        of
        <span class="font-medium">{{ $paginator->total() }}</span>
        results
    </div><br>
    <ul class="pagination justify-content-end">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled" >
            <a class="page-link" tabindex="-1" aria-label="{{ __('pagination.previous') }}">{!! __('pagination.previous') !!}</a>
        </li>
        @else
        <li class="page-item">
            <a wire:click="previousPage" class="page-link" rel="prev">
                {!! __('pagination.previous') !!}
            </a>
        </li>
        @endif

        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        {{--@if (is_string($element))
            <span aria-disabled="true">
                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
            </span>
        @endif--}}

        {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a class="page-link" tabindex="-1">{{ $page }}</a>
                        </li>
                    @else
                    <li class="page-item">
                        <a wire:click="gotoPage({{ $page }})" href="#" class="page-link" >
                            {{ $page }}
                        </a>
                    </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a wire:click="nextPage" rel="next" class="page-link">
                {!! __('pagination.next') !!}
            </a>
        </li>
        @else
        <li class="page-item disabled">
            <a class="page-link" aria-label="{{ __('pagination.next') }}">{!! __('pagination.next') !!}</a>
        </li>
        @endif
    </nav>
    
@endif
