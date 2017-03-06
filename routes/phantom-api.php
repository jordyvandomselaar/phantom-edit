<?php
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

Route::get('users', "AuthController@index")->name('users.index');
Route::post('user', 'AuthController@post')->name('user.post');
Route::put('user/{field}/{identifier}', "AuthController@put")->name('user.put');
Route::get('user/{field}/{identifier}', "AuthController@get")->name('user.get');
