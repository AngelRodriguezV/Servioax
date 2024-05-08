<?php

namespace Database\Seeders;

use App\Models\Direccion;
use App\Models\Documento;
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
            'nombre' => 'Cliente',
            'apellido_paterno' => '',
            'apellido_materno' => '',
            'email' => 'cliente@servioax.com',
            'password' => Hash::make('servioax2024'),
        ])->assignRole('Cliente');

        Direccion::factory()->create([
            'user_id' => $user->id
        ]);

        $proveedor = User::factory()->create([
            'nombre' => 'Proveedor',
            'apellido_paterno' => '',
            'apellido_materno' => '',
            'email' => 'proveedor@servioax.com',
            'password' => Hash::make('servioax2024'),
        ])->assignRole('Proveedor');

        $direccion = Direccion::factory()->create([
            'user_id' => $proveedor->id
        ]);
        Documento::factory()->create([
            'proveedor_id' => $proveedor->id,
            'direccion_id' => $direccion->id
        ]);
    }
}
