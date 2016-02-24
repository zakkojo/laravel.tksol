<?php 

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


Route::resource('cliente', 'ClienteController');
Route::resource('contatto', 'ContattoController');
Route::resource('consulente', 'ConsulenteController');
Route::resource('prodotto', 'ProdottoController');
Route::resource('progetto', 'ProgettoController');
Route::resource('attivita', 'AttivitaController');
Route::resource('progettocliente', 'ProgettoClienteController');
Route::resource('intervento', 'InterventoController');
Route::resource('consulenteintervento', 'ConsulenteInterventoController');
Route::resource('tipointervento', 'TipoInterventoController');
Route::resource('rimborsointervento', 'RimborsoInterventoController');
Route::resource('codicecliente', 'CodiceClienteController');
Route::resource('listinoprogetto', 'ListinoProgettoController');
Route::resource('user', 'UserController');
