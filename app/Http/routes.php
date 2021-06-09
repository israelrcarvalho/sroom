<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */



Route::get('/home', 'DashboardController@index');
Route::get('/', 'DashboardController@index');
// Route::get('/mapa-de-eventos', [ 'as'=>'mapadeeventos','uses'=>'RelatoriosController@mapaEventos']);
Route::get('/mapa-de-eventos', [ 'as'=>'mapadeeventos','uses'=>'RelatoriosController@mapaEventos_']);

Route::get('/roles-permission', 'HomeController@rolesPermission');



Route::group(['prefix' => 'relatorio'], function () {

    // Route::get('whats-up', ['as' => 'whats-up', 'uses' => 'RelatoriosController@whatsUp']);
    Route::get('default', ['as' => 'default', 'uses' => 'RelatoriosController@whatsUp']);
    Route::get('porSala', ['as' => 'porSala', 'uses' => 'RelatoriosController@relPorSala']);
    Route::get('timesheet', ['as' => 'timesheet', 'uses' => 'RelatoriosController@timeSheet']);


});


//---
Route::group(['prefix' => 'users'], function () {

    Route::get('index', ['as' => 'users.index', 'uses' => 'UsersController@index']);
    Route::get('{id}/destroy', ['as' => 'users.destroy', 'uses' => 'UsersController@destroy']);
    Route::get('{id}/show', ['as' => 'users.show', 'uses' => 'UsersController@show']);
    Route::get('{id}/update', ['as' => 'users.show', 'uses' => 'UsersController@index']);
});

// rotas para eventos
Route::group(['prefix' => 'eventos', 'middleware' => 'auth'], function () {

    Route::get('/', ['as' => 'eventos.index', 'uses' => 'EventosController@index']);
    Route::get('index', ['as' => 'eventos.index', 'uses' => 'EventosController@index']);

    Route::get('lista-eventos-solicitados', ['as' => 'eventos-solicitados', 'uses' => 'EventosController@listEventsByStatus']);

    Route::get('relatorio-01', ['as' => 'relatorio01', 'uses' => 'EventosController@rel01']);

    Route::get('{id}/edit', ['as' => 'eventos.edit', 'uses' => 'EventosController@edit']);
    Route::get('create', ['as' => 'eventos.create', 'uses' => 'EventosController@create']);
    Route::post('store',       ['as' => 'eventos.store', 'uses' => 'EventosController@store']);
    Route::get('{id}/destroy', ['as' => 'eventos.destroy', 'uses' => 'EventosController@destroy']);
    Route::get('{id}/show',    ['as' => 'eventos.show', 'uses' => 'EventosController@show']);
    Route::post('{id}/update', ['as' => 'eventos.update', 'uses' => 'EventosController@update']);
    Route::get('teste', ['as' => 'teste', 'uses' => 'EventosController@basicData']);
    Route::get('sindicatos', ['as' => 'sindicatos', 'uses' => 'EventosController@atendimentoSindicatos']);

    Route::get('{id}/show/{tab}',    ['as' => 'eventos.show', 'uses' => 'EventosController@show']);

});


// FRONT-END
Route::post('/frontend', ['as' => 'frontendbbb', 'uses' => 'EventosController@frontend']);
Route::get('/form-sol', ['as' => 'form-solicitacao', 'uses' => 'EventosController@formSolicitacao']);


Route::get('/dberros', function () {
    return view('m_erros.dberros');
});


