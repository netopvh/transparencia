@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript" src="{{ asset('backend/assets/js/modules/integridade.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-7">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Cadastrar Integridade</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('admin.integridade.store') }}" id="formCreate" class="form-validate" method="post"
                              autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <!-- Inicio do Form -->
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label>Casa:</label>
                                        <select name="casa_id" class="form-control" required autofocus>
                                            <option value="">Selecione</option>
                                            @foreach($casas as $casa)
                                                <option value="{{ $casa->id }}">{{ $casa->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label>Ano:</label>
                                        <select name="year" class="form-control" required>
                                            @for($i=2014;$i <= 2025;$i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="form-group">
                                        <label>Tipo:</label>
                                        <select name="type" class="form-control" required>
                                            <option value="">Selecione</option>
                                            @foreach($tipos as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>Arquivo: </label>  <span class="text-size-mini text-danger">* Atenção! Permitido apenas envio de Arquivos em Formato PDF.</span>
                                        <input type="file" name="files" class="file-styled" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="loader">
                                <div class="col-xs-4">
                                    <span><i class="icon-spinner spinner position-left"></i> Enviando arquivo..</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="submit" id="button" class="btn btn-primary"><i class="icon-database-check"></i>
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