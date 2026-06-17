<?php

namespace Database\Seeders;

use App\Models\CicloFormativo;
use App\Models\Estudiante;
use Illuminate\Database\Seeder;

class QueryPruebaSeeder extends Seeder
{
    public function run(): void
    {
        $ciclo = CicloFormativo::first();

        if ($ciclo === null) {
            return;
        }

        Estudiante::take(5)->get()->each(
            fn (Estudiante $estudiante) => $estudiante->ciclosFormativos()->syncWithoutDetaching([$ciclo->id])
        );
    }
}
