@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript"
            src="{{ asset('public/backend/assets/js/plugins/editors/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('public/backend/assets/js/plugins/editors/summernote/lang/summernote-pt-BR.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/backend/assets/js/modules/menu.js') }}"></script>

@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Editar Menu</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <form action="{{ route('admin.menus.store') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <label>Título:</label>
                                            <input type="text" value="{{ old('description') }}" name="description"
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label>Bloco</label>
                                            <select name="bloco" class="form-control">
                                                <option value="">SELECIONE</option>
                                                @foreach($blocos as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label>Casa</label>
                                            <select name="casa_id" class="form-control">
                                                <option value="">SELECIONE</option>
                                                @foreach($casas as $casa)
                                                    <option value="{{ $casa->id }}">{{ $casa->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>Conteúdo:</label>
                                            <textarea class="input-block-level" id="summernote" name="script"
                                                      rows="18">{{ old('script') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <button class="btn btn-primary"><i class="icon-safe"></i> Cadastrar Registro
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop