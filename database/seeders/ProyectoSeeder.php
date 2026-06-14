<?php

namespace Database\Seeders;

use App\Models\Proyecto;
use Illuminate\Database\Seeder;

class ProyectoSeeder extends Seeder
{
    public function run(): void
    {
        if (Proyecto::query()->doesntExist()) {
            Proyecto::factory()->count(10)->create();
        }
    }
}
