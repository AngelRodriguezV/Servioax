<?php

namespace Database\Seeders;

use App\Models\Direccion;
use App\Models\Servicio;
use App\Models\Solicitud;
use App\Models\User;
use App\Models\Valoracion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(50)->create();
        foreach ($users as $user) {

            $user->assignRole('Cliente');
            Direccion::factory()->create([
                'user_id' => $user->id
            ]);
        }
        
        $solicitudes = Solicitud::factory(250)->create();

        foreach ($solicitudes as $solicitud) {
            Valoracion::factory()->create([
                'user_id' => $solicitud->cliente->id,
                'servicio_id' => $solicitud->servicio->id,
            ]);
        }
    }
}
