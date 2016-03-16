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
    Route::resource('contatti','ContattoController');
    Route::resource('clienti','ClienteController');
    Route::get('clienti/{clienti}/contatto', 'ClienteController@associa');


});
