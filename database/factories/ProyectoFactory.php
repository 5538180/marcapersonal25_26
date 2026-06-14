<?php

namespace Database\Factories;

use App\Models\Proyecto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Proyecto>
 */
class ProyectoFactory extends Factory
{
    public function definition(): array
    {
        $nombre = fake()->unique()->sentence(3);
        $slug = Str::slug($nombre);

        return [
            'nombre' => $nombre,
            'descripcion' => fake()->paragraph(),
            'url' => fake()->url(),
            'imagen' => null,
            'dificultad' => fake()->randomElement(['baja', 'media', 'alta']),
            'slug' => $slug,
        ];
    }
}
