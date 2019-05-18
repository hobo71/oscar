<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('data','Api\DataController@index');

Route::get('alquileres/stats','Api\AlquilerController@stats');
Route::get('alquileres/data','Api\AlquilerController@data');
Route::resource('alquileres','Api\AlquilerController');
Route::get('search/{query}','Api\SearchController@search');

Route::get('vehiculos/{vehiculo_id}/services','Api\VehiculoController@services');
Route::get('vehiculos/alquilados','Api\VehiculoController@alquilados');
Route::resource('vehiculos','Api\VehiculoController');
Route::post('clientes/merge','Api\ClienteController@merge');
Route::get('clientes/min','Api\ClienteController@min');
Route::resource('clientes','Api\ClienteController');
Route::resource('empresas','Api\EmpresaController');
Route::resource('services','Api\ServiceController');
Route::resource('options','Api\OptionController');
Route::resource('marcas','Api\MarcaController');