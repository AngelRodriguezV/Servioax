<?php

namespace Database\Seeders;

use App\Models\Direccion;
use App\Models\Documento;
use App\Models\Horario;
use App\Models\HorarioHora;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario Admin
        User::factory()->create([
            'nombre' => 'Admin',
            'apellido_paterno' => '',
            'apellido_materno' => '',
            'email' => 'admin@servioax.com',
            'password' => Hash::make('servioax2024'),
        ])->assignRole('Admin');

        // Crear usuario Cliente
        $user = User::factory()->create([
            'email' => 'cliente@servioax.com',
            'password' => Hash::make('servioax2024'),
        ])->assignRole('Cliente');

        Direccion::factory()->create([
            'user_id' => $user->id
        ]);

        // Crear usuario Proveedor
        $proveedor = User::factory()->create([
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

        // Crear horarios para el proveedor y sus horario_horas asociados
        $dias = [
            ['dia_semana' => 'Lunes', 'N' => 1],
            ['dia_semana' => 'Martes', 'N' => 2],
            ['dia_semana' => 'Viernes', 'N' => 5]
        ];

        foreach ($dias as $dia) {
            $hora_apertura = Carbon::createFromTimeString('09:00:00');
            $hora_cierre = Carbon::createFromTimeString('18:00:00');

            $horario = Horario::factory()->create([
                'proveedor_id' => $proveedor->id,
                'dia_semana' => $dia['dia_semana'],
                'N' => $dia['N'],
                'hora_apertura' => $hora_apertura,
                'hora_cierre' => $hora_cierre,
                'Notas' => 'Horario de atención'
            ]);

            // Crear HorarioHora para cada hora entre apertura y cierre
            $hora = $hora_apertura->copy();
            while ($hora->lessThanOrEqualTo($hora_cierre)) {
                HorarioHora::factory()->create([
                    'horario_id' => $horario->id,
                    'solicitud_id' => null,
                    'hora' => $hora->format('H:i:s'),
                    'estatus' => 'Libre'
                ]);
                $hora->addHour(); // Incrementar una hora
            }
        }
    }
}
