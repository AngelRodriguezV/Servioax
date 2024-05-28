<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Relación de uno a muchos con HorarioHora
    public function horarioHoras()
    {
        return $this->hasMany(HorarioHora::class);
    }

    // Relación de muchos a uno con User (Proveedor)
    public function proveedor()
    {
        return $this->belongsTo(User::class, 'proveedor_id');
    }
}
