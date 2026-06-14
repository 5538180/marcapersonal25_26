<?php

namespace Database\Factories;

use App\Models\CicloFormativo;
use App\Models\FamiliaProfesional;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<CicloFormativo>
 */
class CicloFormativoFactory extends Factory
{
    public function definition(): array
    {
        $familiaProfesional = FamiliaProfesional::factory()->create();
        $codigo = strtoupper(fake()->unique()->word());
        $nombre = fake()->unique()->sentence(3);
        $grado = fake()->randomElement(['medio', 'superior']);
        $slug = Str::slug($codigo.' '.$nombre);

        return [
            'familia_profesional_id' => $familiaProfesional->id,
            'codigo' => $codigo,
            'nombre' => $nombre,
            'grado' => $grado,
            'slug' => $slug,
        ];
    }
}
