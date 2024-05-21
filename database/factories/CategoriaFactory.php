<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $json = File::get(database_path('data/categoriasnombres.json'));
        $nombres = json_decode($json);
        $nombre = fake()->randomElement($nombres);
        $primeraPalabra = Str::slug(explode(' ', trim($nombre))[0]);


        return [
            'nombre' => $nombre,
            'descripcion' => 'Todos los servicios relacionados a ' . $nombre . ' deben ir en esta categoria',
            'slug' => $primeraPalabra
        ];
    }
}
