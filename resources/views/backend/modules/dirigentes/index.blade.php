@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript" src="{{ asset('backend/assets/js/modules/dirigentes.js') }}"></script>
@stop

@section('content')
    <!-- Mini modal -->
    <div id="modal_mini" class="modal fade">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Selecione a Casa</h5>
                </div>

                <div class="modal-body">
                    <form action="">
                        <select name="casa" class="form-control">
                            <option value="">Selecione</option>
                            @foreach($casas as $casa)
                                <option value="{{ $casa->id }}" data-id="{{ $casa->id }}">{{ $casa->name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="send" class="btn btn-primary">Prosseguir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /mini modal -->
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-7">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Listagem de Dirigentes</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    @if (notify()->ready())
                        <div class="alert alert-{{ notify()->type() }} alert-styled-left">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                        class="sr-only">Close</span></button>
                            <span class="text-semibold">{{ notify()->message() }}</span>
                        </div>
                    @endif
                    <div class="container">
                        <a href="{{ route('admin.dirigentes.import') }}" class="btn btn-primary"><i
                                    class="icon-file-excel"></i> Importar do Excel</a>
                        <button id="notas" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_mini"><i
                                    class="icon-file-text3"></i> Notas Informativas
                        </button>
                        <button id="files" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_mini"><i
                                    class="icon-arrow-up52"></i> Enviar Arquivos
                        </button>
                    </div>
                    <br>
                    <table class="table table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th width="70">ID</th>
                            <th>Nome</th>
                            <th>Casa</th>
                            <th class="text-center" width="80">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($dirigentes) >= 1)
                            @foreach($dirigentes as $dirigente)
                                <tr>
                                    <td>{{ $dirigente->id }}</td>
                                    <td>{{ $dirigente->nome }}</td>
                                    <td>{{ $dirigente->casa->name }}</td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li>
                                                        <a href="{{ route('admin.dirigentes.edit', ['id' => $dirigente->id]) }}"><i
                                                                    class="icon-pencil7"></i> Editar</a></li>
                                                    <li>
                                                        <form action="{{ route('admin.dirigentes.delete',['id' => $dirigente->id]) }}"
                                                              method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            <button type="submit" class="button-clean-1"><i
                                                                        class="icon-trash space-right"></i> Excluir
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center"><span
                                            class="text-bold">Sem Registros Cadastrados</span></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="text-right">{{ $dirigentes->links() }}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
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
                    <div class="panel-body">
                        <form action="{{ route('admin.dirigentes.index') }}" method="post" class="form-validate">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label class="control-label">Nome do Dirigente:</label>
                                        <input type="text" value="{{ old('nome') }}" class="form-control upper"
                                               name="nome"
                                               minlength="4" required>
                                    </div>
                                </div>
                                <div class="col-xs-4">
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