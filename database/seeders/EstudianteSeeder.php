<?php

namespace Database\Seeders;

use App\Models\CicloFormativo;
use App\Models\Estudiante;
use Illuminate\Database\Seeder;

class EstudianteSeeder extends Seeder
{
    public function run(): void
    {
        // Creamos los estudiantes base. La factory solo rellena la tabla estudiantes.
        if (Estudiante::query()->doesntExist()) {
            Estudiante::factory()->count(12)->create();
        }

        // La pivot ciclo_formativo_estudiante es N:M sin atributos.
        // Por eso en el seeder solo asociamos IDs y no pasamos datos extra.
        foreach (Estudiante::all() as $estudiante) {
            $cicloId = CicloFormativo::query()->inRandomOrder()->value('id');

            if ($cicloId !== null) {
                $estudiante->ciclosFormativos()->syncWithoutDetaching([$cicloId]);
            }
        }
    }
}
