@extends('backend.layouts.master')

@section('scripts-after')
    <script type="text/javascript" src="{{ asset('backend/assets/js/modules/infraestrutura.js') }}"></script>
    <script>
        $('.header').click(function(){
            $(this).toggleClass('expand').nextUntil('tr.header').slideToggle(100);
        });
    </script>
@stop

@section('content')
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Dados de Infraestrutura</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="container">
                        <a href="{{ route('admin.infra.import') }}" class="btn btn-primary"><i
                                    class="icon-database-refresh"></i> Importar Registro DN</a>
                    </div>
                    @if (notify()->ready())
                        <br>
                        <div class="alert alert-{{ notify()->type() }} alert-styled-left">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                        class="sr-only">Close</span></button>
                            <span class="text-semibold">{{ notify()->message() }}</span>
                        </div>
                    @endif
                    <br>
                    <table class="table table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th width="20"></th>
                            <th>Unidade</th>
                            <th>Cidade</th>
                            <th>Entidade</th>
                            <th>Categoria</th>
                            <th class="text-center" width="80">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($dados) >= 1)
                            @foreach($dados as $dado)
                                <tr class="header expand">
                                    <td><i class="text-primary icon-plus3"></i></td>
                                    <td>{{ $dado->unidade }}</td>
                                    <td>{{ $dado->cidade }}</td>
                                    <td>{{ $dado->casa }}</td>
                                    <td>{{ $dado->nome_categoria }}</td>
                                    <td></td>
                                </tr>
                                <tr style="display: none">
                                    <td></td>
                                    <th colspan="5">Atuações</th>
                                </tr>
                                @if($dado->codigo_atuacao >= 1)
                                    <tr style="display: none">
                                        <td><i class="icon-forward"></i></td>
                                        <td colspan="5">{{ $dado->nome_atuacao }}</td>
                                    </tr>
                                @else
                                    @foreach($dado->atuacoes as $atuacao)
                                        <tr style="display: none">
                                            <td><i class="icon-forward"></i></td>
                                            <td colspan="5">{{ $atuacao->nome_atuacao }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center text-bold">Sem Registros a serem exibidos</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    {{ $dados->links() }}
                </div>
            </div>
        </div>
    </div>
@stop