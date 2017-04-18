@extends('backend.layouts.master')
@section('scripts-after')
    <script src="{{ asset('backend/assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/forms/validation/localization/messages_pt_BR.min.js') }}"></script>
@stop

@section('content')
    {!! Breadcrumbs::render('admin.roles.create') !!}
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Cadastrar Casa</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('admin.casas.store') }}" class="form-validate-jquery" method="post"
                              autocomplete="off">
                            {{ csrf_field() }}
                            <!-- Inicio do Form -->
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label>Descrição</label>
                                        <input type="text" name="name" id="name"
                                               value="" class="form-control"
                                               required autofocus>
                                    </div>
                                </div>
                            </div>
                            <!-- Fim do Form -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary"><i class="icon-database-check"></i>
                                        Salvar
                                    </button>
                                    <a href="{{ route('admin.casas.index') }}" class="btn btn-danger"><i class="icon-undo"></i>
                                        Voltar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@stop