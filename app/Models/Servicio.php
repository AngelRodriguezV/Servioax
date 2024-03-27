<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug', 'descripcion'];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function proveedor()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
