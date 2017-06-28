@extends('frontend.sesi.layouts.master')

@section('breadcrumb')
    <ul class="breadcrumb-local bg-cinza-claro">
        <li>
            <a href="{{ route('sesi.index') }}" class="casa-color">Transparência</a>
        </li>
        <span class="casa-color"> > </span>
        <li>
            Demonstrações Contábeis
        </li>
    </ul>
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
                                <a href="{{ url('/files/contabil/'.$conta->file) }}" target="_blank"><i class="fa fa-download" style="color: #000; margin-right: 10px;"></i>{{ $tipos[$conta->type] }};</a>
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
                em: </strong>{{ \Carbon\Carbon::parse($contas->last()->updated_at)->format('d/m/Y') }}
        </h5>
    @else
        <h5>--</h5>
    @endif
@stop