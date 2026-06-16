<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CicloFormativoResource;
use App\Models\CicloFormativo;
use App\Models\FamiliaProfesional;
use App\Services\CiclosPorFamiliaService;
use Illuminate\Http\Request;

class CicloFamiliaController extends Controller
{
    protected $ciclosPorFamiliaService;

    public function __construct(CiclosPorFamiliaService $ciclosPorFamiliaService)
    {
        $this->ciclosPorFamiliaService = $ciclosPorFamiliaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, FamiliaProfesional $familiaProfesional)
    {
        $familiaProfesional->total_ciclos = $this->ciclosPorFamiliaService->contarCiclos($familiaProfesional);

        
        return CicloFormativoResource::collection(
            $familiaProfesional->ciclosFormativos()
                ->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
                ->paginate($request->per_page)
        )->additional([
            'familia_profesional' => $familiaProfesional,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FamiliaProfesional $familiaProfesional)
    {
        $user = $request->user();

        $cicloFormativoData = [
            'codigo' => $request->input('codigo'),
            'nombre' => $request->input('nombre'),
            'grado' => $request->input('grado'),
            'slug' => $request->input('slug'),
        ];

        $cicloFormativo = $familiaProfesional->ciclosFormativos()->create($cicloFormativoData);

        return new CicloFormativoResource($cicloFormativo);
    }

    /**
     * Display the specified resource.
     */
    public function show(FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        if (!$this->perteneceAFamilia($familiaProfesional, $cicloFormativo)) {
            return response()->json([
                'message' => 'El ciclo formativo no pertenece a esta familia profesional.',
            ], 404);
        }

        return new CicloFormativoResource($cicloFormativo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        $user = $request->user();

        if (!$this->perteneceAFamilia($familiaProfesional, $cicloFormativo)) {
            return response()->json([
                'message' => 'El ciclo formativo no pertenece a esta familia profesional.',
            ], 404);
        }

        $cicloFormativoData = $request->only([
            'codigo',
            'nombre',
            'grado',
            'slug',
        ]);

        $cicloFormativo->update($cicloFormativoData);

        return new CicloFormativoResource($cicloFormativo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        if (!$this->perteneceAFamilia($familiaProfesional, $cicloFormativo)) {
            return response()->json([
                'message' => 'El ciclo formativo no pertenece a esta familia profesional.',
            ], 404);
        }

        try {
            $cicloFormativo->delete();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 400);
        }
    }

    private function perteneceAFamilia(FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo): bool
    {
        return $familiaProfesional->ciclosFormativos()
            ->whereKey($cicloFormativo->id)
            ->exists();
    }
}
