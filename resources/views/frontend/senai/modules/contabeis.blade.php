@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('senai.contabeis') !!}
@stop

@section('sac-button')
    @include('frontend.senai.layouts.partials.sac-button')
@stop

@section('title')
    Demonstrações Contábeis
@stop

@section('content')
    <h4><strong>Departamento Regional - SESI RO</strong></h4>
    <p>Acesso as demonstrações contábeis {{ \Carbon\Carbon::now()->subYear(1)->format('Y') }}.</p>
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <h3 class="t p-20"><strong></strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            @if(count($contas) >= 1)
                @foreach($contas as $conta)
                    <div class="row">
                        <div class="col-md-12 menu-estrutura">
                            <p>
                                <a href="{{ url('/files/'.$conta->file) }}" target="_blank"><i class="fa fa-download" style="color: #000; margin-right: 10px;"></i>{{ $tipos[$conta->type] }};</a>
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row">
                    <div class="col-md-12">
                        <b>Sem Registros Cadastrados</b>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <br>
    @if(count($contas) >= 1)
        <h5>
            <strong>Última atualizaçao
                em: </strong>{{ $contas->last()->updated_at->format('d/m/Y') }}
        </h5>
    @else
        <h5>--</h5>
    @endif
@stop