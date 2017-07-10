@extends('backend.layouts.master')
@section('scripts-after')
    <script src="{{ asset('backend/assets/js/plugins/forms/validation/validate.min.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Gerenciamento de Convenios</h5>

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
                        <a href="{{ route('admin.convenio.create') }}" class="btn btn-primary"><i
                                    class="icon-plus-circle2"></i> Cadastrar</a>
                    </div>
                    <br>
                    <table class="table table-striped table-condesed table-bordered">
                        <thead>
                        <tr>
                            <th width="80">Nº</th>
                            <th width="120">Casa</th>
                            <th width="120">Data</th>
                            <th>Razão Social</th>
                            <th>CNPJ</th>
                            <th>Valor</th>
                            <th width="100" class="text-center">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($convenios) >= 1)
                            @foreach($convenios as $convenio)
                                <tr>
                                    <td>{{ $convenio->numero }}</td>
                                    <td>{{ $convenio->casa->name }}</td>
                                    <td>{{ $convenio->data }}</td>
                                    <td>{{ $convenio->razao }}</td>
                                    <td>{{ $convenio->cnpj }}</td>
                                    <td>R$ {{ $convenio->valor }}</td>
                                    <td>
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="{{ route('admin.convenio.edit', ['id' => $convenio->id]) }}"><i class="icon-pencil7"></i> Editar</a></li>
                                                    <li>
                                                        <form action="{{ route('admin.convenio.delete', ['id' => $convenio->id]) }}" method="post">
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
                                <td colspan="7" class="text-bold text-center">Sem Registros a serem exibidos</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    {{ $convenios->links() }}
                </div>
            </div>
        </div>
    </div>
@stop