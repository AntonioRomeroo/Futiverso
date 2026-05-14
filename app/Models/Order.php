<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Campos que se pueden guardar de forma automática (seguridad).
     */
    protected $fillable = [
        'user_id', // El ID del cliente que hace el pedido
        'total',   // Precio final total
        'status',  // Estado (Pendiente, Enviado, etc.)
        'address', // Dirección de entrega
        'phone',   // Teléfono de contacto
        'notes',   // Observaciones del cliente
    ];

    /**
     * RELACIÓN: Un pedido pertenece a un usuario concreto.
     * Ejemplo: $pedido->user->name
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * RELACIÓN: Un pedido tiene muchas "líneas de pedido" (productos comprados).
     * Ejemplo: $pedido->items devuelve todas las camisetas de ese pedido.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
