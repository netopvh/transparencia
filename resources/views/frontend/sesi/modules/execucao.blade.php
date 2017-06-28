@extends('frontend.sesi.layouts.master')

@section('breadcrumb')
    <ul class="breadcrumb-local bg-cinza-claro">
        <li>
            <a href="{{ route('sesi.index') }}" class="casa-color">Transparência</a>
        </li>
        <span class="casa-color"> > </span>
        <li>
            <a href="{{ route('sesi.ldo') }}" class="casa-color">Lei de Diretrizes Orçamentárias</a>
        </li>
        <span class="casa-color"> > </span>
        <li>
            Execução Orçamentária 2017
        </li>
    </ul>
@stop

@section('title')
    Execução Orçamentária 2017
@stop

@section('content')
    <iframe src="http://ldo.portaldaindustria.com.br/publico/embed/205b172414509" height="2950" width="100%" frameborder="0" allowfullscreen=""></iframe>
@stop