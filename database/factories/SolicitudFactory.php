<?php

namespace Database\Factories;

use App\Models\Direccion;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Solicitud>
 */
class SolicitudFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::role('Cliente')->get()->random();
        return [
            'cliente_id' => $user->id,
            'servicio_id' => Servicio::all()->random()->id,
            'direccion_id' => $user->direcciones[0]->id,
            'fecha' => fake()->date(),
            'hora' => fake()->time(),
            'costo' => $this->faker->randomFloat(2, 10, 500), // Valor predeterminado para costo
            'estatus' => fake()->randomElement(['NUEVA','EN REVISION','ACEPTADA','RECHAZADA','EN PROCESO','COMPLETADA','CANCELADA']),
        ];
    }
}
