@extends('backend.layouts.master')
@section('scripts-after')
    <script src="{{ asset('public/backend/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/plugins/forms/validation/validate.min.js') }}"></script>

@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Gerenciamento de Menu</h5>

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
                        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary"><i
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
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="70">ID</th>
                                            <th>Nome</th>
                                            <th>Casa</th>
                                            <th class="text-center" width="80">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($menu_sesi as $sesi)
                                            <tr>
                                                <td>{{ $sesi->id }}</td>
                                                <td>{{ $sesi->description }}</td>
                                                <td>{{ $sesi->casa->name }}</td>
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>

                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li><a href="{{ route('admin.menus.edit', ['id' => $sesi->id]) }}"><i
                                                                                class="icon-pencil7"></i> Editar</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane has-padding" id="bordered-justified-tab2">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="70">ID</th>
                                            <th>Nome</th>
                                            <th>Casa</th>
                                            <th class="text-center" width="80">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($menu_senai as $senai)
                                            <tr>
                                                <td>{{ $senai->id }}</td>
                                                <td>{{ $senai->description }}</td>
                                                <td>{{ $senai->casa->name }}</td>
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>

                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li><a href="{{ route('admin.menus.edit', ['id' => $senai->id]) }}"><i
                                                                                class="icon-pencil7"></i> Editar</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
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