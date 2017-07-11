@extends('frontend.sesi.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('sesi.integridade') !!}
@stop

@section('sac-button')
    @include('frontend.sesi.layouts.partials.sac-button')
@stop

@section('title')
    Integridade
@stop

@section('content')
    O SESI, mesmo sendo uma entidade privada não integrante da Administração Pública,
    presta contas anuais ao Tribunal de Contas da União, desde o advento da Lei 2.613/55.
    <br><br>
    Essa fiscalização, que traduz uma das mais efetivas formas de controle, transparência e
    integridade, foi ratificada pelo parágrafo único art.70 da CF/88 e pelo art. 5º, V, da
    Lei 8.443/93 e conta, agora, com o apoio da Controladoria Geral da União.
    <br><br>
    Além da fiscalização do TCU, as contas dos departamentos do SESI, na forma de seu Regimento,
    são submetidas a auditores independentes que emitem seus pareceres.
    <br><br>
    @foreach($integridades as $integridade)
        @if($integridade->type === 'A')
            <div class="row">
                <div class="col-md-11 col-md-offset-1">
                    <h3 class="t p-20"><strong>{{ str_limit($tipos[$integridade->type],3,'') }}</strong></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-11 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <a href="{{ url('/files/'.$integridade->file) }}"
                                   target="_blank"><i class="fa fa-download" style="color: #000; margin-right: 10px;"></i>​{{ $tipos[$integridade->type] }} {{ $integridade->year }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-11 col-md-offset-1">
                    <h3 class="t p-20"><strong>{{ $tipos[$integridade->type] }}</strong></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-11 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <a href="{{ url('/files/'.$integridade->file) }}"
                                   target="_blank"><i class="fa fa-download" style="color: #000; margin-right: 10px;"></i>{{ $tipos[$integridade->type] }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach


    <br>
    <h5><strong>Última atualizaçao em: </strong>15/02/2017</h5>
@stop