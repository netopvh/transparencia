function getUrl() {
    var newURL = window.location.protocol + "//" + window.location.host;
    var pathArray = window.location.pathname.split( '/' );

    if(pathArray.indexOf('public') > -1){
        result = newURL+'/'+pathArray[1]+'/'+pathArray[2]+'/';
    }else{
        result = newURL;
    }
    return result;
}

$(function () {

    //TESTE

    var casa_code = 3;
    var id_contrato = 0;

    //Development
    var domain = 'http://portalh4.sistemaindustria.org.br:9080/api-basi/v1';
    //production
    //var domain = 'http://ws.sistemaindustria.org.br/api-basi/v1';

    $( "#select-unidades-estados" ).change(function() {
        $("#container-resultado").text("");
        var UF = $(this).find('option:selected').attr("value");
        var url = domain + '/transparencia/entidades/' + casa_code + '/estados/'+UF+'/unidades';
        $.ajax({
            url: url,
            crossDomain: true,
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                $.each(response, function (name, value) {
                    box = '<div class="col-xs-12 col-sm-6 col-md-4 nth">';
                    box += '<div class="card bg-cinza-claro">';
                    box += '<div>';
                    box += '<div class="c-22 casa logo-sistema-s">=SENAI=</div>';
                    box += '</div>';
                    box += '<div class="unititulo">';
                    box += '<i class="fa fa-map-marker"></i>';
                    box += '<div class="dc">';
                    box += '<h3>'+value.nomeUnidade+'</h3>';
                    box += '</div>';
                    box += '</div>';
                    box += '<div class="unitexto">';
                    box += '<p><strong>Endereço:</strong> '+value.nomeRua+', '+value.numeroEndereco;
                    box += '- '+ value.nomeBairro;
                    box += '- '+value.nomeCidade+'</p>';
                    box += '<p><strong>Tipo:</strong> '+value.tipoUnidade+'</p>';
                    box += '<p><strong>Responsável:</strong> '+value.nomeResponsavel+'</p>';
                    box += '<p><strong>Telefone:</strong> '+value.telefone+'</p>';
                    box += '<p><strong>Site:</strong> '+value.site+'</p>';
                    box += '<p><strong>Email:</strong> '+value.email+'</p>';
                    box += '</div>';
                    box += '</div>';
                    box += '</div>';
                    $('#container-resultado').append(box);
                })
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                $('#container-resultado').html('<p class="text-bold">Sem registros á exibir</p>');
            }
        });
    });

    $(document).ready(function () {
        if (casa_code) {
            var url = domain + '/entidades/' + casa_code + '/departamentos/';
            $.ajax({
                url: url,
                crossDomain: true,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    for (var i = 0; i < response.length; i++) {
                        department_code = response[i].sigla;
                        if (department_code === 'SENAI-RO') {
                            $.ajax({
                                url: domain + '/transparencia/entidades/' + casa_code + '/departamentos/' + department_code + '/contratos',
                                crossDomain: true,
                                method: 'GET',
                                dataType: 'json',
                                success: function (response) {
                                    contracts = [];
                                    for (var ii = 0; ii < response.length; ii++) {
                                        id_contrato++;
                                        response[ii].idContrato = id_contrato;
                                        contracts.push(response[ii]);
                                    }
                                    $.each(contracts, function (name, value) {
                                        //console.log(value.numeroContrato)
                                        table = '<tr data-cnpj="' + value.cnpj + '" data-modalidade="' + value.modalidade + '" ';
                                        table += 'data-rateio="' + value.detalheRateio + '" data-avenca="' + value.dataContrato + '" ';
                                        table += 'data-id-contract="' + value.idContrato + '" data-number-contract="' + value.numeroContrato + '" ';
                                        table += 'data-categoria="'+value.categoriaObjeto+'" data-razao="'+ value.razaoSocial+'" data-vigencia="'+value.vigencia+'" ';
                                        table += 'data-valor="'+value.valor+'" data-processo="'+value.numeroProcesso+'">';
                                        table += '<td>' + value.numeroContrato + '</td>';
                                        table += '<td>' + value.dataContrato + '</td>';
                                        table += '<td>' + value.razaoSocial + '</td>';
                                        table += '<td>' + value.cnpj + '</td>';
                                        table += '<td>' + value.valor + '</td>';
                                        table += '<td>+</td>';
                                        table += '</tr>';
                                        $('#table-contracts tbody').append(table);
                                    });
                                    //var template_index_rendered = Mustache.render(template_index, data);
                                    //var template_details_rendered = Mustache.render(template_details, data);
                                    //$('#table-453811-contracts tbody').append(template_index_rendered);
                                    //$('#contracts-data').append(template_details_rendered);
                                }
                            });
                        }
                    }
                }
            });
        }
    });


    $('#table-contracts').on('click', '[data-id-contract]', function () {
        contract_number = $(this).attr('data-number-contract');
        avenca = $(this).attr('data-avenca');
        rateio = $(this).attr('data-rateio');
        modalidade = $(this).attr('data-modalidade');
        categoria = $(this).attr('data-categoria');
        cnpj = $(this).attr('data-cnpj');
        razao = $(this).attr('data-razao');
        vigencia = $(this).attr('data-vigencia');
        valor = $(this).attr('data-valor');
        processo = $(this).attr('data-processo');
        //contract_data = $('#table-contract-' + contract_id);
        table_modal = '<table width="100%">';
        table_modal += '<tr>';
        table_modal += '<td width="50%"><b>Data do Contrato / Avença:</b></td>';
        table_modal += '<td align="right">' + avenca + '</td>';
        table_modal += '</tr>';
        table_modal += '<tr>';
        table_modal += '<td width="50%"><b>Rateio:</b></td>';
        table_modal += '<td align="right">' + rateio + '</td>';
        table_modal += '</tr>';
        table_modal += '<tr>';
        table_modal += '<tr>';
        table_modal += '<td width="50%"><b>Modalidade:</b></td>';
        table_modal += '<td align="right">' + modalidade + '</td>';
        table_modal += '</tr>';
        table_modal += '<tr>';
        table_modal += '<tr>';
        table_modal += '<td width="50%"><b>Categoria:</b></td>';
        table_modal += '<td align="right">' + categoria + '</td>';
        table_modal += '</tr>';
        table_modal += '<tr>';
        table_modal += '<td width="50%"><b>CNPJ:</b></td>';
        table_modal += '<td align="right">' + cnpj + '</td>';
        table_modal += '</tr>';
        table_modal += '<tr>';
        table_modal += '<td width="50%"><b>Razão Social:</b></td>';
        table_modal += '<td align="right">' + razao + '</td>';
        table_modal += '</tr>';
        table_modal += '<tr>';
        table_modal += '<tr>';
        table_modal += '<td width="50%"><b>Vigência:</b></td>';
        table_modal += '<td align="right">' + vigencia + '</td>';
        table_modal += '</tr>';
        table_modal += '<tr>';
        table_modal += '<tr>';
        table_modal += '<td width="50%"><b>Valor:</b></td>';
        table_modal += '<td align="right">' + valor + '</td>';
        table_modal += '</tr>';
        table_modal += '<tr>';
        table_modal += '<tr>';
        table_modal += '<td width="50%"><b>Processo:</b></td>';
        table_modal += '<td align="right">' + processo + '</td>';
        table_modal += '</tr>';
        table_modal += '<tr>';
        table_modal += '</table>';
        $('.modal-title').html('Contrato Nº ' + contract_number);
        $('#modal-contrato .modal-body').html(table_modal);
        $('#modal-contrato').modal();
    });


    var url = getUrl();

    //Mask Telefone
    $("#telefone").inputmask({"mask": "(99) 99999-9999"});

    //Cidades
    $('select[name=estado]').change(function () {
        var idEstado = $(this).val();
        $.get(url + '/cidades/' + idEstado, function (cidades) {
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
            $.get(url + "/categorias/"+ $(this).data().casa +"/" +$(this).data().id, function (data) {
                $("#mdIntegracao_body").html(data);
                $('#mdIntegracao').modal("show");
            });
        }else if($(this).data().tipo === 2){
            $.get(url + "/atuacao/"+ $(this).data().casa +"/" + $(this).data().titulo +"/" +$(this).data().id, function (data) {
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