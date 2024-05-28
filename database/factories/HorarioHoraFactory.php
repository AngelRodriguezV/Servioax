<?php

namespace Database\Factories;

use App\Models\HorarioHora;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioHoraFactory extends Factory
{
    protected $model = HorarioHora::class;

    public function definition()
    {
        return [
            'horario_id' => 1, // Placeholder, se ajustará en el seeder
            'solicitud_id' => null, // Placeholder, se ajustará en el seeder
            'hora' => $this->faker->time(),
            'estatus' => 'Libre', // Establecemos el estatus como 'Libre'
        ];
    }
}
