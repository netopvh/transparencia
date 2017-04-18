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
                        <h5 class="panel-title">Listagem de Estrutura Remuneratória</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="container">
                        <a href="{{ route('admin.paginas.create') }}" class="btn btn-primary"><i
                                    class="icon-file-excel"></i> Importar de CSV</a>
                    </div>
                    <br>
                    <table class="table table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th width="70">ID</th>
                            <th>Nome</th>
                            <th class="text-center" width="80">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($remuneracoes) >= 1)
                            @foreach($remuneracoes as $remunera)
                                <tr>
                                    <td>{{ $remunera->id }}</td>
                                    <td>{{ $remunera->cargo }}</td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href=""><i class="icon-pencil7"></i> Editar</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">Sem Registros Cadastrados</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="text-right">{{ $remuneracoes->links() }}</div>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Cadastrar</h5>

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
                        <form action="{{ route('admin.remunera.store') }}" method="post" class="form-validate">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="form-group">
                                        <label class="control-label">Nome do Cargo:</label>
                                        <input type="text" value="{{ old('cargo') }}" class="form-control upper" name="cargo" minlength="4" required>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="control-label">Total de Empregados:</label>
                                        <input type="number" value="{{ old('empregados') }}" class="form-control" name="empregados" required>
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
                                                <option value="{{ $casa->id }}"{{ old('casa_id')==$casa->id?' selected':'' }}>{{ $casa->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label>Ponto Inicial:</label>
                                        <input type="text" value="{{ old('ponto_ini') }}" name="ponto_ini" class="form-control" data-prefix="R$ " data-thousands="." data-decimal="," required>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label>Ponto Final:</label>
                                        <input type="text" name="ponto_fin" value="{{ old('ponto_fin') }}" class="form-control" data-prefix="R$ " data-thousands="." data-decimal="," required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <button type="submit" class="btn btn-primary"> Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop