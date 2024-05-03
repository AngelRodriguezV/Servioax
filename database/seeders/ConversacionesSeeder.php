<?php

namespace Database\Seeders;

use App\Models\Conversacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $conversacion1 = Conversacion::factory()->create();

        $conversacion2 = Conversacion::factory()->create();

        $conversacion1->users()->attach(2);
        $conversacion1->users()->attach(3);
        $conversacion2->users()->attach(2);
        $conversacion2->users()->attach(1);

    }
}
