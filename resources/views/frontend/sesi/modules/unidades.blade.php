@extends('frontend.sesi.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('sesi.unidades') !!}
@stop

@section('scripts')
    <script src="{{ asset('frontend/sesi/assets/js/app.js') }}"></script>
@stop

@section('title')
    Contato nos Estados
@stop

@section('content')
    <p class="col-xs-12"><strong>Unidades mais próximas</strong></p>
    <div class="col-xs-12">
        <div class="select-style canal-03 casa-color spacer">
            <select id="select-unidades-estados" class="estados-json c-18">
                <option data-id="" value="">-- ESTADOS --</option>
                @foreach($estados as $estado)
                    <option data-id="{{ $estado->abbreviation }}" value="{{ $estado->abbreviation }}">{{ $estado->name }}</option>
                @endforeach
            </select>
            <i class="fa fa-angle-down c-16"></i>
        </div>
    </div>

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