// rotas para recursos
Route::group(['prefix' => 'recursos'], function () {

    Route::get('/', ['as' => 'recursos.index', 'uses' => 'RecursosController@index']);
    Route::get('index', ['as' => 'recursos.index', 'uses' => 'RecursosController@index']);
    Route::get('{id}/edit', ['as' => 'recursos.edit', 'uses' => 'RecursosController@edit']);

    Route::get('create', ['as' => 'recursos.create', 'uses' => 'RecursosController@create']);
    Route::post('store', ['as' => 'recursos.store', 'uses' => 'RecursosController@store']);

    Route::get('{id}/destroy', ['as' => 'recursos.destroy', 'uses' => 'RecursosController@destroy']);
    Route::get('{id}/show', ['as' => 'recursos.show', 'uses' => 'RecursosController@show']);
    Route::post('{id}/update', ['as' => 'recursos.update', 'uses' => 'RecursosController@update']);
    Route::post('{id}/updateModal', ['as' => 'atualizaRecursosModal', 'uses' => 'RecursosController@updateModal']);

    Route::get('{id}/destroyModal', ['as' => 'deletarRecursosDoEventoModal', 'uses' => 'RecursosController@destroyModal']);

    Route::get('{id}/destroyAlimentacaoModal', ['as' => 'deletarRecursosAlimentacaoDoEventoModal', 'uses' => 'RecursosController@destroyAlimentacaoModal']);

    Route::post('{id}/storeModal', ['as' => 'storeModal', 'uses' => 'RecursosController@storeModal']);
    Route::post('storeModalRecursosAlimentacao', ['as' => 'storeModalRecursosAlimentacao', 'uses' => 'RecursosController@storeModalRecursosAlimentacao']);
// -------
});

Route::get('lista-recursos','RecursosController@listRecursosAlimentacaoAjax');
Route::get('lista-recursos-id','RecursosController@recursoById');


// rotas para espaço
Route::group(['prefix' => 'espacos'], function () {

    Route::get('/', ['as' => 'espacos.index', 'uses' => 'EspacosController@index']);
    Route::get('index', ['as' => 'espacos.index', 'uses' => 'EspacosController@index']);
    Route::get('{id}/edit', ['as' => 'espacos.edit', 'uses' => 'EspacosController@edit']);

    Route::get('create', ['as' => 'espacos.create', 'uses' => 'EspacosController@create']);
    Route::post('store', ['as' => 'espacos.store', 'uses' => 'EspacosController@store']);

    Route::get('{id}/destroy', ['as' => 'espacos.destroy', 'uses' => 'EspacosController@destroy']);
    Route::get('{id}/show', ['as' => 'espacos.show', 'uses' => 'EspacosController@show']);
    Route::post('{id}/update', ['as' => 'espacos.update', 'uses' => 'EspacosController@update']);

    Route::get('lista-espacos','EspacosController@listEspacoGroupByLocalDisponivelAjax');

});

// rotas para tipos de espaço
Route::group(['prefix' => 'tiposEspaco'], function () {

    Route::get('/', ['as' => 'tiposEspaco.index', 'uses' => 'TiposEspacoController@index']);
    Route::get('index', ['as' => 'tiposEspaco.index', 'uses' => 'TiposEspacoController@index']);
    Route::get('{id}/edit', ['as' => 'tiposEspaco.edit', 'uses' => 'TiposEspacoController@edit']);

    Route::get('create', ['as' => 'tiposEspaco.create', 'uses' => 'TiposEspacoController@create']);
    Route::post('store', ['as' => 'tiposEspaco.store', 'uses' => 'TiposEspacoController@store']);

    Route::get('{id}/destroy', ['as' => 'tiposEspaco.destroy', 'uses' => 'TiposEspacoController@destroy']);
    Route::get('{id}/show', ['as' => 'tiposEspaco.show', 'uses' => 'TiposEspacoController@show']);
    Route::post('{id}/update', ['as' => 'tiposEspaco.update', 'uses' => 'TiposEspacoController@update']);
});

// rotas para Niveis
Route::group(['prefix' => 'niveis'], function () {

    Route::get('/', ['as' => 'niveis.index', 'uses' => 'NiveisController@index']);
    Route::get('index', ['as' => 'niveis.index', 'uses' => 'NiveisController@index']);
    Route::get('{id}/edit', ['as' => 'niveis.edit', 'uses' => 'NiveisController@edit']);

    Route::get('create', ['as' => 'niveis.create', 'uses' => 'NiveisController@create']);
    Route::post('store', ['as' => 'niveis.store', 'uses' => 'NiveisController@store']);

    Route::get('{id}/destroy', ['as' => 'niveis.destroy', 'uses' => 'NiveisController@destroy']);
    Route::get('{id}/show', ['as' => 'niveis.show', 'uses' => 'NiveisController@show']);
    Route::post('{id}/update', ['as' => 'niveis.update', 'uses' => 'NiveisController@update']);

    Route::get('{id}/destroyModal', ['as' => 'deletarNivelDoEventoModal', 'uses' => 'NiveisController@destroyModal']);
    Route::post('storeModalNivel', ['as' => 'storeModalNivel', 'uses' => 'NiveisController@storeModal']);

});

