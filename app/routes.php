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
    return Redirect::to('/sistema/');
});
Route::resource('/sistema', 'TicketsController');
Route::get('/sistema/tienda/ver/{id}', 'TicketsController@show');
#Route::resource('/{id}/edit', 'TicketsController@edit');
Route::resource('sistema/winners', 'TicketsController@winners');
Route::post('sistema/search', 'TicketsController@searchTicket');
