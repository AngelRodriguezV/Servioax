<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'telefono',
        'password',
    ];

    protected $primaryKey = 'id';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'proveedor_id', $this->primaryKey);
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion::class);
    }

    public function diasTrabajo()
    {
        return $this->hasMany(DiasTrabajo::class, 'proveedor_id', $this->primaryKey);
    }

    public function documento()
    {
        return $this->hasOne(Documento::class, 'user_id', $this->primaryKey);
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class);
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class);
    }

    public function conversaciones()
    {
        return $this->belongsToMany(Conversacion::class, 'conversacion_user', 'user_id', 'conversacion_id', $this->primaryKey);
    }

    public function mesanjes()
    {
        return $this->hasMany(Mensaje::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function rating()
    {
        $servicios = Servicio::select('id')->where('proveedor_id', $this->id)
            ->where('estatus', 'ACEPTADA')->get();

        $valoracion = Valoracion::select('valoracion', DB::raw('count(*) as rating'))
            ->groupBy('valoracion')
            ->whereIn('servicio_id', $servicios)
            ->latest('rating')
            ->get();

        if (!$valoracion->isEmpty()) {
            $valoracion = $valoracion->first();
        } else {
            $valoracion = [
                'valoracion' => 0,
                'rating' => 0
            ];
        }

        return $valoracion;
    }

    public function topServicios()
    {
        return Servicio::where('proveedor_id', $this->id)->take(5)->get();
    }
}
