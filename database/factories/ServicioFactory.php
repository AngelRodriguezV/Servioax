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
        // Leer el JSON con categorías y servicios
        $json = File::get(database_path('data/servicios.json'));
        $categoriasServicios = json_decode($json, true);

        // Seleccionar una categoría aleatoria
        $categoria = Categoria::inRandomOrder()->first();

        // Obtener servicios correspondientes a la categoría seleccionada
        $servicios = $categoriasServicios[$categoria->nombre] ?? [];

        // Si no hay servicios para la categoría, usar un nombre genérico
        $nombreServicio = empty($servicios) ? $this->faker->unique()->word() : $this->faker->randomElement($servicios);
        $slug = Str::slug($nombreServicio);

        // Seleccionar un proveedor aleatorio
        $proveedor = User::role('Proveedor')->inRandomOrder()->first();

        return [
            'nombre' => $nombreServicio,
            'slug' => $slug,
            'descripcion' => $this->faker->text(200), // Descripción limitada a 200 caracteres
            'categoria_id' => $categoria->id,
            'proveedor_id' => $proveedor->id,
            'estatus' => 'ACEPTADA',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
