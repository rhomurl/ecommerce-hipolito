@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="m-4">
        <ul class="pagination justify-content-end">
            {{--@if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
            @else
                <li class="page-item">
                    <a wire:click="previousPage" class="page-link" >Previous</a>
                </li>
            @endif

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a wire:click="nextPage" class="page-link" >Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#">Next</a>
                </li>
            @endif--}}
        

        
            {{--
            <div>
                <p class="text-sm text-gray-700 leading-5">
                    Showing
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    of
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    results
                </p>
            </div>
            --}}


                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" >
                            <a class="page-link" tabindex="-1" aria-label="{{ __('pagination.previous') }}">Previous</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a wire:click="previousPage" class="page-link" aria-label="{{ __('pagination.previous') }}">Previous</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
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
                        <a wire:click="nextPage" rel="next" class="page-link" aria-label="{{ __('pagination.next') }}">Next</a>
                    </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" aria-label="{{ __('pagination.next') }}">Next</a>
                        </li>
                    @endif
        </ul>
    </nav>
   
@endif

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
@endsection