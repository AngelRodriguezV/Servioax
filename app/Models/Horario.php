<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $casts=[
        'hora_apertura' => 'datetime:H:i:s',
        'hora_cierre' => 'datetime:H:i:s',
    ];

    public function diaTrabajo()
    {
        return $this->belongsTo(DiasTrabajo::class);
    }
}
