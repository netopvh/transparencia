@extends('backend.layouts.master')
@section('scripts-after')
    <script src="{{ asset('public/backend/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/plugins/forms/validation/validate.min.js') }}"></script>

@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-6">
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
                        @foreach($menus as $menu)
                            <tr>
                                <td>{{ $menu->id }}</td>
                                <td>{{ $menu->description }}</td>
                                <td>{{ $menu->casa->name }}</td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="{{ route('admin.menus.edit', ['id' => $menu->id]) }}"><i
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
@stop