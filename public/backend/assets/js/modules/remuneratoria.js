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
                extension: "Permitido apenas arquivos no formato XLSX/XLS"
            }
        }

    });

    var button = $('#button');
    var form = $('#formImport');
    var loader = $('#loader');
    loader.hide();
    form.submit(function () {
        if (validator.numberOfInvalids() < 1){
            loader.show();
            button.prop('disabled', true);
        }
    });

    var inicial = $("input[name='ponto_ini']");
    var final = $("input[name='ponto_fin']");

    inicial.maskMoney();
    final.maskMoney();
    $("form").submit(function() {
        inicial.val(inicial.maskMoney('unmasked')[0]);
        final.val(final.maskMoney('unmasked')[0]);
    });

    var cargo = $("input[name='cargo']");

    $('.upper').bind('keyup',function (e) {
        cargo.val((cargo.val()).toUpperCase());
    });
});

