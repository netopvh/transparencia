@extends('frontend.sesi.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('sesi.execucao') !!}
@stop

@section('sac-button')
    @include('frontend.sesi.layouts.partials.sac-button')
@stop

@section('title')
    Execução Orçamentária 2017
@stop

@section('content')
    <iframe src="http://ldo.portaldaindustria.com.br/publico/embed/205b172414509" height="2950" width="100%" frameborder="0" allowfullscreen=""></iframe>
@stop