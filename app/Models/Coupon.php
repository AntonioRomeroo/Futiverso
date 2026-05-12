<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'is_active',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    /**
     * Comprueba si el cupón es válido hoy.
     */
    public function isValid()
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Calcula el descuento para un total dado.
     */
    public function discount($total)
    {
        if ($this->type === 'fixed') {
            return $this->value;
        } elseif ($this->type === 'percent') {
            return ($this->value / 100) * $total;
        }

        return 0;
    }
}
