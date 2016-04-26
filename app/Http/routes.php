<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
| Route "base" definite in
| APP\vendor\acacha\admin-lte-template-laravel\src\Http\routes.php
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
// Login routes
    Route::get('/login','Auth\AuthController@showLoginForm');
    Route::post('/login','Auth\AuthController@login');
    Route::get('/logout','Auth\AuthController@logout');
// Password reset link request routes...
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');

// Password reset routes...
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/reset', 'Auth\PasswordController@reset');


    Route::get('/home', 'HomeController@index');

    Route::get('/', 'HomeController@index');

    Route::resource('user', 'UserController');

    Route::resource('consulenti','ConsulenteController');
    Route::post('ajax/toggleUser', 'UserController@ajaxToggleUser');
    Route::get('ajax/consulenti/getConsulente', 'ConsulenteController@ajaxGetConsulente');

    Route::resource('contatti','ContattoController');

    Route::resource('contratti','ContrattoController');
    Route::get('ajax/contratti/listinoInterventi', 'ContrattoController@ajaxGetListinoInterventi');

	Route::resource('contratti/{contratto_id}/listino_interventi','ContrattoInterventoController');
	Route::resource('contratti/{contratto_id}/listino_prodotti','ContrattoProdottoController');

    Route::resource('clienti','ClienteController');
    Route::get('clienti/{clienti}/contatto', 'ClienteController@associa');
    Route::get('ajax/clienti/getCliente', 'ClienteController@ajaxGetCliente');
    Route::get('ajax/clienti/getContratti', 'ClienteController@ajaxGetContratti');


    Route::resource('progetti','ProgettoController');
    Route::get('ajax/progetti/getAttivita', 'ProgettoController@ajaxGetAttivita');

    Route::post('attivita','AttivitaController@store');
    Route::patch('attivita','AttivitaController@update');
    Route::get('attivita/{id}/destroy','AttivitaController@destroy');
    Route::get('ajax/attivita/moveDown', 'AttivitaController@ajaxMoveDown');
    Route::get('ajax/attivita/moveUp', 'AttivitaController@ajaxMoveUp');
    Route::get('ajax/attivita/getDataTree', 'AttivitaController@ajaxGetDataTree');



    Route::resource('interventi', 'InterventoController');
    Route::get('interventi/{intervento_id}/stampa', 'InterventoController@stampa');
    Route::get('interventi/{intervento_id}/invia', 'InterventoController@invia');
    Route::get('ajax/interventi/getCalendar', 'InterventoController@ajaxGetCalendar');
    Route::get('ajax/interventi/getCalendar', 'InterventoController@ajaxGetCalendar');
    Route::post('ajax/interventi/createIntervento', 'InterventoController@ajaxCreateIntervento');
    Route::patch('ajax/interventi/updateIntervento', 'InterventoController@ajaxUpdateIntervento');
    Route::delete('ajax/interventi/deleteIntervento', 'InterventoController@ajaxDeleteIntervento');

    Route::resource('interventi/{intervento_id}/rimborsi','RimborsoController');



    Route::resource('prodotti','ProdottoController');
});
