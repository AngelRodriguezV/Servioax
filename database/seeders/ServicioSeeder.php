<?php

namespace Database\Seeders;

use App\Models\Direccion;
use App\Models\Documento;
use App\Models\Horario;
use App\Models\HorarioHora;
use App\Models\Image;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 20 usuarios proveedores con sus direcciones, documentos y horarios
        $users = User::factory(20)->create();
        foreach ($users as $user) {
            $user->assignRole('Proveedor');
            $direccion = Direccion::factory()->create([
                'user_id' => $user->id
            ]);
            Documento::factory()->create([
                'proveedor_id' => $user->id,
                'direccion_id' => $direccion->id
            ]);

            // Definir los días y horarios para el proveedor
            $dias = [
                ['dia_semana' => 'Lunes', 'N' => 1],
                ['dia_semana' => 'Martes', 'N' => 2],
                ['dia_semana' => 'Viernes', 'N' => 5]
            ];

            foreach ($dias as $dia) {
                $hora_apertura = Carbon::createFromTimeString('09:00:00');
                $hora_cierre = Carbon::createFromTimeString('17:00:00');

                $horario = Horario::factory()->create([
                    'proveedor_id' => $user->id,
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

        // Crear 150 servicios y asignarles imágenes
        $servicios = Servicio::factory(150)->create();
        /* foreach ($servicios as $servicio) {
            Image::factory()->create([
                'imageable_id' => $servicio->id,
                'imageable_type' => Servicio::class
            ]);
        } */
    }
}
