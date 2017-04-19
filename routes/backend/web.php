<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'HomeController@index')->name('admin.home')->middleware('auth');

Route::group(['namespace' => 'Access'], function () {
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', 'RoleController@index')->name('admin.roles.index');
        Route::get('/create', 'RoleController@create')->name('admin.roles.create');
        Route::post('/create', 'RoleController@store')->name('admin.roles.store');
        Route::get('/{id}/edit', 'RoleController@edit')->name('admin.roles.edit');
        Route::patch('/{id}/update', 'RoleController@update')->name('admin.roles.update');
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('admin.users.index');
        Route::get('/create', 'UserController@create')->name('admin.users.create');
        Route::post('/create', 'UserController@store')->name('admin.users.store');
        Route::get('/{id}/edit', 'UserController@edit')->name('admin.users.edit');
        Route::patch('/{id}/update', 'UserController@update')->name('admin.users.update');
    });
    Route::get('logs', 'LogViewController@index')->name('admin.logs.index');
});

Route::group(['namespace' => 'Application'], function(){
    Route::group(['prefix' => 'organization'], function(){
        Route::get('/','CasaController@index')->name('admin.casas.index');
        Route::get('/create','CasaController@create')->name('admin.casas.create');
        Route::post('/create','CasaController@store')->name('admin.casas.store');
        Route::get('/{id}/edit', 'CasaController@edit')->name('admin.casas.edit');
        Route::patch('/{id}/update', 'CasaController@update')->name('admin.casas.update');
        Route::delete('/{id}','CasaController@delete')->name('admin.casas.delete');
    });
    Route::group(['prefix' => 'menu'], function(){
        Route::get('/','MenuController@index')->name('admin.menus.index');
        Route::get('/create','MenuController@create')->name('admin.menus.create');
        Route::post('/','MenuController@store')->name('admin.menus.store');
        Route::get('/{id}','MenuController@edit')->name('admin.menus.edit');
        Route::patch('/{id}','MenuController@update')->name('admin.menus.update');
    });
    Route::group(['prefix' => 'paginas'], function(){
        Route::get('/','PaginaController@index')->name('admin.paginas.index');
        Route::get('/create','PaginaController@create')->name('admin.paginas.create');
        Route::post('/','PaginaController@store')->name('admin.paginas.store');
        Route::get('/{id}','PaginaController@edit')->name('admin.paginas.edit');
        Route::patch('/{id}','PaginaController@update')->name('admin.paginas.update');
    });
    Route::group(['prefix' => 'remunera'], function(){
        Route::get('/','RemuneratoriaController@index')->name('admin.remunera.index');
        Route::post('/','RemuneratoriaController@store');
        Route::get('/import','RemuneratoriaController@viewImport')->name('admin.remunera.import');
        Route::post('/import','RemuneratoriaController@storeImport');
        Route::get('/{id}','RemuneratoriaController@edit')->name('admin.remunera.edit');
        Route::patch('/{id}','RemuneratoriaController@update')->name('admin.remunera.update');
    });
    Route::group(['prefix' => 'dirigentes'], function(){
        Route::get('/','DirigenteController@index')->name('admin.dirigentes.index');
        Route::post('/','DirigenteController@store');
        //Route::get('/import','DirigenteController@viewImport')->name('admin.dirigentes.import');
        //Route::post('/','DirigenteController@storeImport')->name('admin.dirigentes.importing');
        Route::get('/{id}','DirigenteController@edit')->name('admin.dirigentes.edit');
        Route::patch('/{id}','DirigenteController@update')->name('admin.dirigentes.update');
    });
    Route::group(['prefix' => 'tecnicos'], function(){
        Route::get('/','TecnicoController@index')->name('admin.tecnicos.index');
        Route::post('/','TecnicoController@store');
        //Route::get('/import','TecnicoController@viewImport')->name('admin.tecnicos.import');
        //Route::post('/','TecnicoController@storeImport')->name('admin.tecnicos.importing');
        Route::get('/{id}','TecnicoController@edit')->name('admin.tecnicos.edit');
        Route::patch('/{id}','TecnicoController@update')->name('admin.tecnicos.update');
    });
    Route::group(['prefix'=>'files'], function(){
        Route::get('/','ArquivoController@index')->name('admin.arquivos.index');
    });
});

