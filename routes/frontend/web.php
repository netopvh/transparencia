<?php

/**
 *
 * ROTAS DO SESI
 *
 */


Route::group(['prefix' => 'sesi','namespace' => 'Sesi'], function(){
    Route::get('/','IndexController@index')->name('sesi.index');
});