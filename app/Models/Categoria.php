<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'slug'];

    protected $casts = [
        'estado' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'categoria_id', $this->primaryKey);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
