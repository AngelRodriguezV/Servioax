<?php

namespace Database\Seeders;

use App\Models\Conversacion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::where('id', '!=', 1)->get();

        foreach ($users as $user) {
            $conversacion = Conversacion::factory()->create();
            $conversacion->users()->attach(1);
            $conversacion->users()->attach($user->id);
        }

    }
}
