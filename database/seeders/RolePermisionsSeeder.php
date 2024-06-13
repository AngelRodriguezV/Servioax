<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

        # Permisos para cliente
        Permission::create(['name' => 'cliente-ver-solicitudes'])->syncRoles([$proveedor, $cliente]);
        Permission::create(['name' => 'cliente-ver-solicitud'])->syncRoles([$proveedor, $cliente]);
        Permission::create(['name' => 'cliente-crear-solicitud'])->syncRoles([$proveedor, $cliente]);
        Permission::create(['name' => 'cliente-solicitar-servicio'])->syncRoles([$proveedor, $cliente]);
        Permission::create(['name' => 'cliente-ver-dashboard'])->syncRoles([$proveedor, $cliente]);
        Permission::create(['name' => 'cliente-ver-direcciones'])->syncRoles([$proveedor, $cliente]);
        Permission::create(['name' => 'cliente-ver-soporte'])->syncRoles([$proveedor, $cliente]);
        Permission::create(['name' => 'cliente-ver-mensajes'])->syncRoles([$proveedor, $cliente]);
        Permission::create(['name' => 'cliente-ver-perfil'])->syncRoles([$proveedor, $cliente]);


        # Permisos para proveedor
        #Permission::create([''])
    }
}
