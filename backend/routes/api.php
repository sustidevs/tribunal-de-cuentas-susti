<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\Api\HistorialController;
use App\Http\Controllers\api\ExpedienteController;

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

/*
|Cuando se implemente middleware usar auth:sanctum en lugar de auth:api
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//EXPEDIENTE////////////////////////////////////////////////////////////////////////
Route::get('/indexExp',       [ExpedienteController::class, 'index']);
Route::get('/createExp',      [ExpedienteController::class, 'create']);
Route::post('/storeExp',      [ExpedienteController::class, 'store']);
Route::get('/updateExp',      [ExpedienteController::class, 'update']);
Route::post('/nroExp',        [ExpedienteController::class, 'createNroExpediente']);
Route::post('/showExp',       [ExpedienteController::class, 'show']);
Route::post('/indexExpArea',  [ExpedienteController::class, 'indexPorAreas']);
Route::post('/buscar-expediente',  [ExpedienteController::class, 'buscarExpediente']);
Route::get('/all-expedientes',  [ExpedienteController::class, 'AllExpedientes']);
////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////
Route::post('/ListadoExp',       [ExpedienteController::class, 'bandeja']);
Route::post('/contarExp',         [ExpedienteController::class, 'contadorBandejaEntrada']);
///////////////////////////////////////////////////////////////////////////////////

Route::post('/historial',                [HistorialController::class, 'create']);
Route::post('/historial-expediente',     [HistorialController::class, 'store']);
Route::post('/update-estado-cuerpo',     [HistorialController::class, 'updateEstado']);
Route::post('/historialExp',     [HistorialController::class, 'historialExpediente']);

Route::get('/indexUser', [UserController::class, 'index']);
Route::get('/createUser', [UserController::class, 'create']);
Route::post('/storeUser', [UserController::class, 'store']);
Route::get('/editUser', [UserController::class, 'edit']);
Route::post('/updateUser', [UserController::class, 'update']);
Route::get('/bajaUser', [UserController::class, 'delete']);
Route::get('/restoreUser', [UserController::class, 'restore']);

Route::get('/login',[LoginController::Class, 'showLoginForm'] );
Route::post('/login',[LoginController::Class, 'authenticate'] );