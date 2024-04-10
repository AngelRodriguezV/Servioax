<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversacion extends Model
{
    use HasFactory;

    protected $table = 'conversaciones';

    protected $fillable = [
        'estatus'
    ];

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }

}
