@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('senai.tecnicos') !!}
@stop

@section('sac-button')
    @include('frontend.senai.layouts.partials.sac-button')
@stop

@section('title')
    Corpo Técnico
@stop

@section('content')
    @if($tecnicos)
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
    <div class="text-size-mini">
        <span><b>Notas Informativas</b></span><br>
        @if(!is_array($nota))
            {!! nl2br($nota->notas) !!}
        @else
            -
        @endif
    </div>
    <div class="text-size-mini" style="margin-top: 40px; margin-bottom: 20px"><b>Última atualização
            em: </b>{{ count($tecnicos)>=1?$tecnicos->last()->created_at->format('d/m/Y'):'' }}</div>
@stop