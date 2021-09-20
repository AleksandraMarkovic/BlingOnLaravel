@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" id="link{{$page}}" data-page="{{$page}}" href="#">{{$page}}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" id="link{{$page}}" data-page="{{$page}}" href="#">{{$page}}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

        </ul>
    </nav>
@endif
