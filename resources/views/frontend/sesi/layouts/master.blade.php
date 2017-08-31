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
    <link rel="stylesheet" href="{{ asset('frontend/sesi/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/sesi/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/sweetalert/dist/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/sesi/assets/css/custom.css') }}">

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
                            <a href="{{ route('sesi.index') }}" data-url="/"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="logo gtm-menucasas ">
                            <a href="http://www.fiero.org.br"><img src="{{ asset('frontend/img/fiero.png') }}" alt="FIERO"></a>
                        </li>
                        <li class="logo gtm-menucasas ">
                            <a href="http://www.ro.sesi.org.br/portal/"><img src="{{ asset('frontend/img/sesi.png') }}" alt="SESI"></a>
                        </li>
                        <li class="logo gtm-menucasas ">
                            <a href="http://ro.senai.br/"><img src="{{ asset('frontend/img/senai.png') }}" alt="SENAI"></a>
                        </li>
                        <li class="logo gtm-menucasas ">
                            <a href="http://www.ro.iel.org.br"><img src="{{ asset('frontend/img/iel.png') }}" alt="IEL"></a>
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
                <h3 class="ldo-title">TRANSPARÊNCIA SESI</h3>
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
                    <h3><span style="color: #008000;"><strong>@yield('title')</strong></span></h3>
                    @yield('content')
                    <br>
                    @yield('sac-button')
                </div>
            </section>
            <aside class="col-xs-12 col-md-3 aside-menu-2">

                <div class="aside-menu-2">
                    @include('frontend.sesi.layouts.partials.menu_lateral')
                </div>
                <br>
                @yield('sac')
            </aside>
        </div>
    </div>
</main>

<footer class="footer">
    <section class="footer-mid">
        <div class="">
            <div class="container">
                <section class="col-md-3 col-xs-6 col-c">
                    <div class="al-ta ">
                        <i class="fa fa-phone b-26"></i>
                        <div>
                            <h4 class="b-15"><strong>SAC - Serviço de atendimento ao cliente</strong></h4>
                            <p class="b-14">0800-647 3551</p>
                        </div>
                    </div>
                </section>
                <section class="col-md-3 col-xs-12 col-b b-12">
                    <div class="title">
                        <div class="al-ta ">
                            <i class="fa fa-envelope-o b-12 b-12"></i>
                            <div><span><strong><a href="{{ route('sesi.sac') }}">
                                            FALE CONOSCO</a></strong></span></div>
                        </div>
                    </div>
                    <div class="title">
                        <div class="al-ta ">
                            <i class="fa fa-user b-12 b-12"></i>
                            <div><span><strong><a href="http://talentos.ro.senai.br/"> BANCO DE
                                            TALENTOS</a></strong></span></div>
                        </div>
                    </div>
                </section>
                <section class="col-md-3 col-xs-6 col-c">
                    <div class="al-ta ">
                        <i class="fa fa-map-marker b-26"></i>
                        <div>
                            <h4 class="title b-15"><strong>Sede SESI Rondônia</strong></h4>
                            <p class="b-14">Rua Rui Barbosa, nº 1112</p>
                            <p class="b-14">Porto Velho - RO - CEP 76.801-186</p>
                            <p class="b-14">(69) 3216-3400</p>
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
<script type="text/javascript" src="{{ asset('frontend/sesi/assets/js/vendors.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/sesi/assets/js/scripts.min.js') }}"></script>
<script type="text/javascript">var switchTo5x = true;</script>
<script type="text/javascript" src="{{ asset('frontend/sesi/assets/js/buttons.min.js') }}"></script>
<script type="text/javascript">stLight.options({
        publisher: "2748b646-7a1b-4ee3-9bb8-b935df8709f1",
        doNotHash: false,
        doNotCopy: false,
        hashAddressBar: false
    });
</script>
<script type="text/javascript" src="{{ asset('frontend/plugins/mask/dist/inputmask/inputmask.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/mask/dist/inputmask/jquery.inputmask.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/validation/validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/validation/localization/messages_pt_BR.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
@yield('scripts')
<script type="text/javascript" src="{{ asset('frontend/sesi/assets/js/mustache.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/sesi/assets/js/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/sesi/assets/js/anmap.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/sesi/assets/js/brazilLow.js') }}" type="text/javascript"></script>
</body>

</html>