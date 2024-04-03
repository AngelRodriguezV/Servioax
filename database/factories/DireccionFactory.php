<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Direccion>
 */
class DireccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'calle' => fake()->text(),
            'colonia' => fake()->text(),
            'municipio' => fake()->text(),
            'estado' => fake()->text(),
            'num_interior' => 0,
            'num_exterior' => 0,
            'codigo_postal' => 0,
            'referencias' => fake()->text(30),
        ];
    }
}
