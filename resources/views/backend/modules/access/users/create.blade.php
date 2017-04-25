@extends('backend.layouts.master')

@section('scripts-before')
    <script src="{{ asset('public/backend/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/modules/users.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Cadastrar Usuário</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.users.store') }}" class="form-validate-jquery" autocomplete="off"
                              method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Inicio do Form -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">Nome Completo: <span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label class="control-label">Usuário: <span class="text-danger">*</span></label>
                                                <input type="text" name="username" value="" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label class="control-label">Senha: <span class="text-danger">*</span></label>
                                                <input type="password" name="password" value="" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label class="control-label">Email: <span class="text-danger">*</span></label>
                                                <input type="email" name="email" value="" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label class="control-label">Perfil: <span class="text-danger">*</span></label>
                                                <select name="role" id="role_id" class="select" required>
                                                    <option value="">Selecione</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fim do Form -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
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