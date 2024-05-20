<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
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
        $name = fake()->unique()->word();
        return [
            'nombre' => $name,
            'slug' => Str::slug($name),
            'descripcion' => fake()->text(100),
            'estatus' => fake()->randomElement(['NUEVA','EN REVISION','ACEPTADA','RECHAZADA','EN PROCESO']),
            'categoria_id' => Categoria::all()->random()->id,
            'proveedor_id' => User::role('Proveedor')->whereHas('documento', function ($query) {
                    $query->whereIn('estatus', ['ACEPTADA', 'EN REVISION']);
                })->get()->random()->id
        ];
    }
}
