@extends('backend.layouts.master')

@section('scripts-before')
    <script src="{{ asset('backend/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/modules/users.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Alterar Senha</h5>

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
                    <div class="panel-body">
                        <form action="{{ route('admin.users.password') }}" class="form-validate" autocomplete="off"
                              method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Inicio do Form -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">Senha Atual: <span class="text-danger">*</span></label>
                                                <input type="password" name="actual" value="" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Inicio do Form -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">Nova Senha: <span class="text-danger">*</span></label>
                                                <input type="password" name="password" id="password" value="" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Inicio do Form -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">Confirmar Nova Senha: <span class="text-danger">*</span></label>
                                                <input type="password" name="confirm" value="" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn btn-primary" id="gravar" type="submit"><i class="icon-database-check"></i> Salvar</button>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-danger"><i class="icon-undo"></i> Voltar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop