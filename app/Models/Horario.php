<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function diaTrabajo()
    {
        return $this->hasMany(DiasTrabajo::class, 'id', $this->primaryKey);
    }
}
