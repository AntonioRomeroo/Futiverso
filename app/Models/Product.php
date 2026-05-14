<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * fillable: Aquí indicamos qué campos de la tabla en la base de datos 
     * se pueden rellenar de forma masiva (cuando creamos o actualizamos un producto).
     * Esto es una medida de seguridad de Laravel para evitar que inyecten datos no deseados.
     */
    protected $fillable = [
        'category_id',    // ID de la categoría a la que pertenece
        'nombre',         // Nombre del producto
        'descripcion',    // Descripción larga
        'precio',         // Precio original
        'precio_oferta',  // Precio rebajado (si lo tiene)
        'imagen_url',     // Ruta de la imagen en el servidor
        'stock',          // Cantidad disponible
        'is_featured'     // ¿Es una novedad o producto destacado?
    ];

    /**
     * RELACIONES ENTRE TABLAS:
     * Un producto "pertenece a" (belongsTo) una categoría específica.
     * Así podemos acceder al nombre de la categoría haciendo $producto->category->name.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
