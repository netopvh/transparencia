@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('senai.page', $pagina) !!}
@stop

@section('title')
{{ $pagina->title }}
@stop

@section('content')
    {!! $pagina->script !!}
@stop