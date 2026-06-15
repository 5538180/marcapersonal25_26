<?php

namespace App\Http\Middleware;

use App\Models\Proyecto;
use App\Policies\ProyectoPolicy;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProyectoAsignado
{
    public function __construct(private readonly ProyectoPolicy $policy)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'No estas autenticado.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($user->name === env('ADMIN_USER')) {
            return $next($request);
        }

        $proyecto = $request->route('proyecto');

        if (!$proyecto instanceof Proyecto) {
            return $next($request);
        }

        if ($this->policy->tieneProyectoAsignado($user, $proyecto)) {
            return $next($request);
        }

        return response()->json([
            'message' => 'No tienes asignado este proyecto.',
        ], Response::HTTP_FORBIDDEN);
    }
}
