@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript" src="{{ asset('backend/assets/js/modules/menu.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Criar Menu</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <form action="{{ route('admin.menus.store') }}" method="post" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <label>Título:</label>
                                            <input type="text" value="{{ old('description') }}" name="description"
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label>Casa:</label>
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
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label>Tipo:</label>
                                            <select name="tipo" class="form-control">
                                                <option value="">SELECIONE</option>
                                                @foreach($tipos as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-8" id="tipo">
                                        <div class="form-group">
                                            <label>Arquivo</label>
                                            <input type="file" class="form-control">
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