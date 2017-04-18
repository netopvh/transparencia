@extends('frontend.sesi.layouts.master')

@section('breadcrumb')
    <ul class="breadcrumb-local bg-cinza-claro">
        <li>
            <a href="{{ url('/') }}">Transparência</a><span class="separator casa-color"
                                                                         style="font-size: 12px; margin-left: 5px; mergin-right: 5px;"><i
                        class="fa fa-angle-right"></i></span>
        </li>
        <li>
            <a href="#" class="casa-color">Lei de Diretrizes
                Orçamentárias</a><span class="separator casa-color"
                                       style="font-size: 12px; margin-left: 5px; mergin-right: 5px;"></span>
        </li>
    </ul>
@stop

@section('content')
    @if(isset($descritivo))
        {!! $descritivo->script !!}
    @endif
    <hr>
    @if(isset($menu_centro))
        {!! $menu_centro->script !!}
    @endif
@stop