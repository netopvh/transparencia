@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('senai.tecnicos') !!}
@stop

@section('title')
    Corpo Técnico
@stop

@section('content')
    @if($tecnicos)
        <table class="table table-striped table-responsive" style=" font-size: 14px">
            <thead>
            <tr>
                <th>
                    <center>Nome</center>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($tecnicos as $tecnico)
                <tr>
                    <td> {{ $tecnico->nome }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        Não possuem Registros
    @endif
@stop