function getUrl() {
    var newURL = window.location.protocol + "//" + window.location.host;
    var pathArray = window.location.pathname.split( '/' );

    if(pathArray.length > 1){
        result = newURL+'/'+pathArray[1]+'/'+pathArray[2]+'/';
    }else{
        result = newURL;
    }
    return result;
}

$(function () {

    var url = getUrl();

    //Mask Telefone
    $("#telefone").inputmask({"mask": "(99) 99999-9999"});

    //Cidades
    $('select[name=estado]').change(function () {
        var idEstado = $(this).val();
        $.get(url + 'cidades/' + idEstado, function (cidades) {
            $('select[name=cidade]').empty();
            $.each(cidades, function (key, value) {
                $('select[name=cidade]').append('<option value=' + value.name + '>' + value.name + '</option>');
            });
        });
    });

    $('.modal-link').on("click", function () {
        $("#mdIntegracao_body").html("Carregando...");
        $("#modal_titulo").html($(this).data().titulo);

        console.log(url);


        if($(this).data().tipo === 1){
            $.get(url + "categorias/"+ $(this).data().casa +"/" +$(this).data().id, function (data) {
                $("#mdIntegracao_body").html(data);
                $('#mdIntegracao').modal("show");
            });
        }else if($(this).data().tipo === 2){
            $.get(url + "atuacao/"+ $(this).data().casa +"/" + $(this).data().titulo +"/" +$(this).data().id, function (data) {
                $("#mdIntegracao_body").html(data);
                $('#mdIntegracao').modal("show");
            });
        }
    });

    //Validation
    var validator = $(".form-validate").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function (error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent().parent().parent());
                }
                else {
                    error.appendTo(element.parent().parent().parent().parent().parent());
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo(element.parent().parent().parent());
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo(element.parent());
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo(element.parent().parent());
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo(element.parent().parent());
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label"
    });
});