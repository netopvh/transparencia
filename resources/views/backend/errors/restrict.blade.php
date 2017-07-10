@extends('backend.layouts.master')
@section('scripts-after')
    <script src="{{ asset('backend/assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/modules/users.js') }}"></script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Atenção</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="container">
                        <div class="alert bg-warning alert-styled-left">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                            <span class="text-semibold">Atenção!</span> Você não tem permissão para acessar esta área!, Contacte o administrador do sistema.
                        </div>
                        <br>
                        <img src="{{ asset('backend/assets/images/restrito.jpg') }}" class="center-block" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop