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

#Finalizados
Route::get('getallusers','App\Http\Controllers\userController@getallUsers'); #ok
Route::get('transferencias', 'App\Http\Controllers\transferenciasController@index'); #ok
Route::get('contasporemail' ,'App\Http\Controllers\contaagenciaController@getAllContasEmail' ); #ok
Route::get('getinfoaccount','App\Http\Controllers\contaagenciaController@getinfoaccount'); #ok
Route::get('historicoporconta','App\Http\Controllers\transferenciasController@historicotransferencia'); #ok

#falta tratamento
Route::post('register', 'App\Http\Controllers\userController@register'); #ok Fazer Retorno de erro de rules
Route::post('fazertransferencia', 'App\Http\Controllers\transferenciasController@fazertransferencia'); #ok Fazer Retorno de erro de rules
Route::post('criarcontaagencia','App\Http\Controllers\contaagenciaController@registrarConta'); #ok rules

Route::post('criarcadastroTableInfo','App\Http\Controllers\tableinfoController@registrarUsuarioTableInfo');

Route::middleware('auth:api')->get('/user' , function(Request $request){
    return $request->user();
}






