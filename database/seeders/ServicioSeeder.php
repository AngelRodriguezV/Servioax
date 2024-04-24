<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();
        foreach ($users as $user) {
            $user->assignRole('Proveedor');
        }
        $servicios = Servicio::factory(150)->create();

        foreach ($servicios as $servicio) {
            Image::factory()->create([
                'imageable_id' => $servicio->id,
                'imageable_type' => Servicio::class
            ]);
        }
    }
}
