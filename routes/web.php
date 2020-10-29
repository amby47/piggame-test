<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/game/create', 'App\Http\Controllers\GameController@create')->name('create-game');
Route::get('/game/play', 'App\Http\Controllers\GameController@play');
Route::post('/game/end', 'App\Http\Controllers\GameController@store');
