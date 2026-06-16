<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EstudianteResource;
use App\Models\Ciclo;
use App\Models\CicloFormativo;
use App\Models\Estudiante;
use App\Models\FamiliaProfesional;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

      /*   $codigo = 'ADG';
 */







            return EstudianteResource::collection(
                Estudiante::orderBy($request->sort ?? 'id', $request->order ?? 'asc')
                    ->paginate($request->per_page)
            );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $estudiante = $request->validate([
            'nombre' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'apellidos' => 'required|string',
            'dni' => 'required|url|max:255',
            'email' => 'required|string|max:255',
            'telefono' => 'required|in:baja,media,alta',
            'slug' => 'required|string|max:255|unique:proyectos,slug',
        ]/* ,400 */);


        /*           $table->foreignId('user_id')->nullable()->unique()->constrained('users')->cascadeOnDelete();
                    $table->string('dni')->unique();
                    $table->string('nombre');
                    $table->string('apellidos');
                    $table->string('email')->unique();
                    $table->string('telefono')->nullable();
                    $table->string('imagen')->nullable();
                    $table->string('slug')->unique(); */

        /*  $this->authorize('gestionar-estudiantes'); */
        /*  $user = $request->user(); */

        /*         $estudianteData = [
                    'user_id' => $request->input('user_id'),
                    'dni' => $request->input('dni'),
                    'nombre' => $request->input('nombre'),
                    'apellidos' => $request->input('apellidos'),
                    'email' => $request->input('email'),
                    'telefono' => $request->input('telefono'),
                    'imagen' => $request->input('imagen'),
                    'slug' => $request->input('slug'),
                ]; */

        $estudiante = Estudiante::create($estudiante);

        return new EstudianteResource($estudiante);
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        return new EstudianteResource($estudiante);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estudiante $estudiante)
    {

        $this->authorize('gestionar-estudiantes');

        $user = $request->user();

        $estudianteData = $request->only([
            'user_id',
            'dni',
            'nombre',
            'apellidos',
            'email',
            'telefono',
            'imagen',
            'slug',
        ]);

        $estudiante->update($estudianteData);

        return new EstudianteResource($estudiante);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        $this->authorize('gestionar-estudiantes');

        try {
            $estudiante->delete();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 400);
        }
    }
}
