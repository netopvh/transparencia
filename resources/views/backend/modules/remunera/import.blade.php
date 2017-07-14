@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript" src="{{ asset('backend/assets/js/modules/remuneratoria.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-7">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Importar Registros de Planilha Excel</h5>

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
                        banco de dados, é necessário que o arquivo esteja em formato .XLSX ou .XLS, contendo apenas uma planilha com os dados dados.</span>
                        Siga o modelo abaixo <br><br>
                        <a href="{{ url('/files/modelos/TABELA_SALARIAL.xlsx') }}" class="btn btn-primary"><i class="icon-download4"></i> Baixar Modelo</a>
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th>CASA</th>
                                    <th>CARGO</th>
                                    <th>PONTO INICIAL</th>
                                    <th>PONTO FINAL</th>
                                    <th>EMPREGADOS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SESI</td>
                                    <td>ASSISTENTE ADMINISTRATIVO</td>
                                    <td>999,99</td>
                                    <td>999,99</td>
                                    <td>10</td>
                                </tr>
                            </tbody>
                        </table>
                        <br><br>
                        <form action="{{ route('admin.remunera.import') }}" method="post"
                              enctype="multipart/form-data" id="formImport" class="form-validate">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label>Arquivo:</label>
                                        <input type="file" class="file-styled" name="arquivo" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="loader">
                                <div class="col-xs-4">
                                    <span><i class="icon-spinner spinner position-left"></i> Enviando arquivo..</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <button type="submit" id="button" class="btn btn-primary"><i class="icon-upload"></i> Enviar Arquivo</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-info"><i class="icon-reply"></i> Voltar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop