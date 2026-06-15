<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public $modelclass = Proyecto::class;

    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', $this->modelclass);

        $proyectos = Proyecto::all();

        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', $this->modelclass);

        return view('proyectos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', $this->modelclass);

        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'url' => 'nullable|url|max:255',
            'imagen' => 'nullable|string|max:255',
            'dificultad' => 'required|in:baja,media,alta',
            'slug' => 'required|string|max:255|unique:proyectos,slug',
        ]/* ,400 */);

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
        $this->authorize('view', $proyecto);

        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        $this->authorize('update', $proyecto);

        return view('proyectos.edit', compact('proyecto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $this->authorize('update', $proyecto);

        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'url' => 'nullable|url|max:255',
            'imagen' => 'nullable|string|max:255',
            'dificultad' => 'required|in:baja,media,alta',
            'slug' => 'required|string|max:255|unique:proyectos,slug,' . $proyecto->id,
        ]);

        $proyecto->update($datos);

        return redirect()
            ->route('proyectos.show', $proyecto)
            ->with('status', 'Proyecto actualizado correctamente.');
    }
    public function patch(Request $request, Proyecto $proyecto)
    {
        $this->authorize('update', $proyecto);

        $datos = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string',
            'url' => 'sometimes|nullable|url|max:255',
            'imagen' => 'sometimes|nullable|string|max:255',
            'dificultad' => 'sometimes|required|in:baja,media,alta',
            'slug' => 'sometimes|required|string|max:255|unique:proyectos,slug,' . $proyecto->id,
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
        $this->authorize('delete', $proyecto);

        $proyecto->delete();

        return redirect()
            ->route('proyectos.index')
            ->with('status', 'Proyecto eliminado correctamente.');
    }
}
