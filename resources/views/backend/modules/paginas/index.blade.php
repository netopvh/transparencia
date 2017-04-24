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
                        <a href="{{ route('admin.paginas.create') }}" class="btn btn-primary"><i
                                    class="icon-plus-circle2"></i> Cadastrar</a>
                    </div>
                    <br>
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
                        @if(count($paginas) >= 1)
                            @foreach($paginas as $pagina)
                                <tr>
                                    <td>{{ $pagina->id }}</td>
                                    <td>{{ $pagina->title }}</td>
                                    <th>{{ $pagina->casa->name }}</th>
                                    <td>{{ $pagina->slug }}</td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="{{ route('admin.paginas.edit', ['id' => $pagina->id]) }}"><i class="icon-pencil7"></i> Editar</a></li>
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
                    <div class="text-center">
                        {{ $paginas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop