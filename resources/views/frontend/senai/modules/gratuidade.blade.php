@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    <ul class="breadcrumb-local bg-cinza-claro">
        <li>
            <a href="{{ route('senai.index') }}" class="casa-color">Transparência</a>
        </li>
        <span class="casa-color"> > </span>
        <li>
            Gratuidade
        </li>
    </ul>
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