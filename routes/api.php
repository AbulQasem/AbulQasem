<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PadreController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProfesorController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resources([
    'matricula' => MatriculaController::class,
]);

Route::resources([
    'padres' => PadreController::class,
    'middleware' => 'auth'
]);

Route::resources([
    'alumnos' => AlumnoController::class
]);

Route::resources([
    'grupos' => GrupoController::class
]);

Route::resources([
    'pagos' => PagoController::class
]);

Route::resources([
    'profesores' => ProfesorController::class
]);