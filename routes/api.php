<?php

use App\Http\Controllers\Api\EstudianteController;
use App\Http\Controllers\Api\CicloFamiliaController;
use App\Http\Controllers\Api\CicloFormativoController;
use App\Http\Controllers\Api\FamiliaProfesionalController;
use App\Http\Controllers\Api\ProyectoController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum', 'proyecto.asignado'])
    ->apiResource('proyectos', ProyectoController::class)
    ->only(['index', 'show', 'update', 'destroy'])
    ->missing(fn () => response()->json([
        'message' => 'Proyecto no encontrado.',
    ], 404));



Route::apiResource('estudiantes', EstudianteController::class);

Route::apiResource('familia-profesional', FamiliaProfesionalController::class);

Route::apiResource('ciclos-formativos', CicloFormativoController::class)
    ->parameters(['ciclos-formativos' => 'cicloFormativo']);

Route::apiResource('familia-profesional.ciclos-formativos', CicloFamiliaController::class)
    ->parameters([
        'familia-profesional' => 'familiaProfesional',
        'ciclos-formativos' => 'cicloFormativo',
    ]);
