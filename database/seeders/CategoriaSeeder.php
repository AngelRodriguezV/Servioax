<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Image;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/categoriasnombres.json'));
        $categorias = json_decode($json, true);

        foreach ($categorias as $categoria) {
            Categoria::factory()->create([
                'nombre' => $categoria,
                'slug' => Str::slug($categoria),
                'descripcion' => 'Todos los servicios relacionados a ' . $categoria . ' deben ir en esta categoria',
            ]);
        }
    }
}
