@if ($breadcrumbs)
    <ul class="breadcrumb-local bg-cinza-claro">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$breadcrumb->last)
                <li>
                    <a href="{{ $breadcrumb->url }}">
                        @if($breadcrumb->first)
                            <i class="icon-home2 position-left"></i>
                        @endif
                        <span class="casa-color">{{ $breadcrumb->title }} ></span>
                    </a>
                </li>
            @else
                <li class="active">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
    </ul>
@endif