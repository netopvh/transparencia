@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript"
            src="{{ asset('backend/assets/js/plugins/forms/mask/jquery-maskmoney/src/jquery.maskMoney.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/assets/js/modules/remuneratoria.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Importar Registros de Arquivo CSV</h5>

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
                        <span class="text-size-large"><span class="text-danger">Atenção! </span> Para que seja realizada a importação de informações para o
                        banco de dados, é necessário que o arquivo esteja em formato .CSV, contendo apenas dados.</span>
                        <br><br>
                        <form action="{{ route('admin.remunera.import') }}" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label>Arquivo:</label>
                                        <input type="file" class="form-control" name="arquivo">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary">Enviar Arquivo</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop