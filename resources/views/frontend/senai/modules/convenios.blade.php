@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    {!! Breadcrumbs::render('senai.convenios') !!}
@stop

@section('title')
    Contratos e Convênios
@stop

@section('scripts')
    <script src="{{ asset('frontend/senai/assets/js/app.js') }}"></script>
@stop

@section('content')
    <h4><strong>Departamento Regional - SENAI RO</strong></h4>
    <br>
    <h4>Contratos</h4>
    <div class="row">
        <div class="col-md-12">
            <table width="100%" id="table-contracts">
                <thead>
                <tr>
                    <th>Nº do contrato</th>
                    <th>Data do contrato / Avença</th>
                    <th>Razão Social / Nome</th>
                    <th>CNPJ</th>
                    <th>Valor do contrato</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <h4>Convênios</h4>
    <div class="row">
        <div class="col-md-12">
            <table width="100%">
                <thead>
                <tr class="text-center">
                    <th>Nº do Convênio</th>
                    <th>Data do Convênio</th>
                    <th>Descrição do Objeto</th>
                    <th>Razão Social do Convenente</th>
                    <th>CNPJ</th>
                    <th>Valor do Convênio</th>
                </tr>
                </thead>
                <tbody>
                @if(count($convenios) >= 1)
                    @foreach($convenios as $convenio)
                        <tr class="text-center">
                            <td>{{ $convenio->numero }}</td>
                            <td>{{ $convenio->data }}</td>
                            <td>{{ $convenio->objeto }}</td>
                            <td>{{ $convenio->razao }}</td>
                            <td>{{ $convenio->cnpj }}</td>
                            <td>R$ {{ $convenio->valor }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-bold">Sem registros a exibir</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-contrato" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #999999;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        style="color: #000; font-weight: bold; font-size: 22px; text-transform: uppercase;"></h4>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
@stop