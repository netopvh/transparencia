@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('senai.unidades') !!}
@stop

@section('scripts')
    <script src="{{ asset('frontend/senai/assets/js/app.js') }}"></script>
@stop

@section('title')
    Contato nos Estados
@stop

@section('sac')
    @include('frontend.senai.layouts.partials.sac')
@stop

@section('content')

    <div class="col-xs-12" id="unidades">
        <p class="common-space"><strong>Unidades</strong></p>
    </div>

    <div class="unidades-proximas-lo-2">
        <section id="container-resultado">
            <div id="mapa-buscar-resultado">
                <div class="resultado-container">

                </div>
            </div>
        </section>
    </div>
@stop