<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Servicio>
 */
class ServicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->text(200), // Descripción limitada a 200 caracteres
            'estatus' => fake()->randomElement(['NUEVA','EN REVISION','ACEPTADA','RECHAZADA','EN PROCESO']),
            'proveedor_id' => User::role('Proveedor')->whereHas('documento', function ($query) {
                    $query->whereIn('estatus', ['ACEPTADA', 'EN REVISION']);
                })->get()->random()->id
        ];
    }
}
