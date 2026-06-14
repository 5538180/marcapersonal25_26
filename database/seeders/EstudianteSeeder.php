<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use Illuminate\Database\Seeder;

class EstudianteSeeder extends Seeder
{
    public function run(): void
    {
        if (Estudiante::query()->doesntExist()) {
            Estudiante::factory()->count(12)->create();
        }
    }
}
