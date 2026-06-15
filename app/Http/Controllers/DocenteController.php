<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docentes = Docente::all();

        return view('docentes.index', compact('docentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('docentes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'user_id' => 'nullable|exists:users,id|unique:docentes,user_id',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:docentes,email',
            'slug' => 'required|string|max:255|unique:docentes,slug',
        ]);

        $docente = Docente::create($datos);

        return redirect()
            ->route('docentes.show', $docente)
            ->with('status', 'Docente creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Docente $docente)
    {
        return view('docentes.show', compact('docente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Docente $docente)
    {
        return view('docentes.edit', compact('docente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Docente $docente)
    {
        $datos = $request->validate([
            'user_id' => 'nullable|exists:users,id|unique:docentes,user_id,' . $docente->id,
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:docentes,email,' . $docente->id,
            'slug' => 'required|string|max:255|unique:docentes,slug,' . $docente->id,
        ]);

        $docente->update($datos);

        return redirect()
            ->route('docentes.show', $docente)
            ->with('status', 'Docente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Docente $docente)
    {
        try {
            $docente->delete();
        } catch (\Exception $e) {
            return redirect()
                ->route('docentes.index')
                ->with('error', 'No se puede eliminar el docente porque tiene datos asociados.');
        }

        return redirect()
            ->route('docentes.index')
            ->with('status', 'Docente eliminado correctamente.');
    }
}
