@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript" src="{{ asset('public/backend/assets/js/modules/casas.js') }}"></script>
@stop

@section('content')
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
                        <form action="{{ route('admin.casas.store') }}" class="form-validate" method="post"
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
                                    <a href="{{ url()->previous() }}" class="btn btn-info"><i
                                                class="icon-reply"></i> Voltar</a>
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