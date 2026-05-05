<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug', 'descripcion', 'grupo'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
