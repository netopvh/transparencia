@extends('backend.layouts.master')

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Gerenciamento de Páginas</h5>

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
                    <div class="container">
                        <a href="{{ route('admin.paginas.dinamica.create') }}" class="btn btn-primary"><i
                                    class="icon-plus-circle2"></i> Cadastrar</a>
                    </div>
                    <br>
                    <div class="panel-body">
                        <div class="tabbable tab-content-bordered">
                            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                                <li class="active"><a href="#bordered-justified-tab1" data-toggle="tab">SESI</a></li>
                                <li><a href="#bordered-justified-tab2" data-toggle="tab">SENAI</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane has-padding active" id="bordered-justified-tab1">

                                </div>

                                <div class="tab-pane has-padding" id="bordered-justified-tab2">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop