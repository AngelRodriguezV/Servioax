<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermisionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # Roles
        $administrador = Role::create(['name' => 'Admin']);
        $proveedor = Role::create(['name' => 'Proveedor']);
        $cliente = Role::create(['name' => 'Cliente']);

        # Permisos
        
    }
}
