@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript"
            src="{{ asset('backend/assets/js/plugins/forms/mask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('backend/assets/js/plugins/forms/mask/jquery-maskmoney/dist/jquery.maskMoney.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/assets/js/plugins/pickers/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/assets/js/modules/convenio.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-7">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Editar Convênio</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('admin.convenio.update',['id' => $convenio->id]) }}" id="formCreate" class="form-validate"
                              method="post"
                              autocomplete="off">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <!-- Inicio do Form -->
                            <div class="row">
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label>Nº Convênio:</label>
                                        <input type="text" class="form-control" value="{{ $convenio->numero }}" name="numero" required>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label>Casa:</label>
                                        <select name="casa_id" class="form-control" required autofocus>
                                            <option value="">Selecione</option>
                                            @foreach($casas as $casa)
                                                <option value="{{ $casa->id }}"{{ $casa->id==$convenio->casa_id?' selected':'' }}>{{ $casa->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label>Data: </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                            <input type="text" class="form-control daterange" name="data" value="{{ $convenio->data }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Tipo:</label>
                                        <select name="tipo" class="form-control">
                                            <option value="">Selecione</option>
                                            <option value="P"{{ $convenio->tipo=='P'?' selected':'' }}>Patrocínio</option>
                                            <option value="D"{{ $convenio->tipo=='D'?' selected':'' }}>Diversos</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label>CPNJ: </label>
                                        <input type="text" id="cnpj" value="{{ $convenio->cnpj }}" name="cnpj" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-xs-9">
                                    <div class="form-group">
                                        <label>Razão Social do Convenente:</label>
                                        <input type="text" value="{{ $convenio->razao }}" name="razao" class="form-control upper" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Valor do Convênio:</label>
                                        <input type="text" value="{{ $convenio->valor }}" id="currency" data-prefix="R$ " data-thousands="."
                                               data-decimal="," class="form-control" name="valor">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>Objeto do Convênio:</label>
                                        <textarea name="objeto" cols="30" rows="5" class="form-control"
                                                  required>{{ $convenio->objeto }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="submit" id="button" class="btn btn-primary"><i
                                                class="icon-database-check"></i>
                                        Salvar
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-info"><i
                                                class="icon-reply"></i> Voltar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@stop