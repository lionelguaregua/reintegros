<?php




Route::get('/', 'UsuariosController@showUsersForm')->name('showUsersForm');


Route::POST('/verifiying', 'UsuariosController@validateData')->name('paramToMiddleware');


Route::group(['middleware' => ['users']], function () {


Route::get('user/{voucher}/case/{case}/service/{service}/{hash}/{afiliadoId}/{voucherId}', 'LogueadosController@index')->name('validated');

Route::get('user/{voucher}/case/{case}/service/{service}/{hash}/{afiliadoId}/{voucherId}/form', 'LogueadosController@showForm')->name('formRequest');


Route::POST('user/{voucher}/case/{case}/service/{service}/{hash}/{afiliadoId}/{voucherId}/form/procesing', 'LogueadosController@formProcess')->name('formProcess');

Route::get('user/{voucher}/case/{case}/service/{service}/{hash}/{afiliadoId}/{voucherId}/success', 'LogueadosController@formSubmited')->name('formSubmited');

Route::get('user/{voucher}/case/{case}/service/{service}/{hash}/{afiliadoId}/{voucherId}/estatus', 'LogueadosController@requestEstatus')->name('requestEstatus');


Route::PUT('user/{voucher}/case/{case}/service/{service}/{hash}/{afiliadoId}/{voucherId}/logouts', 'LogueadosController@logout')->name('logout');


    });






Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');



Auth::routes();


 
Route::group(['middleware' => ['auth','isActive']], function () {


Route::get('/inicio', 'ReintegrosController@index')->name('inicio');

Route::get('/inicio/search', 'ReintegrosController@search')->name('query');

Route::get('/inicio/informaciones', 'VistasFormularioController@index')->name('info');

Route::get('/inicio/usuarios', 'UsersController@index')->name('usuarios');

Route::get('/inicio/usuarios/nuevo-usuario', 'UsersController@newUser')->name('nuevoUsuario');


Route::get('/inicio/{id}', 'ReintegrosController@show')->name('ver');

Route::get('/inicio/{id}/archivos', 'ReintegrosController@archivosPax')->name('archivospax');

Route::get('/inicio/{id}/archivosadmin', 'ReintegrosController@archivosAdm')->name('archivosAdm');


Route::get('/inicio/informaciones/{id}', 'VistasFormularioController@editarInfo')->name('editarInfo');






Route::POST('/inicio/usuarios/nuevo-usuario/create', 'Auth\RegisterController@create')->name('register');

Route::POST('/inicio/usuarios/editar', 'UsersController@edit')->name('editUser');

Route::POST('/inicio/usuarios/estatus', 'UsersController@statusChange')->name('statusChange');


Route::POST('/inicio/agendados/nuevo', 'AgendadosController@scheduleCase')->name('agendarcaso');

Route::POST('/inicio/agendados/remover-agenda', 'AgendadosController@desagendar')->name('desagendar');



Route::post('/inicio/{id}/change-estatus', 'ReintegrosController@changeStatus')->name('cambioEstatus');

Route::post('/inicio/{id}/manual-event', 'ReintegrosController@manualEvent')->name('eventoManual');

Route::POST('/inicio/{id}/infoadmin', 'ReintegrosController@infoAdm')->name('infoAdm');

Route::POST('/inicio/{id}/estado', 'ReintegrosController@changeAdmin')->name('estadoCambio');

Route::POST('/inicio/{id}/form', 'ReintegrosController@formRequest')->name('formulario');

Route::POST('/inicio/{id}/form2', 'ReintegrosController@formRequest2')->name('formulario2');

Route::POST('/inicio/{id}/fichaUpdate', 'ReintegrosController@fichaUpdate')->name('fichaUpdate');

Route::POST('/inicio/{id}/envioadm', 'ReintegrosController@correoAdm')->name('envioadm');

Route::POST('/inicio/{id}/subir', 'ReintegrosController@uploadFile')->name('subida');

Route::POST('/inicio/{id}/uploadadm', 'ReintegrosController@uploadadm')->name('upload');


Route::POST('/inicio/informaciones/{id}', 'VistasFormularioController@editarInfoCobertura')->name('editarInfoCobertura');

Route::POST('/inicio/informaciones/{id}/docs', 'VistasFormularioController@editarInfoDocumentos')->name('editarInfoDocumentos');



Route::get('logout', 'Auth\LoginController@logout');






	    });
