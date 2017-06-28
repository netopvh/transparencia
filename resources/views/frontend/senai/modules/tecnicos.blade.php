@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    <ul class="breadcrumb-local bg-cinza-claro">
        <li>
            <a href="{{ route('senai.index') }}" class="casa-color">Transparência</a>
        </li>
        <span class="casa-color"> > </span>
        <li>
            <a href="{{ route('senai.ldo') }}" class="casa-color">Lei de Diretrizes Orçamentárias</a>
        </li>
        <span class="casa-color"> > </span>
        <li>
            Corpo Técnico
        </li>
    </ul>
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