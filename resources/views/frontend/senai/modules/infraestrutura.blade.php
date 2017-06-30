@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('senai.infra') !!}
@stop

@section('title')
    Dados da Infraestrutura
@stop

@section('content')
    Este módulo contém informações sobre as escolas e as unidades em que o SENAI
    desenvolve as suas atividades, incluindo endereço, telefone e responsáveis.
    <br><br>
    <div class="row">
        <div class="col-xs-12">
            <h4>Em Desenvolvimento</h4>
        </div>
    </div>
@stop