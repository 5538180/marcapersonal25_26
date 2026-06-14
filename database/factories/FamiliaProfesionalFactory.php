<?php

namespace Database\Factories;

use App\Models\FamiliaProfesional;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<FamiliaProfesional>
 */
class FamiliaProfesionalFactory extends Factory
{
    public function definition(): array
    {
        $codigo = strtoupper(fake()->unique()->word());
        $nombre = fake()->unique()->sentence(2);
        $slug = Str::slug($codigo.' '.$nombre);

        return [
            'codigo' => $codigo,
            'nombre' => $nombre,
            'slug' => $slug,
        ];
    }
}
