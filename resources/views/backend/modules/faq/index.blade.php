@extends('backend.layouts.master')
@section('scripts-after')
    <script src="{{ asset('backend/assets/js/plugins/forms/validation/validate.min.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Gerenciamento de FAQ</h5>

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
                        <a href="{{ route('admin.faq.create') }}" class="btn btn-primary"><i
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
                                            <th>Pergunta</th>
                                            <th>Casa</th>
                                            <th class="text-center" width="80">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($sesi) >= 1)
                                            @foreach($sesi as $row)
                                                <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->question }}</td>
                                                <td>{{ $row->casa->name }}</td>
                                                <td>
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>

                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li><a href="{{ route('admin.faq.edit', ['id' => $row->id]) }}"><i class="icon-pencil7"></i> Editar</a></li>
                                                                <li>
                                                                    <form action="{{ route('admin.faq.delete', ['id' => $row->id]) }}" method="post">
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
                                                <td colspan="4" class="text-center">Sem registros</td>
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
                                            <th>Pergunta</th>
                                            <th>Casa</th>
                                            <th class="text-center" width="80">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($senai) >= 1)
                                            @foreach($senai as $row)
                                                <tr>
                                                    <td>{{ $row->id }}</td>
                                                    <td>{{ $row->question }}</td>
                                                    <td>{{ $row->casa->name }}</td>
                                                    <td>
                                                        <ul class="icons-list">
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                    <i class="icon-menu9"></i>
                                                                </a>

                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                    <li><a href="{{ route('admin.faq.edit', ['id' => $row->id]) }}"><i class="icon-pencil7"></i> Editar</a></li>
                                                                    <li>
                                                                        <form action="{{ route('admin.faq.delete', ['id' => $row->id]) }}" method="post">
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
                                                <td colspan="4" class="text-center">Sem registros</td>
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