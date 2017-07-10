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

Route::get('/restrict', function (){
    return view('backend.errors.restrict');
})->name('admin.restrito')->middleware('auth');

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
        Route::get('/change', 'UserController@viewChangePassword')->name('admin.users.password');
        Route::get('/create', 'UserController@create')->name('admin.users.create');
        Route::post('/create', 'UserController@store')->name('admin.users.store');
        Route::get('/{id}/edit', 'UserController@edit')->name('admin.users.edit');
        Route::patch('/{id}/update', 'UserController@update')->name('admin.users.update');
        Route::post('/change','UserController@changePassword');
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
        Route::get('/dinamicas','PaginaController@indexDinamica')->name('admin.paginas.dinamica');
        Route::get('/dinamicas/create','PaginaController@createDinamica')->name('admin.paginas.dinamica.create');
        Route::post('/dinamicas','PaginaController@storeDinamica')->name('admin.paginas.dinamica.store');
        Route::get('/dinamicas/{id}','PaginaController@editDinamica')->name('admin.paginas.dinamica.edit');
        Route::patch('/dinamicas/{id}','PaginaController@updateDinamica')->name('admin.paginas.dinamica.update');
        Route::get('/estaticas','PaginaController@indexEstatica')->name('admin.paginas.estatica');
    });
    Route::group(['prefix' => 'remunera'], function(){
        Route::get('/','RemuneratoriaController@index')->name('admin.remunera.index');
        Route::post('/','RemuneratoriaController@store');
        Route::get('/import','RemuneratoriaController@viewImport')->name('admin.remunera.import');
        Route::post('/import','RemuneratoriaController@storeImport');
        Route::get('/{id}','RemuneratoriaController@edit')->name('admin.remunera.edit');
        Route::patch('/{id}','RemuneratoriaController@update')->name('admin.remunera.update');
        Route::delete('/{id}','RemuneratoriaController@delete')->name('admin.remunera.delete');
    });
    Route::group(['prefix' => 'dirigentes'], function(){
        Route::get('/','DirigenteController@index')->name('admin.dirigentes.index');
        Route::post('/','DirigenteController@store');
        Route::get('/import','DirigenteController@viewImport')->name('admin.dirigentes.import');
        Route::post('/import','DirigenteController@storeImport');
        Route::get('/{id}','DirigenteController@edit')->name('admin.dirigentes.edit');
        Route::patch('/{id}','DirigenteController@update')->name('admin.dirigentes.update');
        Route::delete('/{id}','DirigenteController@delete')->name('admin.dirigentes.delete');
        Route::post('/files','DirigenteController@filesImporter')->name('admin.dirigentes.files');
    });
    Route::group(['prefix' => 'tecnicos'], function(){
        Route::get('/','TecnicoController@index')->name('admin.tecnicos.index');
        Route::post('/','TecnicoController@store');
        Route::get('/import','TecnicoController@viewImport')->name('admin.tecnicos.import');
        Route::post('/import','TecnicoController@storeImport');
        Route::get('/{id}','TecnicoController@edit')->name('admin.tecnicos.edit');
        Route::patch('/{id}','TecnicoController@update')->name('admin.tecnicos.update');
        Route::delete('/{id}','TecnicoController@delete')->name('admin.tecnicos.delete');
    });

    Route::group(['prefix' => 'orcamentos'], function(){
        Route::get('/','OrcamentoController@index')->name('admin.orcamento.index');
        Route::post('/','OrcamentoController@store')->name('admin.orcamento.store');
        Route::get('/{id}','OrcamentoController@edit')->name('admin.orcamento.edit');
        Route::patch('/{id}','OrcamentoController@update')->name('admin.orcamento.update');
        Route::delete('/{id}','OrcamentoController@delete')->name('admin.orcamento.delete');
    });

    Route::group(['prefix' => 'contabil'], function(){
        Route::get('/','ContabilController@index')->name('admin.contabil.index');
        Route::post('/','ContabilController@store')->name('admin.contabil.store');
        Route::get('/{id}','ContabilController@edit')->name('admin.contabil.edit');
        Route::patch('/{id}','ContabilController@update')->name('admin.contabil.update');
        Route::delete('/{id}','ContabilController@delete')->name('admin.contabil.delete');
    });

    Route::group(['prefix' => 'integridade'], function(){
        Route::get('/','IntegridadeController@index')->name('admin.integridade.index');
        Route::get('/create','IntegridadeController@create')->name('admin.integridade.create');
        Route::post('/','IntegridadeController@store')->name('admin.integridade.store');
        Route::get('/{id}','IntegridadeController@edit')->name('admin.integridade.edit');
        Route::patch('/{id}','IntegridadeController@update')->name('admin.integridade.update');
        Route::delete('/{id}','IntegridadeController@delete')->name('admin.integridade.delete');
        Route::post('/publish/{id}','IntegridadeController@publish')->name('admin.integridade.publish');
        Route::post('/unpublish/{id}','IntegridadeController@unpublish')->name('admin.integridade.unpublish');
    });

    Route::group(['prefix' => 'convenio'], function(){
        Route::get('/','ConvenioController@index')->name('admin.convenio.index');
        Route::get('/create','ConvenioController@create')->name('admin.convenio.create');
        Route::post('/','ConvenioController@store')->name('admin.convenio.store');
        Route::get('/{id}','ConvenioController@edit')->name('admin.convenio.edit');
        Route::patch('/{id}','ConvenioController@update')->name('admin.convenio.update');
        Route::delete('/{id}','ConvenioController@delete')->name('admin.convenio.delete');
    });

    Route::group(['prefix' => 'infraestrutura'], function(){
        Route::get('/','InfraestruturaController@index')->name('admin.infra.index');
        Route::get('/import','InfraestruturaController@viewImport')->name('admin.infra.import');
        Route::get('/{id}','InfraestruturaController@edit')->name('admin.infra.edit');
        Route::patch('/{id}','InfraestruturaController@update')->name('admin.infra.update');
        Route::delete('/{id}','InfraestruturaController@delete')->name('admin.infra.delete');
        Route::post('/import','InfraestruturaController@postImport');
    });

    Route::group(['prefix' => 'faq'], function (){
        Route::get('/','FaqController@index')->name('admin.faq.index');
        Route::get('/create','FaqController@create')->name('admin.faq.create');
        Route::post('/','FaqController@store')->name('admin.faq.store');
        Route::get('/{id}','FaqController@edit')->name('admin.faq.edit');
        Route::post('/{id}','FaqController@update')->name('admin.faq.update');
        Route::delete('/{id}','FaqController@delete')->name('admin.faq.delete');
    });

    Route::group(['prefix'=>'files'], function(){
        Route::get('/','ArquivoController@index')->name('admin.arquivos.index');
    });
});

