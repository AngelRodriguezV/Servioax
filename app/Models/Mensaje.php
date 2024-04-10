<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'mensaje',
        'estatus',
    ];

    public function remitente()
    {
        return $this->belongsTo(User::class);
    }

    public function conversacion()
    {
        return $this->belongsTo(Conversacion::class);
    }

}
