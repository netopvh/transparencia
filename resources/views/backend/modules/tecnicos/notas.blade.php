@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript" src="{{ asset('backend/assets/js/modules/remuneratoria.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Notas Informativas</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.tecnicos.notas.store') }}" method="post"
                              class="form-validate">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="col-xs-12">Nota Informativa:
                                            <textarea name="notas" class="form-control" rows="6"
                                                      required>{{ !is_array($nota)?$nota->notas:'' }}</textarea>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <input type="hidden" name="casa_id" value="{{ !is_array($nota)?$nota->casa_id:$nota['casa_id']}}">
                                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Cadastrar
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-info"><i class="icon-reply"></i>
                                        Voltar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop