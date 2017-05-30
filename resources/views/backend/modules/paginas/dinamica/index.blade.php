@extends('backend.layouts.master')

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Gerenciamento de Páginas</h5>

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
                    <div class="container">
                        <a href="{{ route('admin.paginas.dinamica.create') }}" class="btn btn-primary"><i
                                    class="icon-plus-circle2"></i> Cadastrar</a>
                    </div>
                    <br>
                    <div class="panel-body">
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
                                            <th>Casa</th>
                                            <th>Slug</th>
                                            <th class="text-center" width="80">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($pg_sesi) >= 1)
                                            @foreach($pg_sesi as $sesi)
                                                <tr>
                                                    <td>{{ $sesi->id }}</td>
                                                    <td>{{ $sesi->title }}</td>
                                                    <td>{{ $sesi->casa->name }}</td>
                                                    <td>{{ $sesi->slug }}</td>
                                                    <td class="text-center">
                                                        <ul class="icons-list">
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                    <i class="icon-menu9"></i>
                                                                </a>

                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                    <li><a href="{{ route('admin.paginas.dinamica.edit', ['id' => $sesi->id]) }}"><i class="icon-pencil7"></i> Editar</a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">Sem Registros Cadastrados</td>
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
                                            <th>Casa</th>
                                            <th>Slug</th>
                                            <th class="text-center" width="80">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($pg_senai) >= 1)
                                            @foreach($pg_senai as $senai)
                                                <tr>
                                                    <td>{{ $senai->id }}</td>
                                                    <td>{{ $senai->title }}</td>
                                                    <th>{{ $senai->casa->name }}</th>
                                                    <td>{{ $senai->slug }}</td>
                                                    <td class="text-center">
                                                        <ul class="icons-list">
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                    <i class="icon-menu9"></i>
                                                                </a>

                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                    <li><a href="{{ route('admin.paginas.dinamica.edit', ['id' => $senai->id]) }}"><i class="icon-pencil7"></i> Editar</a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">Sem Registros Cadastrados</td>
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
    </div>
@stop