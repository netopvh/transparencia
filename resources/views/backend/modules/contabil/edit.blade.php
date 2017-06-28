@extends('backend.layouts.master')

@section('scripts-after')
<script type="text/javascript" src="{{ asset('backend/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/modules/contabil.js') }}"></script>
@stop

@section('content')
<br>
<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Cadastrar Documentos</h5>
                    <span class="text-size-small text-danger">Atenção! Você deve enviar os arquivos para o gerenciador de arquivos.</span>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.contabil.update',['id' => $conta->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="form-group">
                                    <label>Tipo:</label>
                                    <select name="type" class="form-control" required>
                                        <option value="">Selecione</option>
                                        @foreach($tipos as $key => $value)
                                        <option value="{{ $key }}"{{ $conta->type==$key?" selected":"" }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Casa:</label>
                                    <select name="casa_id" class="form-control" required>
                                        <option value="">Selecione</option>
                                        @foreach($casas as $casa)
                                        <option value="{{ $casa->id }}"{{ $conta->casa_id==$casa->id?" selected":"" }}>{{ $casa->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Arquivo:</label>
                                    <select name="file" class="select2" required>
                                        @foreach($files as $file)
                                        <option value="{{ $file }}"{{ $conta->file==$file?" selected":"" }}>{{ $file }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-5">
                                <button type="submit" class="btn btn-primary"><i class="icon-database-check"></i> Cadastrar</button>
                                <a href="{{ route('admin.contabil.index') }}" class="btn btn-info"><i class="icon-database-refresh"></i> Voltar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop