@extends('frontend.sesi.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('sesi.gratuidade') !!}
@stop

@section('sac-button')
    @include('frontend.sesi.layouts.partials.sac-button')
@stop

@section('title')
    Gratuidade
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h2>Atuação do SESI em Gratuidade Regulamentar</h2>
            <p class="text-justify">
                O SESI, para responder ao desafio das empresas de contar com um
                capital humano capaz de interagir com as novas tecnologias e
                processos produtivos, mantém rede de escolas que oferecem educação
                básica e educação de jovens e adultos para os trabalhadores da
                indústria e seus dependentes em todos os estados da Federação,
                assim como desenvolve ações de educação continuada de competências
                requeridas pelo setor industrial.
            </p>
            <p class="text-justify">
                O SESI também oferece às empresas e aos industriários programas de
                promoção da qualidade de vida, especialmente, nas áreas de segurança
                e medicina do trabalho e da saúde, de forma a aumentar a produtividade
                da indústria e o seu papel decisivo no fortalecimento e no desenvolvimento
                sustentável do Brasil.
            </p>
            <p class="text-justify">
                Em 2008, foram incorporados ao Regulamento do SESI dispositivos estabelecendo
                a ampliação gradual de recursos provenientes da receita compulsória para a
                educação e para gratuidade que, até atingir em seis anos, a meta de 33,33%
                da Receita Líquida de Contribuição Compulsória  em educação básica e continuada,
                dos quais a metade destinados a vagas gratuitas.
            </p>
            <p class="text-justify">
                Em 2016, dos recursos desta receita líquida compulsória 49% foram destinadas
                à educação básica e continuada, resultando em 1,7 milhão de matrículas, das
                quais 39% em gratuidade regulamentar e 27% em bolsas de estudos, correspondendo,
                respectivamente, a 20% e a 4% da receita compulsória líquida.
            </p>
            <p class="text-justify">
                Os Departamentos do SESI, nacional e regionais, estão trabalhando para, em breve, divulgar as suas ações e atividades gratuitas disponíveis.
            </p>
        </div>
    </div>
    <br><br>
@stop