@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('senai.gratuidade') !!}
@stop

@section('sac-button')
    @include('frontend.senai.layouts.partials.sac-button')
@stop

@section('title')
    Gratuidade
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h2>Atuação do SENAI em Gratuidade Regimental</h2>
            <p class="text-justify">
                O SENAI forma profissionais para 28 áreas da indústria brasileira,
                desde a iniciação profissional e a formação continuada, até cursos
                técnicos de nível médio e superior (graduação e pós-graduação).
                O SENAI aposta em formatos educacionais diferenciados e inovadores,
                que vão além do tradicional modelo de educação presencial, por intermédio
                de unidades fixas e móveis disponíveis em 2,7 mil municípios brasileiros.
            </p>
            <p class="text-justify">
                Além de oferecer educação profissional de qualidade, o SENAI apoia a
                competitividade da indústria brasileira, por meio da rede de Institutos
                SENAI de Inovação e Tecnologia, que contam com infraestrutura e profissionais
                capacitados para o desenvolvimento de produtos e processos inovadores.
                O SENAI também projetou os Institutos SENAI de Inovação (ISI), que têm como
                missão facilitar os projetos de pesquisa e de desenvolvimento e estimular as
                iniciativas de inovação e a formação de parques tecnológicos. Ainda com esse
                propósito, mantém os Institutos SENAI de Tecnologia em vários estados do país,
                oferecendo serviços laboratoriais, de metrologia, de consultorias técnicas
                especializadas e de desenvolvimento de produtos e processos industriais.
            </p>
            <p class="text-justify">
                Em 2008 foram incorporados ao Regimento do SENAI dispositivos normativos para
                ampliação gradual da oferta de vagas gratuitas nos Cursos Técnicos e de Formação
                Inicial e Continuada, até alcançar o patamar de 66,6% da Receita Líquida de
                Contribuição Compulsória Geral .
            </p>
            <p class="text-justify">
                Em 2016, dos recursos dessa receita líquida compulsória, 87% foram destinados à
                Educação Profissional e Tecnológica, resultando na realização de 2,6 milhões de
                matrículas, que totalizam mais de 242 milhões de alunos-horas, dos quais 48% foram
                em gratuidade regimental e 11% em bolsa de estudo, correspondendo, respectivamente,
                a 67% e a 8% da receita líquida compulsória.
            </p>
            <p class="text-justify">
                Os Departamentos do SENAI, nacional e regionais, estão trabalhando para, em breve,
                divulgar as suas ações e atividades gratuitas disponíveis.
            </p>
        </div>
    </div>
    <br><br>
@stop