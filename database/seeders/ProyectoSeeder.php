<?php

namespace Database\Seeders;

use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Proyecto;
use Illuminate\Database\Seeder;

class ProyectoSeeder extends Seeder
{
    public function run(): void
    {
        // Creamos los proyectos base. La factory solo rellena la tabla proyectos.
        if (Proyecto::query()->doesntExist()) {
            Proyecto::factory()->count(10)->create();
        }

        // La pivot estudiante_proyecto es N:M con atributo y sin modelo propio.
        // Por eso asociamos el proyecto al estudiante y mandamos tambien el campo extra.
        foreach (Estudiante::all() as $estudiante) {
            $proyectos = Proyecto::query()->inRandomOrder()->take(2)->get();

            foreach ($proyectos as $proyecto) {
                $estudiante->proyectos()->syncWithoutDetaching([
                    $proyecto->id => [
                        'descripcion_proyecto_estudiante' => fake()->sentence(),
                    ],
                ]);
            }
        }

        // La pivot docente_proyecto es N:M con atributo y con modelo propio.
        // Aunque tenga modelo pivot, la forma mas simple de sembrarla sigue siendo la relacion belongsToMany.
        foreach (Docente::all() as $docente) {
            $proyectos = Proyecto::query()->inRandomOrder()->take(2)->get();

            foreach ($proyectos as $proyecto) {
                $docente->proyectos()->syncWithoutDetaching([
                    $proyecto->id => [
                        'descripcion_proyecto_docente' => fake()->sentence(),
                    ],
                ]);
            }
        }
    }
}
