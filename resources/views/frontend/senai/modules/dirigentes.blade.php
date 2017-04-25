@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    <ul class="breadcrumb-local bg-cinza-claro">
        <li>
            <a href="{{ route('senai.index') }}" class="casa-color">Transparência</a>
        </li>
        <span class="casa-color"> > </span>
        <li>
            <a href="../lei-de-diretrizes-orcamentarias-1" class="casa-color">Lei de Diretrizes Orçamentárias</a>
        </li>
        <span class="casa-color"> > </span>
        <li>
            Dirigentes
        </li>
    </ul>
@stop

@section('title')
    Dirigentes
@stop

@section('content')
    @if($dirigentes)
        <table class="table table-striped table-responsive" style=" font-size: 14px">
            <thead>
            <tr>
                <th>
                    <center>Nome</center>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($dirigentes as $dirigente)
                <tr>
                    <td> {{ $dirigente->nome }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        Não possuem Registros
    @endif
@stop