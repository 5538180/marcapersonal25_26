<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudiantes = Estudiante::all();
        return view('estudiantes.index', compact('estudiantes'));



/*
         $user = auth()->user();
         $estudiante = auth()->user()->estudiante();
       $respuesta = $this->authorize('update',[$user,$estudiante]);

       return $respuesta; */


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('estudiantes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:estudiantes,email',
            'telefono' => 'nullable|string|max:20',
            'ciclo_formativo_id' => 'required|exists:ciclo_formativos,id',
        ]);

        $estudiante = Estudiante::create($datos);

        return redirect()
            ->route('estudiantes.show', $estudiante)
            ->with('status', 'Estudiante creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
          $estudiante = auth()->user()->estudiante;
        return view('estudiantes.show', compact('estudiante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudiante $estudiante)
    {
        /*  $estudiante = auth()->user()->estudiante; */
        return view('estudiantes.edit', compact('estudiante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:estudiantes,email,'.$estudiante->id,
            'telefono' => 'nullable|string|max:20',
            'ciclo_formativo_id' => 'required|exists:ciclo_formativos,id',
        ]);

        $estudiante->update($datos);

        return redirect()
            ->route('estudiantes.show', $estudiante)
            ->with('status', 'Estudiante actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        try {
            $estudiante->delete();
        } catch (\Exception $e) {
            return redirect()
                ->route('estudiantes.index')
                ->with('error', 'No se puede eliminar el estudiante porque tiene proyectos asociados.');
        }
        $estudiante->delete();
        return redirect()
            ->route('estudiantes.index')
            ->with('status', 'Estudiante eliminado correctamente.');
    }
}
