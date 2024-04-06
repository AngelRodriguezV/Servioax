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

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
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

    public function direccion()
    {
        return $this->belongsTo(Direccion::class);
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
