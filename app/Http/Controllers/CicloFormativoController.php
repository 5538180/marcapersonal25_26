<?php

namespace App\Http\Controllers;

use App\Models\CicloFormativo;
use App\Models\FamiliaProfesional;
use Illuminate\Http\Request;

class CicloFormativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ciclos = CicloFormativo::with(['familiaProfesional', 'estudiantes'])
            ->where('grado', 'superior')
            ->latest()
            ->get();

        return view('ciclos.index', compact('ciclos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $familias = FamiliaProfesional::all();

        return view('ciclos.create', compact('familias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'familia_profesional_id' => 'required|exists:familias_profesionales,id',
            'codigo' => 'required|string|max:255|unique:ciclos_formativos,codigo',
            'nombre' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:ciclos_formativos,slug',
        ]);

        $datos['grado'] = 'superior';

        $ciclo = CicloFormativo::create($datos);

        return redirect()
            ->route('ciclos.show', $ciclo)
            ->with('status', 'Ciclo formativo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CicloFormativo $ciclo)
    {
        abort_unless($ciclo->grado === 'superior', 404);

        $ciclo->load(['familiaProfesional', 'estudiantes']);

        return view('ciclos.show', compact('ciclo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CicloFormativo $ciclo)
    {
        abort_unless($ciclo->grado === 'superior', 404);

        $familias = FamiliaProfesional::all();

        return view('ciclos.edit', compact('ciclo', 'familias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CicloFormativo $ciclo)
    {
        abort_unless($ciclo->grado === 'superior', 404);

        $datos = $request->validate([
            'familia_profesional_id' => 'required|exists:familias_profesionales,id',
            'codigo' => 'required|string|max:255|unique:ciclos_formativos,codigo,'.$ciclo->id,
            'nombre' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:ciclos_formativos,slug,'.$ciclo->id,
        ]);

        $datos['grado'] = 'superior';

        $ciclo->update($datos);

        return redirect()
            ->route('ciclos.show', $ciclo)
            ->with('status', 'Ciclo formativo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CicloFormativo $ciclo)
    {
        abort_unless($ciclo->grado === 'superior', 404);

        $ciclo->delete();

        return redirect()
            ->route('ciclos.index')
            ->with('status', 'Ciclo formativo eliminado correctamente.');
    }
}
