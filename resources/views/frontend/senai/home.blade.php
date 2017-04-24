@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('sesi.home') !!}
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
