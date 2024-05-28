<?php

namespace Database\Seeders;

use App\Models\DiasTrabajo;
use App\Models\Direccion;
use App\Models\Documento;
use App\Models\Horario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'nombre' => 'Admin',
            'apellido_paterno' => '',
            'apellido_materno' => '',
            'email' => 'admin@servioax.com',
            'password' => Hash::make('servioax2024'),
        ])->assignRole('Admin');

        $user = User::factory()->create([
            'email' => 'cliente@servioax.com',
            'password' => Hash::make('servioax2024'),
        ])->assignRole('Cliente');

        $direccion = Direccion::factory()->create([
            'user_id' => $user->id
        ]);

        Documento::factory()->create([
            'user_id' => $user->id,
            'direccion_id' => $direccion->id
        ]);

        $proveedor = User::factory()->create([
            'email' => 'proveedor@servioax.com',
            'password' => Hash::make('servioax2024'),
        ])->assignRole('Proveedor');

        $direccion = Direccion::factory()->create([
            'user_id' => $proveedor->id
        ]);
        Documento::factory()->create([
            'user_id' => $proveedor->id,
            'direccion_id' => $direccion->id
        ]);
        $dia1 = DiasTrabajo::factory()->create([
            'proveedor_id' => $proveedor->id,
            'dia_semana' => 'Lunes',
            'N' => 1,
        ]);
        $dia2 = DiasTrabajo::factory()->create([
            'proveedor_id' => $proveedor->id,
            'dia_semana' => 'Martes',
            'N' => 2,
        ]);
        $dia3 = DiasTrabajo::factory()->create([
            'proveedor_id' => $proveedor->id,
            'dia_semana' => 'Miercoles',
            'N' => 3,
        ]);
        Horario::factory()->create([
            'dia_trabajo_id' => $dia1->id,
        ]);
        Horario::factory()->create([
            'dia_trabajo_id' => $dia2->id,
        ]);
        Horario::factory()->create([
            'dia_trabajo_id' => $dia3->id,
        ]);
    }
}
