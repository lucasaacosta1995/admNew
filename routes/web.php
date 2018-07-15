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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/calendario-reuniones-sala', function () {
    return view('calendarios.sala_reuniones');
});

Auth::routes();

Route::resource('gastos', 'GastoController');

Route::get('/gastosC/getAll', 'GastoController@getAll');
Route::get('/gastosC/importesTotalesPisos', 'GastoController@getCountPorPiso');
