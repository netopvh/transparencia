@extends('frontend.senai.layouts.master')

@section('breadcrumb')
    <ul class="breadcrumb-local bg-cinza-claro">
        <li>
            <a href="{{ route('senai.index') }}" class="casa-color">Transparência</a>
        </li>
        <span class="casa-color"> > </span>
        <li>
            Fale Conosco
        </li>
    </ul>
@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            $("#telefone").inputmask({"mask": "(99) 99999-9999"});
        });
    </script>
@stop

@section('title')
    Fale Conosco
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            O <b>Serviço Nacional de Aprendizagem Industrial (SENAI)</b> é reconhecido como modelo de educação
            profissional e pela qualidade dos
            serviços tecnológicos que promovem a inovação na indústria brasileira. Desde que foi criado, em 1942, o
            SENAI formou mais de
            55 milhões de profissionais. Clique aqui para saber mais sobre o SENAI.
            <br><br>
            Caso você queira saber mais sobre cursos e ações do SENAI, você pode buscar informações diretamente em uma
            unidade no seu estado.
            <br>
            Clique aqui para ter acesso aos telefones e endereços de todos os departamentos regionais.
            <br><br>
            Preencha os campos abaixo com as informações solicitadas para entrar em contato com o Sistema indústria:
            <br><br>
        </div>
    </div>
    <form action="{{ route('senai.sac') }}" method="post" autocomplete="off">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Nome Completo</label>
                    <input type="text" class="form-control" name="nome" required>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Empresa</label>
                    <input type="text" class="form-control" name="empresa">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" id="telefone" class="form-control" name="telefone">
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <label>Estado</label>
                    <select name="estado" class="form-control" required>
                        <option value="">Selecione</option>
                        <option value="RO">RO</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Cidade</label>
                    <select name="cidade" class="form-control" required>
                        <option value="">Selecione</option>
                        <option value="Porto Velho">Porto Velho</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Assunto</label>
                    <select name="assunto" class="form-control" required>
                        <option value="">Selecione</option>
                        <option value="Dúvidas">Dúvidas</option>
                        <option value="Informações">Informações</option>
                        <option value="Sugestões">Sugestões</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Categoria</label>
                    <select name="categoria" class="form-control" required>
                        <option value="">Selecione</option>
                        <option value="Empresa">Empresa</option>
                        <option value="Estudante">Estudante</option>
                        <option value="Professor/Pesquisador">Professor/Pesquisador</option>
                        <option value="Trabalhador da Indústria">Trabalhador da Indústria</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Instituição</label>
                    <select name="instituicao" class="form-control">
                        <option value="">Selecione</option>
                        <option value="FIERO">FIERO</option>
                        <option value="SESI">SESI</option>
                        <option value="SENAI">SENAI</option>
                        <option value="IEL">IEL</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Mensagem</label>
                    <textarea name="mensagem" class="form-control" cols="30" rows="5" required></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6"></div>
            <div class="col-xs-6">
                <span class="pull-right">
                    <button class="btn btn-info" type="submit">Enviar</button>
                </span>
            </div>
        </div>
    </form>
@stop