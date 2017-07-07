@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript" src="{{ asset('backend/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/assets/js/modules/contabil.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Demonstrações Contábeis</h5>

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
                    <br>
                    <div class="tabbable tab-content-bordered">
                        <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                            <li class="active"><a href="#bordered-justified-tab1" data-toggle="tab">SESI</a></li>
                            <li><a href="#bordered-justified-tab2" data-toggle="tab">SENAI</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane has-padding active" id="bordered-justified-tab1">
                                <table class="table table-bordered table-condensed">
                                    <thead>
                                    <tr>
                                        <th width="70">ID</th>
                                        <th>Nome</th>
                                        <th width="90">Arquivo</th>
                                        <th class="text-center" width="80">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($conta_sesi) >= 1)
                                        @foreach($conta_sesi as $conta)
                                            <tr>
                                                <td>{{ $conta->id }}</td>
                                                <td>{{ $tipos[$conta->type] }}</td>
                                                <td class="text-center"><a href="{{ url('files/'.$conta->file) }}"
                                                                           target="_blank"><i class="icon-search4"></i></a>
                                                </td>
                                                <td>
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>

                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li><a href="{{ route('admin.contabil.edit', ['id' => $conta->id]) }}"><i class="icon-pencil7"></i> Editar</a></li>
                                                                <li>
                                                                    <form action="{{ route('admin.contabil.delete', ['id' => $conta->id]) }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('delete') }}
                                                                        <button  type="submit" class="button-clean-1"><i class="icon-trash space-right"></i> Excluir</button>
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
                                            <td colspan="4" class="text-center">Sem Registros</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane has-padding" id="bordered-justified-tab2">
                                <table class="table table-bordered table-condensed">
                                    <thead>
                                    <tr>
                                        <th width="70">ID</th>
                                        <th>Nome</th>
                                        <th width="90">Arquivo</th>
                                        <th class="text-center" width="80">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($conta_senai) >= 1)
                                        @foreach($conta_senai as $conta)
                                            <tr>
                                                <td>{{ $conta->id }}</td>
                                                <td>{{ $tipos[$conta->type] }}</td>
                                                <td class="text-center"><a href="{{ url('files/'.$conta->file) }}"
                                                                           target="_blank"><i class="icon-search4"></i></a>
                                                </td>
                                                <td>
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>

                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li><a href="{{ route('admin.contabil.edit', ['id' => $conta->id]) }}"><i class="icon-pencil7"></i> Editar</a></li>
                                                                <li>
                                                                    <form action="{{ route('admin.contabil.delete', ['id' => $conta->id]) }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('delete') }}
                                                                        <button  type="submit" class="button-clean-1"><i class="icon-trash space-right"></i> Excluir</button>
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
                                            <td colspan="4" class="text-center">Sem Registros</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Cadastrar Documentos</h5>
                        <span class="text-size-small text-danger">Atenção! Você deve enviar os arquivos para o gerenciador de arquivos.</span>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.contabil.store') }}" id="form" class="form-validate" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label>Tipo:</label>
                                        <select name="type" class="form-control" required>
                                            <option value="">Selecione</option>
                                            @foreach($tipos as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Casa:</label>
                                        <select name="casa_id" class="form-control" required>
                                            <option value="">Selecione</option>
                                            @foreach($casas as $casa)
                                                <option value="{{ $casa->id }}">{{ $casa->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>Arquivo: </label>  <span class="text-size-mini text-danger">* Atenção! Permitido apenas envio de Arquivos em Formato PDF.</span>
                                        <input type="file" name="files" class="file-styled" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="loader">
                                <div class="col-xs-4">
                                    <span><i class="icon-spinner spinner position-left"></i> Enviando arquivo..</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-5">
                                    <button type="submit" id="button" class="btn btn-primary"><i class="icon-database-check"></i> Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop