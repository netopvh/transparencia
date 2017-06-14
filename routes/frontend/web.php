<?php

/**
 *
 * ROTAS DO SESI
 *
 */

Route::get('cidades/{idEstado}', 'CidadeController@getCidades');

Route::group(['prefix' => 'sesi','namespace' => 'Sesi'], function(){
    Route::get('/','IndexController@index')->name('sesi.index');
    Route::get('/{slug}','IndexController@getPage')->name('sesi.page');
    Route::get('/modules/estrutura','IndexController@getRemuneratoria')->name('sesi.remunera');
    Route::get('/modules/dirigentes','IndexController@getDirigentes')->name('sesi.dirigentes');
    Route::get('/modules/tecnicos','IndexController@getTecnicos')->name('sesi.tecnicos');
    Route::get('/modules/sac','IndexController@getSac')->name('sesi.sac');
    Route::post('/modules/sac','IndexController@postSac');
    Route::get('/modules/gratuidade','IndexController@getGratuidade')->name('sesi.gratuidade');
});

Route::group(['prefix' => 'senai','namespace' => 'Senai'], function(){
    Route::get('/','IndexController@index')->name('senai.index');
    Route::get('/{slug}','IndexController@getPage')->name('senai.page');
    Route::get('/modules/estrutura','IndexController@getRemuneratoria')->name('senai.remunera');
    Route::get('/modules/dirigentes','IndexController@getDirigentes')->name('senai.dirigentes');
    Route::get('/modules/tecnicos','IndexController@getTecnicos')->name('senai.tecnicos');
    Route::get('/modules/sac','IndexController@getSac')->name('senai.sac');
    Route::post('/modules/sac','IndexController@postSac');
    Route::get('/modules/gratuidade','IndexController@getGratuidade')->name('senai.gratuidade');
});