<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EstudianteResource;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
        $this->authorize('gestionar-estudiantes');

        $user = $request->user();

        $estudianteData = [
            'user_id' => $request->input('user_id'),
            'dni' => $request->input('dni'),
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'imagen' => $request->input('imagen'),
            'slug' => $request->input('slug'),
        ];

        $estudiante = Estudiante::create($estudianteData);

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
