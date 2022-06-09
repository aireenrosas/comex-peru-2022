<?php

/*
|--------------------------------------------------------------------------
| En Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

  Route::get('/', 'FrontController@index');
  Route::post('/setlanguage', 'FrontController@setlanguage');
  Route::get('/nosotros', 'nosotrosController@index');
  Route::get('/servicios', 'serviciosController@index');
  Route::get('/servicioconsultotiaempresarial', 'servicioconsultotiaempresarialController@index');
  Route::get('/serviciopoliticaspublicas', 'serviciopoliticaspublicasController@index');
  Route::get('/servicioabtc', 'servicioabtcController@index');
  Route::get('/servicioestudioseconomicos', 'servicioestudioseconomicosController@index');
  Route::get('/servicioasuntosinternacionales', 'servicioasuntosinternacionalesController@index');
  Route::get('/servicioalasociado', 'servicioalasociadoController@index');
  Route::get('/serviciopublicaciones', 'serviciopublicacionesController@index');
  Route::get('/serviciocomunicacion', 'serviciocomunicacionController@index');
  Route::get('/eventos', 'eventosController@index');
  Route::get('/articulos', 'articulosController@index');
  Route::get('/articulos/{titulo}', 'articulosController@show');
  Route::get('/socios', 'sociosController@index');
