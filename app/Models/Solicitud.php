<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $fillable = ['fecha', 'hora', 'estatus'];

    public function cliente()
    {
        return $this->belongsTo(User::class);
    }

    public function servicio() 
    {
        return $this->belongsTo(Servicio::class);
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class);
    }
}
