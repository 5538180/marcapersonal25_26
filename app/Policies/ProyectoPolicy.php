<?php

namespace App\Policies;

use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Support\Collection;

class ProyectoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Proyecto $proyecto): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Proyecto $proyecto): bool
    {
        if ($user->name === env('ADMIN_USER')) {
            return true;
        }

        return $this->tieneProyectoAsignado($user, $proyecto);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Proyecto $proyecto): bool
    {
        if ($user->name === env('ADMIN_USER')) {
            return true;
        }

        if (!$user->docente) {
            return false;
        }

        return $this->tieneProyectoAsignado($user, $proyecto);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Proyecto $proyecto): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Proyecto $proyecto): bool
    {
        return false;
    }

    public function proyectosAsignados(User $user): Collection
    {
        if ($user->name === env('ADMIN_USER')) {
            return Proyecto::latest()->get();
        }

        $proyectos = collect();

        if ($user->docente) {
            $proyectos = $proyectos->merge($user->docente->proyectos);
        }

        if ($user->estudiante) {
            $proyectos = $proyectos->merge($user->estudiante->proyectos);
        }

        return $proyectos->unique('id')->values();
    }

    public function tieneProyectoAsignado(User $user, Proyecto $proyecto): bool
    {
        if ($user->docente && $user->docente->proyectos()->whereKey($proyecto->id)->exists()) {
            return true;
        }

        if ($user->estudiante && $user->estudiante->proyectos()->whereKey($proyecto->id)->exists()) {
            return true;
        }

        return false;
    }
}
