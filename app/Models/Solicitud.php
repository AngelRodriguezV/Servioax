<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $dates = [
        'fecha'
    ];

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
