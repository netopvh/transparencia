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

@section('scripts')
    <script>
        $(document).ready(function () {
            $("#telefone").inputmask({"mask": "(99) 99999-9999"});

            //Custon validation
            var validator = $(".form-validate").validate({
                ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
                errorClass: 'validation-error-label',
                successClass: 'validation-valid-label',
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },

                // Different components require proper error label placement
                errorPlacement: function(error, element) {

                    // Styled checkboxes, radios, bootstrap switch
                    if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                        if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                            error.appendTo( element.parent().parent().parent().parent() );
                        }
                        else {
                            error.appendTo( element.parent().parent().parent().parent().parent() );
                        }
                    }

                    // Unstyled checkboxes, radios
                    else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                        error.appendTo( element.parent().parent().parent() );
                    }

                    // Input with icons and Select2
                    else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                        error.appendTo( element.parent() );
                    }

                    // Inline checkboxes, radios
                    else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo( element.parent().parent() );
                    }

                    // Input group, styled file input
                    else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                        error.appendTo( element.parent().parent() );
                    }

                    else {
                        error.insertAfter(element);
                    }
                },
                validClass: "validation-valid-label"
            });
        });
    </script>
@stop


@section('content')
    <div class="row">
        <div class="col-xs-12">
            Criado em julho de 1946, o Serviço Social da Indústria (SESI) tem como desafio desenvolver uma
            educação de excelência voltada para o mundo do trabalho e aumentar a produtividade da indústria,
            promovendo a qualidade de vida do trabalhador.
            <br><br>
            O SESI RO oferece soluções para as empresas industriais por meio de uma rede integrada,
            que engloba atividades de Educação Básica e continuada, Promoção da Saúde e Segurança no trabalho.
            <br><br>
        </div>
    </div>
    <form action="" class="form-validate" autocomplete="off">
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
                    <input type="text" id="telefone" class="form-control" name="telefone" required>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group">
                    <label>Estado</label>
                    <select name="estado" class="form-control">
                        <option value="">Selecione</option>
                        <option value="RO">RO</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Cidade</label>
                    <select name="cidade" class="form-control">
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