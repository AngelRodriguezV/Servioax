<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Image;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = Categoria::factory(20)->create();
        foreach ($categorias as $categoria) {
            Image::factory()->create([
                'imageable_id' => $categoria->id,
                'imageable_type' => Categoria::class
            ]);
        }
    }
}
