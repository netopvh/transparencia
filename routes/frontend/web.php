<?php

/**
 *
 * ROTAS DO SESI
 *
 */

Route::get('cidades/{idEstado}', 'CidadeController@getCidades');

Route::get('categorias/{idCasa}/{idCatergoria}','ApisController@getCategorias');
Route::get('atuacao/{idCasa}/{idAtua}/{idCategoria}','ApisController@getAtuacao');

Route::group(['prefix' => 'sesi','namespace' => 'Sesi'], function(){
    Route::get('/','IndexController@index')->name('sesi.index');
    Route::get('/{slug}','IndexController@getPage')->name('sesi.page');
    Route::get('/modules/lei-de-diretrizes-orcamentarias','IndexController@getLdo')->name('sesi.ldo');
    Route::get('/modules/demonstracoes-contabeis','IndexController@getContabeis')->name('sesi.contabeis');
    //LDO ITENS
    Route::get('/modules/execucao-orcamentaria-2017','IndexController@getExecucao')->name('sesi.execucao');
    Route::get('/modules/estrutura','IndexController@getRemuneratoria')->name('sesi.remunera');
    Route::get('/modules/dirigentes','IndexController@getDirigentes')->name('sesi.dirigentes');
    Route::get('/modules/tecnicos','IndexController@getTecnicos')->name('sesi.tecnicos');
    Route::get('/modules/sac','IndexController@getSac')->name('sesi.sac');
    Route::post('/modules/sac','IndexController@postSac');
    Route::get('/modules/unidades','IndexController@getUnidades')->name('sesi.unidades');
    Route::get('/modules/gratuidade','IndexController@getGratuidade')->name('sesi.gratuidade');
    Route::get('/modules/faq','IndexController@getFaq')->name('sesi.faq');
    Route::get('/modules/integridade','IndexController@getIntegridade')->name('sesi.integridade');
    Route::get('/modules/infraestrutura','IndexController@getInfraestrutura')->name('sesi.infra');
    Route::get('/modules/contratos-convenios','IndexController@getConvenios')->name('sesi.convenio');
});

Route::group(['prefix' => 'senai','namespace' => 'Senai'], function(){
    Route::get('/','IndexController@index')->name('senai.index');
    Route::get('/{slug}','IndexController@getPage')->name('senai.page');
    Route::get('/modules/lei-de-diretrizes-orcamentarias','IndexController@getLdo')->name('senai.ldo');
    Route::get('/modules/demonstracoes-contabeis','IndexController@getContabeis')->name('senai.contabeis');
    //LDO ITENS
    Route::get('/modules/execucao-orcamentaria-2017','IndexController@getExecucao')->name('senai.execucao');
    Route::get('/modules/estrutura','IndexController@getRemuneratoria')->name('senai.remunera');
    Route::get('/modules/dirigentes','IndexController@getDirigentes')->name('senai.dirigentes');
    Route::get('/modules/tecnicos','IndexController@getTecnicos')->name('senai.tecnicos');
    Route::get('/modules/sac','IndexController@getSac')->name('senai.sac');
    Route::post('/modules/sac','IndexController@postSac');
    Route::get('/modules/unidades','IndexController@getUnidades')->name('senai.unidades');
    Route::get('/modules/gratuidade','IndexController@getGratuidade')->name('senai.gratuidade');
    Route::get('/modules/faq','IndexController@getFaq')->name('senai.faq');
    Route::get('/modules/integridade','IndexController@getIntegridade')->name('senai.integridade');
    Route::get('/modules/infraestrutura','IndexController@getInfraestrutura')->name('senai.infra');
    Route::get('/modules/contratos-convenios','IndexController@getConvenios')->name('senai.convenio');
});