@extends('frontend.sesi.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('sesi.home') !!}
@stop

@section('sac-button')
    @include('frontend.sesi.layouts.partials.sac-button')
@stop

@section('content')
    <div class="materia"><p>Apesar de ser uma entidade privada, o SESI/SENAI sempre teve a sua gestão - contábil,
            financeira, orçamentária, operacional e patrimonial - controlada e fiscalizada pelo Tribunal de Contas da
            União, assim como o seu orçamento ratificado pela República.</p>

        <p>Mesmo não estando sujeito ás regras que regem a contratação pública, o SESI/SENAI adotou, já na década de 90,
            regulamento de licitações e contratos próprio.</p>

        <p>Antes mesmo de a Lei de Diretrizes Orçamentárias exigir, a entidade já publicava na internet dados de sua
            execução orçamentária.</p>

        <p>Ao disponibilizar agora os dados e as informações abaixo, o SESI/SENAI, assume publicamente, o compromisso de
            elevar o nível de transparência de sua gestão e de ampliar o conhecimento geral de sua realizações.</p>

    </div>
    <hr>
    <div>
        <ul>

            <li><strong class="casa-color"><strong><a
                                href="{{ route('sesi.ldo') }}">Lei de
                            Diretrizes Orçamentárias</a></strong></strong></li>

            <li><strong class="casa-color"><strong><a
                                href="{{ route('sesi.contabeis') }}">Demonstrações
                            Contábeis</a></strong></strong></li>

            <li><strong class="casa-color"><strong><a href="http://licitacao.fiero.org.br" target="_blank">Licitações e
                            Editais</a></strong></strong></li>

            <li><strong class="casa-color"><strong><a href="{{ route('sesi.convenio') }}">Contratos e Convênio</a></strong></strong></li>

            <li><strong class="casa-color"><strong><a href="{{ route('sesi.gratuidade') }}">Gratuidade</a></strong></strong>
            </li>

            <li><strong class="casa-color"><strong><a href="{{ route('sesi.integridade') }}">Integridade</a></strong></strong></li>

            <li><strong class="casa-color"><strong><a href="{{ route('sesi.infra') }}">Dados de Infraestrutura</a></strong></strong></li>

            <li><strong class="casa-color"><strong><a href="http://www.portaldaindustria.com.br/sesi/canais/transparencia/acesso-transparencia-dos-departamentos-regionais/">Acesso a Transparência nos Departamentos
                            Regionais</a></strong></strong></li>

        </ul>

    </div>

@stop
