<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <title>
        Lei de Diretrizes Orçamentárias - Institucional SENAI - Portal da indústria
    </title>
    <link rel="shortcut icon" type="image/png" href="https://static-cms-si.s3.amazonaws.com/img/favicon.png?">
    <link rel="stylesheet" href="{{ asset('public/frontend/senai/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/senai/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/senai/assets/css/custom.css') }}">

<body>
<!-- Fixed top bar -->
<div class="top-bar b-18">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-7 logos-col">
                <nav class="main-menu">
                    <ul class="cl">
                        <li>
                            <span class="imoon imoon-menu2"></span>
                            <a href="{{ route('senai.index') }}" data-url="/"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="logo gtm-menucasas ">
                            <a href="http://www.fiero.org.br"><img src="{{ asset('public/frontend/img/fiero.png') }}" alt="FIERO"></a>
                        </li>
                        <li class="logo gtm-menucasas ">
                            <a href="{{ route('sesi.index') }}"><img src="{{ asset('public/frontend/img/sesi.png') }}" alt="SESI"></a>
                        </li>
                        <li class="logo gtm-menucasas ">
                            <a href="{{ route('senai.index') }}"><img src="{{ asset('public/frontend/img/senai.png') }}" alt="SENAI"></a>
                        </li>
                        <li class="logo gtm-menucasas ">
                            <a href="http://www.ro.iel.org.br"><img src="{{ asset('public/frontend/img/iel.png') }}" alt="IEL"></a>
                        </li>
                        <li class="fr hidden-md hidden-sm hidden-lg" id="mobMenu">
                            <a href="javascript:void(0);"><i class="fa fa-bars"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Fixed top bar -->

@include('frontend.sesi.layouts.partials.menu_mobile')

<header id="mainHeader-2" class=" common-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3 class="ldo-title">TRANSPARÊNCIA SENAI</h3>
            </div>
        </div>
    </div>
</header>
<main class="main container">
    <div class="cont cl">
        <div class="row">
            <section class="col-xs-12 col-md-9">
                <div class="materia">
                    <div class="row">
                        <div class="col-md-12">
                            @yield('breadcrumb')
                        </div>
                    </div>
                    <br>
                    <h3><span style="color: #FA911A;"><strong>@yield('title')</strong></span></h3>
                    @yield('content')
                    <br>
                    <a href="{{ route('senai.sac') }}" class="btn btn-default btn-md btn-transparencia" role="button">
                        &nbsp; SAC - Serviço de Atendimento ao Consumidor &nbsp;
                    </a>
                </div>
            </section>
            <aside class="col-xs-12 col-md-3 aside-menu-2">

                @include('frontend.senai.layouts.partials.menu_lateral')

                <div class="canal-01-aside col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                </div>
            </aside>
        </div>
    </div>
</main>

