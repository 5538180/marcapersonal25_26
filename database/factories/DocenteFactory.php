<?php

namespace Database\Factories;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Docente>
 */
class DocenteFactory extends Factory
{
    public function definition(): array
    {
        $nombre = fake()->firstName();
        $apellidos = fake()->lastName().' '.fake()->lastName();
        $email = fake()->unique()->safeEmail();
        $user = User::factory()->create([
            'name' => $nombre.' '.$apellidos,
            'email' => $email,
        ]);
        $slug = Str::slug($nombre.' '.$apellidos.' '.$email);

        return [
            'user_id' => $user->id,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'email' => $email,
            'slug' => $slug,
        ];
    }
}
