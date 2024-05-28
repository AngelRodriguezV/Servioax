<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioHora extends Model
{
    use HasFactory;

    protected $fillable = [
        'horario_id',
        'solicitud_id',
        'hora',
        'estatus'
    ];

    // Relación de muchos a uno con Horario
    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }

    // Relación opcional de muchos a uno con Solicitud (si existe el modelo Solicitud)
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }
}
