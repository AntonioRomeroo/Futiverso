<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nombre',
        'descripcion',
        'precio',
        'imagen_url',
        'stock',
        'is_featured'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
