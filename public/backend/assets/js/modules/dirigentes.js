$(function () {
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
        validClass: "validation-valid-label",
        rules: {
            arquivo: {
                extension: "xlsx"
            }
        },
        messages: {
            arquivo: {
                extension: "Permitido apenas arquivos no formato XSLX/XLS"
            }
        }

    });

    //Define Atributo Name do Elemento Button do Modal
    $('#notas').on('click',function () {
        $('#send').attr('name','nota');
    });
    $('#files').on('click',function () {
        $('#send').attr('name','files');
    });

    //Redireciona de acordo com o item selecionado
    $('#send').on('click',function (event) {
        url = window.location.href;
        casa = $('select[name="casa"]').find(':selected').data('id');
        if(casa != null){
            if($('#send').attr('name')==='nota'){
                window.location.href = url + '/notas/'+casa;
            }else if($('#send').attr('name')==='files'){
                window.location.href = url + '/files/'+casa;
            }
        }
    });

    var button = $('#button');
    var form = $('#formImport');
    var loader = $('#loader');
    loader.hide();
    form.submit(function () {
        if (validators.numberOfInvalids() < 1){
            loader.show();
            button.prop('disabled', true);
        }
    });

    var nome = $("input[name='nome']");

    $('.upper').bind('keyup',function (e) {
        nome.val((nome.val()).toUpperCase());
    });

    $(".file-styled").uniform({
        fileButtonClass: 'action btn btn-default',
        fileDefaultHtml: 'Selecione o Arquivo',
        fileButtonHtml: 'Selecione'
    });
});

