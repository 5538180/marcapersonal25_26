<?php

namespace Database\Factories;

use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Estudiante>
 */
class EstudianteFactory extends Factory
{
    public function definition(): array
    {
        $user = User::factory()->create();
        $nombre = fake()->firstName();
        $apellidos = fake()->lastName().' '.fake()->lastName();
        $dni = fake()->unique()->numberBetween(10000000, 99999999).strtoupper(fake()->randomLetter());
        $slug = Str::slug($nombre.' '.$apellidos.' '.$dni);

        return [
            'user_id' => $user->id,
            'dni' => $dni,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'email' => fake()->unique()->safeEmail(),
            'telefono' => fake()->phoneNumber(),
            'imagen' => null,
            'slug' => $slug,
        ];
    }
}
