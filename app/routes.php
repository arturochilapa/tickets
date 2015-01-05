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

Route::get('/', function (){
    return Redirect::to('login');
});

Route::get('/pass', function (){
    echo Hash::make('faytickets');
});

Route::resource('login', 'UsuariosController@home');
Route::resource('valid', 'UsuariosController@valid');

Route::group(array('before' => 'auth'), function()
{
	Route::resource('/sistema', 'TicketsController');
	Route::get('/sistema/tienda/ver/{id}', 'TicketsController@tienda');
	#Route::resource('/{id}/edit', 'TicketsController@edit');
	Route::resource('sistema/winners', 'TicketsController@winners');
	Route::post('sistema/search', 'TicketsController@searchTicket');
	Route::get('/export/{id}', 'TicketsController@excel');
});
