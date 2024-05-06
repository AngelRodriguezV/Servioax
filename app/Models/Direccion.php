<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }
}
