@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript"
            src="{{ asset('ackend/assets/js/plugins/forms/mask/jquery-maskmoney/src/jquery.maskMoney.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/assets/js/modules/dirigentes.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-7">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Listagem de Dirigentes</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="container">
                        <a href="{{ route('admin.dirigentes.import') }}" class="btn btn-primary"><i
                                    class="icon-file-excel"></i> Importar do Excel</a>
                    </div>
                    <br>
                    <div class="panel-body">
                        <form action="{{ route('admin.dirigentes.files') }}" id="formImport" method="post" class="form-validate-files" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Arquivo ODS:</label>
                                        <input type="file" class="form-control" name="ods" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Arquivo PDF:</label>
                                        <input type="file" class="form-control" name="pdf">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Arquivo XLSX:</label>
                                        <input type="file" class="form-control" name="xlsx">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="loader">
                                <div class="col-xs-4">
                                    <span><i class="icon-spinner spinner position-left"></i> Enviando arquivo..</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <button type="submit" class="btn btn-primary" id="button"> Enviar Arquivos</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop