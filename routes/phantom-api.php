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

Route::post('users', "UserController@store")->name('users.store');
Route::get('users/{field}/{identifier}', "UserController@show")->name('users.show');
Route::put('users/{field}/{identifier}', "UserController@update")->name('users.update');