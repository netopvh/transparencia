@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('senai.estrutura') !!}
@stop

@section('sac-button')
    @include('frontend.senai.layouts.partials.sac-button')
@stop

@section('title')
    Estrutura Remuneratória
@stop

@section('content')
    @if($remunera)
        @if(!is_array($files))
            <div class="row">
                <div class="col-xs-12 pull-right">
                    @foreach($files as $file)
                        <a href="{{ url('files/'.$file->file) }}" target="_blank"
                           class="btn btn-default btn-md pull-right btn-pdf-transparencia">SALVAR.{{ $type[$file->type] }}</a>
                    @endforeach
                </div>
            </div>
        @endif
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
    <div class="text-size-mini">
        <span><b>Notas Informativas</b></span><br>
        @if(!is_array($nota))
            {!! nl2br($nota->notas) !!}
        @else
            -
        @endif
    </div>
    <div class="text-size-mini" style="margin-top: 40px; margin-bottom: 20px"><b>Última atualização
            em: </b>{{ count($remunera)>=1?$remunera->last()->created_at->format('d/m/Y'):'' }}</div>
@stop