<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Servicio extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

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

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class);
    }

    public function rating()
    {
        $valoracion = Valoracion::select('valoracion', DB::raw('count(*) as rating'))
        ->groupBy('valoracion')
        ->where('servicio_id', $this->id)
        ->latest('rating')
        ->get();
        if (!$valoracion->isEmpty())
        {
            $valoracion = $valoracion->first();
        } else
        {
            $valoracion = [
                'valoracion' => 0,
                'rating' => 0
            ];
        }
        return $valoracion;
    }

    public function ratings()
    {
        $valoracion = Valoracion::select('valoracion', DB::raw('count(*) as rating'))
        ->groupBy('valoracion')
        ->where('servicio_id', $this->id)
        ->latest('valoracion')
        ->get();
        return $valoracion;
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
