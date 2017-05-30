@extends('frontend.sesi.layouts.master')

@section('breadcrumb')
    <ul class="breadcrumb-local bg-cinza-claro">
        <li>
            <a href="{{ route('sesi.index') }}" class="casa-color">Transparência</a>
        </li>
        <span class="casa-color"> > </span>
        <li>
            Fale Conosco
        </li>
    </ul>
@stop

@section('title')
    Fale Conosco
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            O <b>Serviço Social Industrial (SESI)</b> é reconhecido como modelo de educação profissional e pela qualidade dos
            serviços tecnológicos que promovem a inovação na indústria brasileira. Desde que foi criado, em 1942, o SESi formou mais de
            55 milhões de profissionais. Clique aqui para saber mais sobre o SENAI.
            <br><br>
            Caso você queira saber mais sobre cursos e ações do SENAI, você pode buscar informações diretamente em uma unidade no seu estado.
            <br>
            Clique aqui para ter acesso aos telefones e endereços de todos os departamentos regionais.
            <br><br>
            Preencha os campos abaixo com as informações solicitadas para entrar em contato com o Sistema indústria:
            <br><br>
        </div>
    </div>
    <form action="" autocomplete="off">
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Nome Completo</label>
                    <input type="text" class="form-control" name="nome">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email">
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
                    <input type="text" class="form-control" name="telefone">
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <label>Estado</label>
                    <select name="estado" class="form-control">
                        <option value="">Selecione</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Cidade</label>
                    <select name="cidade" class="form-control">
                        <option value="">Selecione</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Assunto</label>
                    <select name="assunto" class="form-control">
                        <option value="">Selecione</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Categoria</label>
                    <select name="categoria" class="form-control">
                        <option value="">Selecione</option>
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
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label>Mensagem</label>
                    <textarea name="mensagem" class="form-control" cols="30" rows="5"></textarea>
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