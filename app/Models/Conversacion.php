<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Conversacion extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'conversaciones';

    protected $fillable = [
        'estatus'
    ];

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }

    /**
     * Relacion de muchos a muchos
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'conversacion_user', 'conversacion_id', 'user_id', $this->primaryKey);
    }

}
