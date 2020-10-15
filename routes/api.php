<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'CurrencyController@index');
Route::get('/admin', 'UserController@getAdmin');

Route::group(['middleware' => ['auth:api', 'return-json']], function () {
    Route::get('/currencies', 'CurrencyController@list');
    Route::get('/currency/{code}', 'CurrencyController@show');
});
