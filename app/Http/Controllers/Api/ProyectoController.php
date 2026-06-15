<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProyectoResource;
use App\Models\Proyecto;
use App\Policies\ProyectoPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProyectoController extends Controller
{
    public $modelclass = Proyecto::class;

    public function __construct(private readonly ProyectoPolicy $policy)
    {
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->modelclass);
        $proyectos = $this->policy->proyectosAsignados($request->user());

        if ($proyectos->isEmpty()) {
            return response()->json([
                'message' => 'No hay proyectos asignados para este usuario.',
            ], Response::HTTP_NOT_FOUND);
        }

        return ProyectoResource::collection($proyectos);
    }

    public function show(Proyecto $proyecto)
    {
        $user = auth()->user();
        Gate::allow('gestionar-proyectos',$user);

        
        $this->authorize('view', $proyecto);

        return new ProyectoResource($proyecto);
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $this->authorize('update', $proyecto);

        $proyectoData = json_decode($request->getContent(), true) ?? $request->all();
        $proyecto->update($proyectoData);

        return new ProyectoResource($proyecto);
    }

    public function destroy(Proyecto $proyecto)
    {
        $this->authorize('delete', $proyecto);

        try {
            $proyecto->delete();

            return response()->json([
                'message' => 'Proyecto eliminado correctamente.',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
