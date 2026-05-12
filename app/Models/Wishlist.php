<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['user_id', 'product_id'];

    /**
     * El producto que está en la lista de deseos.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * El usuario dueño de esta lista.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
