<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Direccion;
use App\Models\Documento;
use App\Models\Horario;
use App\Models\Image;
use App\Models\Servicio;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Testing\Fakes\Fake;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 20 usuarios proveedores con sus direcciones, documentos y horarios
        $users = User::factory(30)->create();
        foreach ($users as $user) {
            $user->assignRole('Proveedor');
            $direccion = Direccion::factory()->create([
                'user_id' => $user->id
            ]);
            Documento::factory()->create([
                'user_id' => $user->id,
                'direccion_id' => $direccion->id
            ]);
            Horario::factory()->create([
                'proveedor_id' => $user->id,
                'dia_semana' => 'Lunes',
                'N' => 1,
                'hora_apertura' => '09:00:00',
                'hora_cierre' => '17:00:00'
            ]);
            Horario::factory()->create([
                'proveedor_id' => $user->id,
                'dia_semana' => 'Martes',
                'N' => 2,
                'hora_apertura' => '09:00:00',
                'hora_cierre' => '17:00:00'
            ]);
            Horario::factory()->create([
                'proveedor_id' => $user->id,
                'dia_semana' => 'Viernes',
                'N' => 5,
                'hora_apertura' => '09:00:00',
                'hora_cierre' => '17:00:00'
            ]);
        }

        // Crear 150 servicios y asignarles imágenes
        $json = File::get(database_path('data/servicios.json'));
        $data = json_decode($json, true);

        for ($i=0; $i < 200; $i++) {
            // Seleccionar una categoría aleatoria
            $categoria = Categoria::inRandomOrder()->first();
            // Obtener servicios correspondientes a la categoría seleccionada
            $servicios = $data[$categoria->nombre];
            // Si no hay servicios para la categoría, usar un nombre genérico
            $nombre = Factory::create()->randomElement($servicios);
            Servicio::factory()->create([
                'nombre' => $nombre,
                'slug' => Str::slug($nombre),
                'categoria_id' => $categoria->id
            ]);
        }
        /* foreach ($servicios as $servicio) {
            Image::factory()->create([
                'imageable_id' => $servicio->id,
                'imageable_type' => Servicio::class
            ]);
        } */
    }
}
