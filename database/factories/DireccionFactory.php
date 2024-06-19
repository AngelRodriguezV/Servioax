<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

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
        $json = File::get(database_path('data/direcciones.json'));
        $direcciones = json_decode($json);
        $direccion = fake()->randomElement($direcciones);
        return [
            'calle' => $direccion->calle,
            'colonia' => $direccion->colonia,
            'municipio' => $direccion->municipio,
            'estado' => $direccion->estado,
            'num_interior' => $direccion->num_interior !== "" ? $direccion->num_interior : null,
            'num_exterior' => $direccion->num_exterior,
            'codigo_postal' => $direccion->codigo_postal,
            'referencias' => $direccion->referencias,
            'entre_calle1' => $direccion->entre_calle1,
            'entre_calle2' => $direccion->entre_calle2,
            'latitud' => $direccion->latitud,
            'longitud' => $direccion->longitud
        ];
    }
}
