<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiasTrabajo extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function proveedor()
    {
        return $this->hasMany(User::class, 'id', $this->primaryKey);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'dia_trabajo_id', $this->primaryKey);
    }
}
