<?php

use App\Http\Controllers\CorredorController;
use App\Http\Controllers\CorredorProvaCrontroller;
use App\Http\Controllers\ProvaController;
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

Route::get('/corredores',[CorredorController::class, 'index']);
Route::post('/corredores',[CorredorController::class, 'store']);
Route::get('/provas',[ProvaController::class, 'index']);
Route::post('/provas',[ProvaController::class, 'store']);
Route::post('/corredores-prova',[CorredorProvaCrontroller::class, 'store']);
Route::put('/corredores-prova',[CorredorProvaCrontroller::class, 'update']);
Route::get('/resultados',[CorredorProvaCrontroller::class, 'index']);
Route::get('/resultados-idade',[CorredorProvaCrontroller::class, 'resultadoPorIdade']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
