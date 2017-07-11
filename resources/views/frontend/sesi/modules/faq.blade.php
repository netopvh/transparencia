@extends('frontend.sesi.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('sesi.faq') !!}
@stop

@section('sac-button')
    @include('frontend.sesi.layouts.partials.sac-button')
@stop

@section('title')
    Dúvidas Frequentes (FAQ)
@stop

@section('content')
    Confira abaixo as perguntas frequentes sobre o SESI. Se ainda assim precisar, você também pode utilizar os contatos
    das unidades nos estados ou <a href="{{ route('sesi.sac') }}">enviar um e-mail</a> .
    <br><br>
    @foreach($faqs as $faq)
        <div class="clearfix cl common-space collapse-noticia" style="margin: 0;">
            <div>
                <a href="#" class="panel-heading">
                    <h3 class="t p-18">
                        {{ $loop->iteration }} - {{ $faq->question }}
                    </h3>
                    <i class="fa gradient"><span class="after">+</span></i></a>
                <div style="display: none;" class="panel-body">
                    {!! $faq->answer !!}
                </div>
            </div>
        </div>
    @endforeach
@stop