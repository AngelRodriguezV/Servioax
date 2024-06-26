<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Valoracion>
 */
class ValoracionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'valoracion' => fake()->randomElement([0, 1, 2, 3, 4, 5]),
            'comentario' => fake()->text(50),
            'estatus' => fake()->randomElement(['ACTIVA', 'BLOQUEADA', 'REVISION'])
        ];
    }
}
