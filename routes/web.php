<?php



use App\Http\Controllers\CicloFormativoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\FamiliaProfesionalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\QueryPruebaController;
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



// Docentes protegidas
Route::middleware('auth')->group(function () {
    Route::get('/docentes/create', [DocenteController::class, 'create'])->name('docentes.create');
    Route::post('/docentes', [DocenteController::class, 'store'])->name('docentes.store');
    Route::get('/docentes/{docente}/edit', [DocenteController::class, 'edit'])->name('docentes.edit');
    Route::put('/docentes/{docente}', [DocenteController::class, 'update'])->name('docentes.update');
    Route::patch('/docentes/{docente}', [DocenteController::class, 'update']);
    Route::delete('/docentes/{docente}', [DocenteController::class, 'destroy'])->name('docentes.destroy');
});

Route::resources([
    /* 'pruebasDocentes' => DocenteController::class, */
    'qppruebas' => QueryPruebaController::class,
]);

// Docentes publicas
Route::get('/docentes', [DocenteController::class, 'index'])->name('docentes.index');
Route::get('/docentes/{docente}', [DocenteController::class, 'show'])->name('docentes.show');

Route::middleware('auth')->group(function () {
    Route::resource('ciclos', CicloFormativoController::class)
        ->except(['index', 'show']);
});

Route::resource('ciclos', CicloFormativoController::class)
    ->only(['index', 'show']);
require __DIR__ . '/auth.php';