// rotas para períodos
Route::group(['prefix' => 'periodos'], function () {

    Route::get('{id}/destroy', ['as' => 'periodos.destroy', 'uses' => 'PeriodosController@destroy']);
   // Route::get('{id}/create', ['as' => 'periodos.create', 'uses' => 'PeriodosController@createPar']);
    Route::post('store', ['as' => 'periodos.store', 'uses' => 'PeriodosController@store']);

    Route::get('{id}/edit', ['as' => 'periodos.edit', 'uses' => 'PeriodosController@edit']);
    Route::post('{id}/update', ['as' => 'periodos.update', 'uses' => 'PeriodosController@update']);
    Route::post('{id}/updateModal', ['as' => 'atualizaPeriodosModal', 'uses' => 'PeriodosController@updateModal']);
    Route::post('{id}/updateModalNivel', ['as' => 'atualizaNivelModal', 'uses' => 'PeriodosController@updateModalNivel']);
});

// rotas para usuarios
Route::group(['prefix' => 'usuarios'], function () {

    Route::get('/', ['as' => 'usuarios.index', 'uses' => 'UsuariosController@index']);
    Route::get('index', ['as' => 'usuarios.index', 'uses' => 'UsuariosController@index']);
    Route::get('{id}/edit', ['as' => 'usuarios.edit', 'uses' => 'UsuariosController@edit']);

    Route::get('create', ['as' => 'usuarios.create', 'uses' => 'UsuariosController@create']);
    Route::post('store', ['as' => 'usuarios.store', 'uses' => 'UsuariosController@store']);

    Route::get('{id}/destroy', ['as' => 'usuarios.destroy', 'uses' => 'UsuariosController@destroy']);
    Route::get('{id}/show', ['as' => 'usuarios.show', 'uses' => 'UsuariosController@show']);
    Route::post('{id}/update', ['as' => 'usuarios.update', 'uses' => 'UsuariosController@update']);

//    Route::post('{id}/updateModal', ['as' => 'atualizaRecursosModal', 'uses' => 'RecursosController@updateModal']);
//    Route::get('{id}/destroyModal', ['as' => 'deletarRecursosDoEventoModal', 'uses' => 'RecursosController@destroyModal']);
//    Route::post('{id}/storeModal', ['as' => 'storeModal', 'uses' => 'RecursosController@storeModal']);


});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


// rotas para perfil
Route::group(['prefix' => 'perfil'], function () {

    Route::get('{id}/show', ['as' => 'perfil.show', 'uses' => 'PerfilController@show']);
    Route::get('{id}/edit', ['as' => 'perfil.edit', 'uses' => 'PerfilController@edit']);
    Route::post('{id}/update', ['as' => 'perfil.update', 'uses' => 'PerfilController@update']);
    Route::post('{id}/updateImagem', ['as' => 'perfil.updateImagem', 'uses' => 'PerfilController@updateImagem']);

});

// rotas para unidades
Route::group(['prefix' => 'unidades'], function () {

    Route::get('/', ['as' => 'unidades.index', 'uses' => 'UnidadesController@index']);
    Route::get('index', ['as' => 'unidades.index', 'uses' => 'UnidadesController@index']);
    Route::get('{id}/edit', ['as' => 'unidades.edit', 'uses' => 'UnidadesController@edit']);

    Route::get('create', ['as' => 'unidades.create', 'uses' => 'UnidadesController@create']);
    Route::post('store', ['as' => 'unidades.store', 'uses' => 'UnidadesController@store']);

    Route::get('{id}/destroy', ['as' => 'unidades.destroy', 'uses' => 'UnidadesController@destroy']);
    Route::get('{id}/show', ['as' => 'unidades.show', 'uses' => 'UnidadesController@show']);
    Route::post('{id}/update', ['as' => 'unidades.update', 'uses' => 'UnidadesController@update']);
});

