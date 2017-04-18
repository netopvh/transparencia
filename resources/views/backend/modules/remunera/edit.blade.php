@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript"
            src="{{ asset('backend/assets/js/plugins/forms/mask/jquery-maskmoney/src/jquery.maskMoney.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/assets/js/modules/remuneratoria.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-10">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Editar</h5>

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
                        <form action="{{ route('admin.remunera.update', ['id'=> $remunera->id]) }}" method="post" class="form-validate">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="form-group">
                                        <label class="control-label">Nome do Cargo:</label>
                                        <input type="text" value="{{ $remunera->cargo }}" class="form-control upper" name="cargo" minlength="4" required>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="control-label">Total de Empregados:</label>
                                        <input type="number" value="{{ $remunera->empregados }}" class="form-control" name="empregados" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label>Casa:</label>
                                        <select name="casa_id" class="form-control" required>
                                            <option value="">SELECIONE</option>
                                            @foreach($casas as $casa)
                                                <option value="{{ $casa->id }}"{{ $remunera->casa_id==$casa->id?' selected':'' }}>{{ $casa->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label>Ponto Inicial:</label>
                                        <input type="text" value="{{ $remunera->ponto_ini }}" name="ponto_ini" class="form-control" data-prefix="R$ " data-thousands="." data-decimal="," required>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label>Ponto Final:</label>
                                        <input type="text" name="ponto_fin" value="{{ $remunera->ponto_fin }}" class="form-control" data-prefix="R$ " data-thousands="." data-decimal="," required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Cadastrar</button>
                                    <a href="{{ route('admin.remunera.index') }}" class="btn btn-info"><i class="icon-reply"></i> Voltar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop