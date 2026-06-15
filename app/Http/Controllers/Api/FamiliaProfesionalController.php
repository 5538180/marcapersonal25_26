<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FamiliaProfesionalResource;
use App\Models\FamiliaProfesional;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FamiliaProfesionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $familias = FamiliaProfesional::query()
            ->withCount('ciclosFormativos');

        if ($request->input('nombre')) {
            $familias->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        if ($request->input('codigo')) {
            $familias->where('codigo', $request->input('codigo'));
        }

        if ($request->input('slug')) {
            $familias->where('slug', $request->input('slug'));
        }

        if ($request->input('min_ciclos')) {
            $familias->having('ciclos_formativos_count', '>=', (int) $request->input('min_ciclos'));
        }

        return FamiliaProfesionalResource::collection($familias->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => ['required', 'string', 'max:255', 'unique:familias_profesionales,codigo'],
            'nombre' => ['required', 'string', 'max:255', 'unique:familias_profesionales,nombre'],
            'slug' => ['required', 'string', 'max:255', 'unique:familias_profesionales,slug'],
        ]);

        $familiaProfesional = FamiliaProfesional::create($datos);

        return (new FamiliaProfesionalResource($familiaProfesional))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(FamiliaProfesional $familiaProfesional)
    {
        $familiaProfesional->loadCount('ciclosFormativos');

        return new FamiliaProfesionalResource($familiaProfesional);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamiliaProfesional $familiaProfesional)
    {
        $datos = $request->validate([
            'codigo' => ['sometimes', 'required', 'string', 'max:255', 'unique:familias_profesionales,codigo,' . $familiaProfesional->id],
            'nombre' => ['sometimes', 'required', 'string', 'max:255', 'unique:familias_profesionales,nombre,' . $familiaProfesional->id],
            'slug' => ['sometimes', 'required', 'string', 'max:255', 'unique:familias_profesionales,slug,' . $familiaProfesional->id],
        ]);

        $familiaProfesional->update($datos);
        $familiaProfesional->loadCount('ciclosFormativos');

        return new FamiliaProfesionalResource($familiaProfesional);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamiliaProfesional $familiaProfesional)
    {
        try {
            $familiaProfesional->delete();

            return response()->json([
                'message' => 'Familia profesional eliminada correctamente.',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'No se puede eliminar la familia profesional.',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