Route::group(['prefix' => 'orcamento'], function () {
    Route::get('/', ['as' => 'lista-orcamento', 'uses' => 'OrcamentoController@index']);
    Route::get('index', ['as' => 'orcamento.index', 'uses' => 'OrcamentoController@index']);
    Route::get('create', ['as' => 'orcamento-create', 'uses' => 'OrcamentoController@create']);
    Route::post('store', ['as' => 'store', 'uses' => 'OrcamentoController@store']);
    Route::get('{id}/destroy', ['as' => 'orcamento.destroy', 'uses' => 'OrcamentoController@destroy']);
});

// rotas para tipos de evento
Route::group(['prefix' => 'tiposEvento'], function () {

    Route::get('/', ['as' => 'tiposEvento.index', 'uses' => 'TiposEventoController@index']);
    Route::get('index', ['as' => 'tiposEvento.index', 'uses' => 'TiposEventoController@index']);
    Route::get('{id}/edit', ['as' => 'tiposEvento.edit', 'uses' => 'TiposEventoController@edit']);

    Route::get('create', ['as' => 'tiposEvento.create', 'uses' => 'TiposEventoController@create']);
    Route::post('store', ['as' => 'tiposEvento.store', 'uses' => 'TiposEventoController@store']);

    Route::get('{id}/destroy', ['as' => 'tiposEvento.destroy', 'uses' => 'TiposEventoController@destroy']);
    Route::get('{id}/show', ['as' => 'tiposEvento.show', 'uses' => 'TiposEventoController@show']);
    Route::post('{id}/update', ['as' => 'tiposEvento.update', 'uses' => 'TiposEventoController@update']);
});

// Rotas de autenticação ...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as' => 'auth/login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth/logout', 'uses' => 'Auth\AuthController@getLogout']);

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);

Route::get('password/email', ['as' => 'password/email', 'uses' => 'Auth\PasswordController@getEmail']);
Route::post('password/email', ['as' => 'password/email', 'uses' => 'Auth\PasswordController@postEmail']);

Route::get('password/reset/{token}', ['as' => 'password/reset', 'uses' => 'Auth\PasswordController@getReset']);
Route::post('password/reset', ['as' => 'password/reset', 'uses' => 'Auth\PasswordController@postReset']);

// rotas segurança

Route::group(['prefix' => 'permissions'], function () {

    Route::get('/', ['as' => 'permission.index', 'uses' => 'PermissionController@index']);
    Route::get('index', ['as' => 'permission.index', 'uses' => 'PermissionController@index']);
    Route::get('index', ['as' => 'permissions.index', 'uses' => 'PermissionController@index']);
    Route::get('{id}/edit', ['as' => 'permission.edit', 'uses' => 'PermissionController@edit']);

    Route::post('store', ['as' => 'permission.store', 'uses' => 'PermissionController@store']);
    Route::get('{id}/destroy', ['as' => 'permission.destroy', 'uses' => 'PermissionController@destroy']);
    Route::post('{id}/update', ['as' => 'atualizaPermissionModal', 'uses' => 'PermissionController@update']);
});

// ------------------------------------------------------------------------------------------------------------------


Route::group(['prefix' => 'roles'], function () {

    Route::get('/', ['as' => 'role.index', 'uses' => 'RoleController@index']);
    Route::get('index', ['as' => 'role.index', 'uses' => 'RoleController@index']);
    Route::get('index', ['as' => 'roles.index', 'uses' => 'RoleController@index']);

    Route::get('{id}/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit']);
    Route::post('store', ['as' => 'role.store', 'uses' => 'RoleController@store']);
    Route::get('{id}/destroy', ['as' => 'role.destroy', 'uses' => 'RoleController@destroy']);
    Route::post('{id}/update', ['as' => 'atualizaRoleModal', 'uses' => 'RoleController@update']);
});