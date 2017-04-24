@extends('backend.layouts.master')

@section('styles')
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/'.$dir.'/css/elfinder.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/'.$dir.'/css/theme.css') }}">
@stop

@section('scripts-after')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="{{ asset('public/'.$dir.'/js/elfinder.min.js') }}"></script>
    @if($locale)
        <script src="{{ asset('public/'.$dir."/js/i18n/elfinder.$locale.js") }}"></script>
    @endif
    <script type="text/javascript" charset="utf-8">
        // Documentation for client options:
        // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
        $().ready(function () {
            $('#elfinder').elfinder({
                @if($locale)
                lang: '{{ $locale }}', // locale
                @endif
                customData: {
                    _token: '{{ csrf_token() }}'
                },
                url: '{{ route("elfinder.connector") }}',  // connector URL
                soundPath: '{{ asset($dir . '/sounds') }}'
            });
        });
    </script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Gerenciamento de Arquivos</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="elfinder"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop