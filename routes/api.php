<?php

use App\Http\Controllers\Api\CicloFormativoController;
use App\Http\Controllers\Api\FamiliaProfesionalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| Rutas API protegidas con Sanctum
|--------------------------------------------------------------------------
|
| Grupo preparado para los recursos del dominio. En próximos commits aquí
| irán los apiResource de familias profesionales, ciclos formativos,
| estudiantes, docentes y proyectos, por ejemplo:
|
|     Route::apiResource('familias', FamiliaController::class);
|     Route::apiResource('ciclos', CicloController::class);
|     Route::apiResource('proyectos', ProyectoController::class);
|
*/
Route::middleware('auth:sanctum')->group(function () {

Route::apiResource('familias', FamiliaProfesionalController::class);
 Route::apiResource('ciclos', CicloFormativoController::class);
});
