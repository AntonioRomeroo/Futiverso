<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * fillable: Los datos básicos del usuario que podemos rellenar desde un formulario (Registro o Perfil).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar', // Imagen de perfil personalizada
    ];

    /**
     * hidden: Datos sensibles que JAMÁS deben mostrarse al hacer consultas, por seguridad.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * casts: Convierte automáticamente algunos campos de la base de datos a tipos concretos de PHP.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean', // Aseguramos que siempre sea verdadero o falso, nunca "0" o "1"
    ];

    /**
     * Función que nos dice rápidamente si el usuario es administrador o un cliente normal.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * RELACIÓN: Un usuario puede tener muchos pedidos.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * RELACIÓN: Un usuario tiene muchos productos guardados en su lista de deseos.
     */
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
}
