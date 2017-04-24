@extends('frontend.sesi.layouts.master')

@section('breadcrumb')
    <ul class="breadcrumb-local bg-cinza-claro">
        <li>
            <a href="{{ route('sesi.index') }}" class="casa-color">Transparência</a>
        </li>
        <span class="casa-color"> > </span>
        <li>
            <a href="../lei-de-diretrizes-orcamentarias" class="casa-color">Lei de Diretrizes Orçamentárias</a>
        </li>
        <span class="casa-color"> > </span>
        <li>
            Estrutura Remuneratória
        </li>
    </ul>
@stop

@section('title')
    Estrutura Remuneratória
@stop

@section('content')
    @if($remunera)
        <table class="table table-striped table-responsive" style=" font-size: 14px">
            <thead>
            <tr>
                <th>
                    <center>Cargo</center>
                </th>
                <th>
                    <center>Ponto Inicial (R$)*</center>
                </th>
                <th>
                    <center>Ponto Final (R$)*</center>
                </th>
                <th>
                    <center>Empregados</center>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($remunera as $rem)
                <tr>
                    <td> {{ $rem->cargo }}</td>
                    <td>R$ {{ number_format(isset( $rem->ponto_ini) ? $rem->ponto_ini : 0, 2, ',','.') }}</td>
                    <td>R$ {{ number_format(isset( $rem->ponto_ini) ? $rem->ponto_fin : 0, 2, ',','.') }}</td>
                    <td>
                        {{ $rem->empregados }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        Não possuem Registros
    @endif
@stop