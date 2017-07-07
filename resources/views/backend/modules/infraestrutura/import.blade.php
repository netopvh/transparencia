@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript" src="{{ asset('backend/assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/assets/js/plugins/loaders/progressbar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/assets/js/modules/dirigentes.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Importar Registros do DN</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    @if (notify()->ready())
                        <div class="alert alert-{{ notify()->type() }}">
                            {{ notify()->message() }}
                        </div>
                    @endif
                    <div class="panel-body">
                        <span class="text-size-mini">Os registros referentes a infraestrutura, são importados diretamento do DN.</span>
                        <form action="{{ route('admin.infra.import') }}" method="post" class="form-validate">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Casa:</label>
                                        <select name="casa" class="form-control" required>
                                            <option value="">Selecione</option>
                                            <option value="2">SESI</option>
                                            <option value="3">SENAI</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label>Categoria de Ativos:</label>
                                        <select name="categoria" class="form-control" required>
                                            <option value="">Selecione</option>
                                            <option value="1">Unidades Fixas</option>
                                            <option value="2">Unidades Móveis</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="loader">
                                <div class="col-xs-4">
                                    <span><i class="icon-spinner spinner position-left"></i> Enviando arquivo..</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-7">
                                    <button type="submit" id="button" class="btn btn-primary"><i
                                                class="icon-upload"></i> Importar Informações
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-info"><i class="icon-reply"></i>
                                        Voltar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop