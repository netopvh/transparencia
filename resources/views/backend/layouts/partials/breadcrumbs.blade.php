@if ($breadcrumbs)
    <div class="page-header">
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                @foreach ($breadcrumbs as $breadcrumb)
                    @if (!$breadcrumb->last)
                        <li><a href="{{ $breadcrumb->url }}"><i
                                        class="icon-home2 position-left"></i> {{ $breadcrumb->title }}</a></li>
                    @else
                        @if($breadcrumb->title == 'Home')
                            <li class="active"><i
                                        class="icon-home2 position-left"></i> {{ $breadcrumb->title }}</li>
                        @else
                            <li class="active">{{ $breadcrumb->title }}</li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endif