@extends('frontend.sesi.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('sesi.infra') !!}
@stop

@section('sac-button')
    @include('frontend.sesi.layouts.partials.sac-button')
@stop

@section('title')
    Dados da Infraestrutura
@stop

@section('scripts')
    <script src="{{ asset('frontend/sesi/assets/js/app.js') }}"></script>
@stop

@section('content')
    Este módulo contém informações sobre as escolas e as unidades em que o SESI
    desenvolve as suas atividades, incluindo endereço, telefone e responsáveis.
    <br><br>
    <div class="table-section">
        <table class="table-custom">
            <thead>
            <tr>
                <th></th>
                <th colspan="3" class="left">
                    INFRAESTRUTURA
                </th>
                <th colspan="6" class="left">INFRAESTRUTURA POR ATUAÇÃO</th>
            </tr>
            <tr class="center">
                <th>DR</th>
                <th>Unidades Fixas</th>
                <th>Unidades Móveis</th>
                <th class="lining">Centro de Alimentação</th>
                <th>Centro de Cultura</th>
                <th>Instituto de Inovação</th>
                <th>Centro de Promoção da Saúde</th>
                <th>Centro de Segurança e Saúde no Trabalho</th>
                <th>Centro de Educação</th>
                <th>Atuação Conjunta</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><b>RO</b></td>
                <td class="text-center"><a href="javascript:void(0)" data-id="1" data-casa="1" data-tipo="1" data-titulo="Unidades Fixas"
                                           class="modal-link">{{ $fixas }}</a></td>
                <td class="text-center"><a href="javascript:void(0)" data-id="2" data-casa="1" data-tipo="1" data-titulo="Unidades Móveis"
                                           class="modal-link">{{ $moveis }}</a></td>
                <td class="text-center"><a href="javascript:void(0)" data-id="1" data-casa="1" data-tipo="2"
                                           data-titulo="Centro de Alimentação" class="modal-link">{{ $alimentacao }}</a></td>
                <td class="text-center"><a href="javascript:void(0)" data-id="1" data-casa="1" data-tipo="2"
                                           data-titulo="Centro de Cultura" class="modal-link">{{ $cultura }}</a></td>
                <td class="text-center"><a href="javascript:void(0)" data-id="1" data-casa="1" data-tipo="2"
                                           data-titulo="Instituto de Inovação" class="modal-link">{{ $inovacao }}</a></td>
                <td class="text-center"><a href="javascript:void(0)" data-id="1" data-casa="1" data-tipo="2"
                                           data-titulo="Centro de Promoção da Saúde" class="modal-link">{{ $saude }}</a></td>
                <td class="text-center"><a href="javascript:void(0)" data-id="1" data-casa="1" data-tipo="2"
                                           data-titulo="Centro de Segurança e Saúde no Trabalho"
                                           class="modal-link">{{ $trabalho }}</a></td>
                <td class="text-center"><a href="javascript:void(0)" data-id="1" data-casa="1" data-tipo="2"
                                           data-titulo="Centro de Educação" class="modal-link">{{ $educacao }}</a></td>
                <td class="text-center"><a href="javascript:void(0)" data-id="1" data-casa="1" data-tipo="2"
                                           data-titulo="Atuação Conjunta" class="modal-link">{{ $conjunta }}</a></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="mdIntegracao" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #999999;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_titulo"
                        style="color: #000; font-weight: bold; font-size: 22px; text-transform: uppercase;"></h4>
                </div>
                <div class="modal-body" id="mdIntegracao_body">

                </div>
            </div>
        </div>
    </div>

@stop