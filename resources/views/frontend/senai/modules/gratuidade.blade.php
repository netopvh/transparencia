@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('senai.gratuidade') !!}
@stop

@section('sac-button')
    @include('frontend.senai.layouts.partials.sac-button')
@stop

@section('title')
    Gratuidade
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            Em breve o SENAI RO publicará as informações referentes ao módulo de Gratuidade.
        </div>
    </div>
    <br><br>
@stop