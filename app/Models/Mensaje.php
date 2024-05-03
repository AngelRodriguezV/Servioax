<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function remitente()
    {
        return $this->belongsTo(User::class);
    }

    public function conversacion()
    {
        return $this->belongsTo(Conversacion::class);
    }

}
