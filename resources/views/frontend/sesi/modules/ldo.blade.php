@extends('frontend.sesi.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('sesi.ldo') !!}
@stop

@section('sac-button')
    @include('frontend.sesi.layouts.partials.sac-button')
@stop

@section('title')
    Lei de Diretrizes Orçamentárias
@stop

@section('content')
    <div class="menu-estrutura">
        <p>O Departamento Regional do SESI publica a seguir o seu orçamento e execução orçamentária para ano
            de {{ date('Y') }}, a estrutura remuneratória e as relações com os nomes de seus dirigentes e membros do
            corpo técnico:</p>

        <br>
        <p><strong style="font-weight: bold">Departamento Regional - SESI RO</strong></p>

        <p>• <a href="{{ route('sesi.execucao') }}">Execução Orçamentária {{ date('Y') }}</a></p>

        @if($orc_atual)
            <p>• <a href="{{ url('/files/'.$orc_atual->file) }}"
                    target="_blank">{{ $tipos[$orc_atual->type] }} {{ $orc_atual->year }}</a></p>
        @else
            <p>• <a href="#" target="_blank">Orçamento Aprovado {{ date('Y') }}</a></p>
        @endif

        <p>• <a href="{{ route('sesi.remunera') }}" target="_self">Estrutura Remuneratória</a></p>

        <p>• <a href="{{ route('sesi.dirigentes') }}" target="_self">Relação de Dirigentes</a></p>

        <p>• <a href="{{ route('sesi.tecnicos') }}" target="_self">Relação dos Membros do Corpo Técnico</a></p>

        <p style="margin-left: 40px;">Execução Orçamentária de {{ \Carbon\Carbon::now()->subYear(1)->format('Y') }}
            , {{ \Carbon\Carbon::now()->subYear(2)->format('Y') }}
            e {{ \Carbon\Carbon::now()->subYear(3)->format('Y') }}:</p>

        @if(empty($years))
            <p style="margin-left: 40px;"><b>• Sem registros a serem exibidos</b></p>
        @else
            @foreach($years as $year)
                <p style="margin-left: 40px;">• <a href="{{ url('/files/'.$year->file) }}"
                                                   target="_blank">{{ $tipos[$year->type] }} do Departam
                        ento
                        Regional {{ $year->year }}</a></p>
            @endforeach
        @endif

    </div>
@stop