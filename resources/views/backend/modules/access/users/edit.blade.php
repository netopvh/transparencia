@extends('backend.layouts.master')

@section('scripts-before')
    <script src="{{ asset('backend/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/forms/validation/localization/messages_pt_BR.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/modules/users.js') }}"></script>
@stop

@section('content')
    {!! Breadcrumbs::render('admin.users.edit') !!}
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Editar Usuário</h5>

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

                    <div class="panel-body">
                        <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" class="form-validate-jquery" autocomplete="off"
                              method="post">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Inicio do Form -->
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label class="control-label">Nome Completo:</label>
                                                <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label class="control-label">Usuário:</label>
                                                <input type="text" name="username" value="{{ $user->username }}"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label class="control-label">Email:</label>
                                                <input type="email" name="email" value="{{ $user->email }}"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label class="control-label">Perfil:</label>
                                                <select name="role" id="role_id" class="select" required>
                                                    <option value="">Selecione</option>
                                                    @foreach($roles as $role)
                                                        <option {{ (isset($user) && $user->roles()->first()->id == $role->id ? 'selected': '') }}
                                                                value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label class="display-block text-semibold">Status:</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="active" value="1" class="styled" {{ $user->active == 1 ? 'checked':'' }}>
                                                    Ativo
                                                </label>

                                                <label class="radio-inline">
                                                    <input type="radio" name="active" value="0" class="styled" {{ $user->active == 0 ? 'checked':'' }}>
                                                    Inativo
                                                </label>
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