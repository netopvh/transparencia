@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript" src="{{ asset('public/backend/assets/js/modules/dirigentes.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Editar</h5>

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
                        <form action="{{ route('admin.dirigentes.update', ['id'=> $dirigente->id]) }}" method="post" class="form-validate">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="form-group">
                                        <label class="control-label">Nome do Dirigente:</label>
                                        <input type="text" value="{{ $dirigente->nome }}" class="form-control upper" name="nome" minlength="4" required>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label>Casa:</label>
                                        <select name="casa_id" class="form-control" required>
                                            <option value="">SELECIONE</option>
                                            @foreach($casas as $casa)
                                                <option value="{{ $casa->id }}"{{ $dirigente->casa_id==$casa->id?' selected':'' }}>{{ $casa->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Cadastrar</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-info"><i
                                                class="icon-reply"></i> Voltar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop