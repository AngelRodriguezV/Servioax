<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Documento>
 */
class DocumentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url_ine' => '',
            'url_domicilio' => '',
            'estatus' => fake()->randomElement(['NUEVA','EN REVISION','ACEPTADA','RECHAZADA']),
        ];
    }
}
