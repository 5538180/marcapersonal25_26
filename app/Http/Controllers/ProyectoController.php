<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::latest()->get();

        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proyectos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'url' => 'nullable|url|max:255',
            'imagen' => 'nullable|string|max:255',
            'dificultad' => 'required|in:baja,media,alta',
            'slug' => 'required|string|max:255|unique:proyectos,slug',
        ]);

        $proyecto = Proyecto::create($datos);

        return redirect()
            ->route('proyectos.show', $proyecto)
            ->with('status', 'Proyecto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        return view('proyectos.edit', compact('proyecto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'url' => 'nullable|url|max:255',
            'imagen' => 'nullable|string|max:255',
            'dificultad' => 'required|in:baja,media,alta',
            'slug' => 'required|string|max:255|unique:proyectos,slug,'.$proyecto->id,
        ]);

        $proyecto->update($datos);

        return redirect()
            ->route('proyectos.show', $proyecto)
            ->with('status', 'Proyecto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();

        return redirect()
            ->route('proyectos.index')
            ->with('status', 'Proyecto eliminado correctamente.');
    }
}
