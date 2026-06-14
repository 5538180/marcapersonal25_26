<?php



use App\Http\Controllers\CicloFormativoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('proyectos', ProyectoController::class);


});

// Protegidas
Route::middleware('auth')->group(function () {
    Route::resource('estudiantes', EstudianteController::class)
        ->except(['index', 'show']);
});

// Públicas
Route::resource('estudiantes', EstudianteController::class)
    ->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::resource('ciclos', CicloFormativoController::class)
        ->except(['index', 'show']);
});

Route::resource('ciclos', CicloFormativoController::class)
    ->only(['index', 'show']);
require __DIR__ . '/auth.php';
