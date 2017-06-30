@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript" src="{{ asset('backend/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/assets/js/modules/orcamento.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Integridade</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="container">
                        <a href="{{ route('admin.integridade.create') }}" class="btn btn-primary"><i class="icon-database-add"></i> Cadastrar</a>
                    </div>
                    @if (notify()->ready())
                        <br>
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
                                        <th>Tipo</th>
                                        <th width="110">Ano</th>
                                        <th width="100">Publicado</th>
                                        <th width="90">Arquivo</th>
                                        <th class="text-center" width="80">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($sesi) >= 1)
                                        @foreach($sesi as $conta)
                                            <tr>
                                                <td>{{ $conta->id }}</td>
                                                <td>{{ $tipos[$conta->type] }}</td>
                                                <td>{{ $conta->year }}</td>
                                                <td>
                                                    @if($conta->published === 'S')
                                                        <span class="label label-success">SIM</span>
                                                    @elseif($conta->published === 'N')
                                                        <span class="label label-danger">NÃO</span>
                                                    @endif
                                                </td>
                                                <td class="text-center"><a
                                                            href="{{ url('files/'.$conta->file) }}"
                                                            target="_blank"><i class="icon-search4"></i></a>
                                                </td>
                                                <td>
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>

                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li>
                                                                    <a href="{{ route('admin.contabil.edit', ['id' => $conta->id]) }}"><i
                                                                                class="icon-pencil7"></i> Editar</a>
                                                                </li>
                                                                <li>
                                                                    <form action="{{ route('admin.orcamento.delete', ['id' => $conta->id]) }}"
                                                                          method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('delete') }}
                                                                        <button type="submit" class="button-clean-2"><i
                                                                                    class="icon-file-check space-right"></i>
                                                                            Publicar
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <form action="{{ route('admin.integridade.delete', ['id' => $conta->id]) }}"
                                                                          method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('delete') }}
                                                                        <button type="submit" class="button-clean-1"><i
                                                                                    class="icon-trash space-right"></i>
                                                                            Excluir
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
                                            <td colspan="6" class="text-center">Sem Registros</td>
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
                                        <th>Tipo</th>
                                        <th width="110">Ano</th>
                                        <th width="100">Publicado</th>
                                        <th width="90">Arquivo</th>
                                        <th class="text-center" width="80">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($senai) >= 1)
                                        @foreach($senai as $conta)
                                            <tr>
                                                <td>{{ $conta->id }}</td>
                                                <td>{{ $tipos[$conta->type] }}</td>
                                                <td>{{ $conta->year }}</td>
                                                <td>
                                                    @if($conta->published === 'S')
                                                        <span class="label label-success">SIM</span>
                                                    @elseif($conta->published === 'N')
                                                        <span class="label label-danger">NÃO</span>
                                                    @endif
                                                </td>
                                                <td class="text-center"><a
                                                            href="{{ url('files/'.$conta->file) }}"
                                                            target="_blank"><i class="icon-search4"></i></a>
                                                </td>
                                                <td>
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>

                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li>
                                                                    <a href="{{ route('admin.contabil.edit', ['id' => $conta->id]) }}"><i
                                                                                class="icon-pencil7"></i> Editar</a>
                                                                </li>
                                                                <li>
                                                                    <form action="{{ route('admin.integridade.delete', ['id' => $conta->id]) }}"
                                                                          method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('delete') }}
                                                                        <button type="submit" class="button-clean"><i
                                                                                    class="icon-trash space-right"></i>
                                                                            Excluir
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
                                            <td colspan="6" class="text-center">Sem Registros</td>
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
    </div>
@stop