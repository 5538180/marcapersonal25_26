<?php

namespace Database\Seeders;

use App\Models\Docente;
use Illuminate\Database\Seeder;

class DocenteSeeder extends Seeder
{
    public function run(): void
    {
        if (Docente::query()->doesntExist()) {
            Docente::factory()->count(5)->create();
        }
    }
}
