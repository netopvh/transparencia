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
                            <form action="{{ route('admin.menus.store') }}" class="form-validate" method="post" enctype="multipart/form-data" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <label>Título:</label>
                                            <input type="text" value="{{ old('title') }}" name="title"
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label>Casa:</label>
                                            <select name="casa_id" class="form-control" required>
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
                                            <select name="type" id="tipo" class="form-control" required>
                                                <option value="">SELECIONE</option>
                                                @foreach($tipos as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-8" id="file">
                                        <div class="form-group">
                                            <label>Arquivo</label>
                                            <input type="file" class="form-control" name="path">
                                        </div>
                                    </div>
                                    <div class="col-xs-8" id="route">
                                        <div class="form-group">
                                            <label>Nome da Rota:</label>
                                            <input type="text" name="path" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label>Menu Lateral:</label>
                                            <select name="sidebar" class="form-control" required>
                                                <option value="">Selecione</option>
                                                <option value="S">Sim</option>
                                                <option value="N">Não</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label>Item LDO:</label>
                                            <select name="ldo" class="form-control" required>
                                                <option value="">Selecione</option>
                                                <option value="S">Sim</option>
                                                <option value="N">Não</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label>Submenu:</label>
                                            <select name="submenu" class="form-control" required>
                                                <option value="">Selecione</option>
                                                <option value="S">Sim</option>
                                                <option value="N">Não</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label>Linkado:</label>
                                            <select name="linked" class="form-control" required>
                                                <option value="">Selecione</option>
                                                <option value="S">Sim</option>
                                                <option value="N">Não</option>
                                            </select>
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