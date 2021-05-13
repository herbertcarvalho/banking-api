<?php

use Illuminate\Http\Request;
#use Illuminate\Support\Facades\Route;

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

Route::post('register', 'App\Http\Controllers\userController@register');


Route::get('transferencias', 'App\Http\Controllers\transferenciasController@index');

Route::get('transferenciasToken' ,'App\Http\Controllers\transferenciasController@getbyuser');

Route::post('fazertransferencia', 'App\Http\Controllers\transferenciasController@fazertransferencia');


Route::middleware('password_grant.credentials')->post('login', 'App\Http\Controllers\Auth\LoginApiController@login');

Route::middleware('auth:api')->group(function () {


});