<footer class="footer">
    <section class="footer-top">
        <div class="">
            <div class="container">
                <div class="c-c-17 col col-xs-12 col-sm-6 col-md-3 None">
                    <h4 class="title b-22">
                        Conheça o IEL
                        <span class="icone">+</span>
                    </h4>
                    <ul>
                        <li><a href="http://www.portaldaindustria.com.br/iel/institucional/o-que-e-o-iel/">O que o IEL
                                faz</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/iel/institucional/missao-visao-e-valores/">Missão,
                                Visão e Valores</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/iel/institucional/historia/">História</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/iel/institucional/estrutura/">Estrutura</a>
                        </li>
                        <li><a href="http://www.portaldaindustria.com.br/iel/institucional/relatorio-anual/">Relatório
                                Anual</a></li>
                        <li><a href="http://bancodeconsultores.sistemaindustria.org.br/bancodeconsultores/">Banco de
                                consultores</a></li>
                    </ul>
                    <h4 class="title b-22">
                        Conteúdos
                        <span class="icone">+</span>
                    </h4>
                    <ul>
                        <li><a href="http://www.portaldaindustria.com.br/iel/noticias">Notícias</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/iel/redes-sociais/">Redes Sociais</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/iel/videos/">Vídeos</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/publicacoes/">Publicações</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/iel/eventos/">Eventos</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/iel/canais/">Sites</a></li>
                    </ul>
                </div>
                <div class="c-c-17 col col-xs-12 col-sm-6 col-md-3 None">
                    <h4 class="title b-22">
                        Inovação
                        <span class="icone">+</span>
                    </h4>
                    <ul>
                        <li>
                            <a href="http://www.portaldaindustria.com.br/cni/canais/mobilizacao-empresarial-pela-inovacao/">Mobilizacao
                                Empresarial para Inovacao</a></li>
                        <li>
                            <a href="http://www.portaldaindustria.com.br/cni/canais/mobilizacao-empresarial-pela-inovacao/o-que-e-o-snei/">Rede
                                de Núcleos de Inovação</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/iel/canais/iel-gestao-da-inovacao/home/">Gestão
                                da Inovação</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/iel/canais/qualificacao-de-fornecedores-home/">Desenvolvimento
                                de Fornecedores</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/inovatalentos">Inova Talentos</a></li>
                    </ul>
                    <h4 class="title b-22">
                        Educação
                        <span class="icone">+</span>
                    </h4>
                    <ul>
                        <li><a href="http://www.portaldaindustria.com.br/iel/canais/iel-estagio/">Soluções em
                                Estágios</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/iel/canais/educacao-empresarial/">Capacitação
                                Empresarial</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/iel/canais/educacao-executiva-home/">Educação
                                Executiva</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/iel/canais/forum-iel-de-carreiras/">Fórum IEL
                                de Carreiras</a></li>
                    </ul>
                </div>
                <div class="c-c-17 col col-xs-12 col-sm-6 col-md-3 None">
                    <h4 class="title b-22">
                        Sistema Indústria
                        <span class="icone">+</span>
                    </h4>
                    <ul>
                        <li><a href="http://www.portaldaindustria.com.br/cni">CNI :: A força do Brasil indústria</a>
                        </li>
                        <li><a href="http://www.portaldaindustria.com.br/sesi">SESI :: Educação e qualidade de vida</a>
                        </li>
                        <li><a href="http://www.portaldaindustria.com.br/senai">SENAI :: Educação e inovação</a></li>
                        <li><a href="http://www.portaldaindustria.com.br/iel">IEL :: Conhecimento para a competitividade
                                empresarial</a></li>
                    </ul>
                </div>
                <div class="c-c-17 col special col-xs-12 col-sm-12 col-md-3 None">
                    <ul>
                        <li>
                            <a href="http://www.portaldaindustria.com.br/agenciacni/" class="b-21">
                                <i class="fa fa-newspaper-o b-17"></i>
                                Agência de notícias
                            </a>
                        </li>
                        <li>
                            <a href="http://www.portaldaindustria.com.br/imprensa" class="b-21">
                                <i class="fa fa-camera b-17"></i>
                                Imprensa
                            </a>
                        </li>
                        <li>
                            <a href="http://www.portaldaindustria.com.br/licitacoes" class="b-21">
                                <i class="fa fa-list-alt b-17"></i>
                                Licitações e Editais
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="footer-mid">
        <div class="">
            <div class="container">
                <section class="col-md-3 col-xs-6 col-c">
                    <div class="al-ta ">
                        <i class="fa fa-phone b-26"></i>
                        <div>
                            <h4 class="title b-17"><strong>SAC - Serviço de atendimento ao cliente</strong></h4>
                            <p class="b-16">0800-647 3551</p>
                        </div>
                    </div>
                </section>
                <section class="col-md-3 col-xs-12 col-b b-12">
                    <div class="title">
                        <div class="al-ta ">
                            <i class="fa fa-envelope-o b-12 b-12"></i>
                            <div><span><strong><a href="http://www.ro.sesi.org.br/portal/contato.php" target="_black">
                                            FALE CONOSCO</a></strong></span></div>
                        </div>
                    </div>
                    <div class="title">
                        <div class="al-ta ">
                            <i class="fa fa-user b-12 b-12"></i>
                            <div><span><strong><a href="http://www.vagas.com.br/cni"> BANCO DE
                                            TALENTOS</a></strong></span></div>
                        </div>
                    </div>
                </section>
                <section class="col-md-3 col-xs-6 col-c">
                    <div class="al-ta ">
                        <i class="fa fa-map-marker b-26"></i>
                        <div>
                            <h4 class="title b-17"><strong>Sede SESI Rondônia</strong></h4>
                            <p class="b-16">Rua Rui Barbosa, nº 1112</p>
                            <p class="b-16">Brasília - DF CEP 70040-903</p>
                            <p class="b-16">Porto Velho - RO - CEP 76.801-186</p>
                            <p class="b-16">(69) 3216-3400</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <section class="footer-bottom">
        <div class="">
            <div class="container">
                <div class="social fl">
                    <a href="https://www.facebook.com/cnibrasil" title="Facebook" target="_blank"><i
                                class="icon icon-facebook"></i></a>
                    <a href="https://plus.google.com/+PortaldaIndustriaBr/" title="Google Plus" target="_blank"><i
                                class="icon icon-google-plus"></i></a>
                    <a href="https://twitter.com/cni_br" title="Twitter" target="_blank"><i
                                class="icon icon-twitter"></i></a>
                    <a href="https://www.youtube.com/user/cniweb" title="YouTube" target="_blank"><i
                                class="icon icon-youtube"></i></a>
                </div>
                <div class="fr privacy b-10">
                    <a href="http://www.portaldaindustria.com.br/cni/institucional/politica-de-privacidade/">POLÍTICA DE
                        PRIVACIDADE</a>
                </div>
            </div>
        </div>
    </section>
</footer>
<script type="text/javascript" src="{{ asset('public/frontend/senai/assets/js/vendors.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/frontend/senai/assets/js/scripts.min.js') }}"></script>
<script type="text/javascript">var switchTo5x = true;</script>
<script type="text/javascript" src="{{ asset('public/frontend/senai/assets/js/buttons.min.js') }}"></script>
<script type="text/javascript">stLight.options({
        publisher: "2748b646-7a1b-4ee3-9bb8-b935df8709f1",
        doNotHash: false,
        doNotCopy: false,
        hashAddressBar: false
    });</script>
<script type="text/javascript" src="{{ asset('public/frontend/plugins/mask/dist/inputmask/inputmask.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/frontend/plugins/mask/dist/inputmask/jquery.inputmask.js') }}"></script>
@yield('scripts')
<script type="text/javascript" src="{{ asset('public/frontend/senai/assets/js/mustache.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/frontend/senai/assets/js/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('public/frontend/senai/assets/js/anmap.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/frontend/senai/assets/js/brazilLow.js') }}" type="text/javascript"></script>
</body>

</html>