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
                        <h5 class="panel-title">Arquivos</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.tecnicos.files.store') }}" method="post"
                              class="form-validate" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row" style="margin-bottom: 10px">
                                <div class="col-xs-12">
                                    @if(!is_array($files))
                                        @foreach($files as $file)
                                            <a href="{{ url('files/'.$file->file) }}" class="btn btn-default" target="_blank">{{ $types[$file->type] }}</a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="col-xs-12">Tipo Arquivo:</label>
                                        <select name="type" id="" class="form-control" required>
                                            <option value="">Selecione</option>
                                            @foreach($types as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-9">
                                    <div class="form-group">
                                        <label>Arquivo</label>
                                        <input type="file" class="file-styled" name="files" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <input type="hidden" name="casa_id"
                                           value="{{ !is_array($files)?$files->first()->casa_id:$files['casa_id']}}">
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