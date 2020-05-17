<?php

use Illuminate\Http\Request;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {  return $request->user(); });

Route::post('registrarPersona','ApiPersonaController@store');
Route::post('loginPersona','ApiPersonaController@login');

route::post('loginPerfilEstudiante','ApiEstudianteController@loginPerfilEstudiante');
route::get('personas','ApiPersonaController@index');  //para hacer pruebas

//route::post('loginPerfilAuxiliar','');
//route::post('registrarAuxiliar','');

Route::apiResource('categorias','ApiCategoriaController');
Route::apiResource('areas','ApiAreaController');
Route::apiResource('materias','ApiMateriaController');

Route::apiResource('configuraciones','ApiConfiguracionController');

//route::post('auxiliaresMateria','');