<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Storage::deleteDirectory('public/image');
        Storage::makeDirectory('public/image');

        Storage::deleteDirectory('public/photo');
        Storage::makeDirectory('public/photo');

        $this->call(RolePermisionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ServicioSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(ConversacionesSeeder::class);
    }
}
