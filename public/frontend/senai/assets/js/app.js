/** Busca com autocomplete 8
 *
 */
var autocomplete = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: '/busca/autocomplete?q=%QUERY',
        wildcard: '%QUERY'
    }
});

var template = '<ul class="bar-autocomplete" style="display:none">' +
    '@{{#suggestions}}<li class="casa-color-bg"><a href="/busca/?q=@{{.}}"><strong>@{{.}}</strong></a></li>@{{/suggestions}} ' +
    '<li class="casa-color-bg-dark text-right"><a href="/busca/"><strong>+ Mais resultados</strong></a></li>' +
    '</ul>';
Mustache.parse(template);

var elBuscaInput = $('input[placeholder="BUSCA"]');
elBuscaInput.typeahead(null, {
    name: 'busca',
    source: autocomplete,
    templates: {
        empty: "",
        suggestion: function (context) {
            var html = Mustache.render(template, {'suggestions': context});
            console.log(context);
            console.log(html);
            return html;
        }
    }
});
elBuscaInput.bind('keyup', function (event) {
    if ($(this).val() === "")
        $('form.top-search ul.bar-autocomplete').remove();
});
elBuscaInput.bind('typeahead:render', function (event, datum) {
    if (typeof datum !== "undefined" && datum.length > 0) {
        $('form.top-search >  ul.bar-autocomplete, .mobile-menu form > ul.bar-autocomplete').remove();
        $('div.tt-menu ul.bar-autocomplete').insertAfter('form.top-search label.col-md-10, .mobile-menu .search-input');
        $('ul.bar-autocomplete li:odd').addClass('casa-color-bg-dark');
        $('ul.bar-autocomplete').show();
    } else {
        $('ul.bar-autocomplete').remove();
    }
});

/*
*
* Estados e Cidades
*
* */

$(".estados-json").jsonCidadesEstados({
    titleName: 'Selecione o estado',
    typeName: 'sigla',
    urlJson: 'https://static-cms-si.s3.amazonaws.com/js/estados_cidades.json'
});

var areas = [{"id": "BR-AC"},
    {"id": "BR-AL"},
    {"id": "BR-AM"},
    {"id": "BR-AP"},
    {"id": "BR-BA"},
    {"id": "BR-CE"},
    {"id": "BR-DF"},
    {"id": "BR-ES"},
    {"id": "BR-GO"},
    {"id": "BR-MA"},
    {"id": "BR-MG"},
    {"id": "BR-MS"},
    {"id": "BR-MT"},
    {"id": "BR-PA"},
    {"id": "BR-PB"},
    {"id": "BR-PE"},
    {"id": "BR-PI"},
    {"id": "BR-PR"},
    {"id": "BR-RJ"},
    {"id": "BR-RN"},
    {"id": "BR-RO"},
    {"id": "BR-RR"},
    {"id": "BR-RS"},
    {"id": "BR-SC"},
    {"id": "BR-SE"},
    {"id": "BR-SP"},
    {"id": "BR-TO"}];


setTimeout(function () {

    $('.estados-json').on('change', function () {
        var elSelected = $('.estados-json option:selected').val(),
            elSelectedId = "BR-" + elSelected;

        map.clickMapObject(map.getObjectById(elSelectedId));
    });

});

var showBoxInfo = function (elSelected) {
    var el = $('.box-info > div[area-sigla="' + elSelected + '"]'),
        elHide = $('.box-info > div[area-sigla="' + elSelected + '"]:hidden'),
        elVisible = $('.box-info > div:visible');

    if (elHide) {
        elVisible.hide();
        el.fadeIn();
    }

};

var map = AmCharts.makeChart("chartdiv", {
    "type": "map",
    "listeners": [{
        "event": "clickMapObject",
        "method": function (event) {

            var elSelected = event['mapObject']['groupId'].split('-')[1];

            $('.estados-json option[value="' + elSelected + '"]').prop('selected', 'selected');

            showBoxInfo(elSelected);

            //GTM
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({'event': 'mapa-contato', 'eventLabel': elSelected});

        }
    }],
    "dataProvider": {
        "map": "brazilLow",
        "areas": areas
    },
    "zoomOnDoubleClick": false,
    "areasSettings": {
        "autoZoom": false,
        "selectable": true,
        "color": "#cecece",
        "selectedColor": "#b6b6b6",
        "rollOverColor": "#b6b6b6",
        "rollOverOutlineColor": "#ffffff"
    },
    "dragMap": false,
    "zoomControl": {
        "zoomControlEnabled": false,
        "homeButtonEnabled": false
    },
    "imagesSettings": {
        "labelPosition": "middle",
        "labelFontSize": 14,
        "labelRollOverColor": "#000000"
    }
});

map.addListener("init", function () {
    // set up a longitude exceptions for certain areas
    var longitude = {};

    var latitude = {
        "BR-BA": -11.9,
        "BR-PI": -7.9,
        "BR-PA": -4.9,
        "BR-SC": -26.9
    };

    setTimeout(function () {
        // iterate through areas and put a label over center of each
        map.dataProvider.images = [];
        for (x in map.dataProvider.areas) {
            var area = map.dataProvider.areas[ x ];
            area.groupId = area.id;
            var image = new AmCharts.MapImage();
            image.latitude = latitude[ area.id ] || map.getAreaCenterLatitude(area);
            image.longitude = longitude[ area.id ] || map.getAreaCenterLongitude(area);
            image.label = area.id.split('-').pop();
            image.title = area.title;
            image.linkToObject = area;
            image.groupId = area.id;
            map.dataProvider.images.push(image);
        }
        map.validateData();
    }, 100)
});