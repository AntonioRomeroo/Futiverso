<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class JerseyController extends Controller
{
    /**
     * Esta funcion recibe el nombre de la categoria que el usuario ha pinchado (el 'slug').
     * Por ejemplo, si entra a '/laliga', el $slug sera 'laliga'.
     */
    public function show($slug)
    {
        // 1. Vamos a la base de datos y buscamos la primera categoria que coincida con ese slug.
        // Tambien cargamos sus productos para pasarlos a la vista.
        $categoria = Category::with('products')->where('slug', $slug)->first();

        // 2. Si el usuario se inventa una URL (ej: /inventado) y no existe en la base de datos...
        if (!$categoria) {
            // Le sacamos la clasica pagina de error 404 (Pagina no encontrada).
            abort(404);
        }

        // 3. Si la categoria si existe, mandamos al usuario a la vista visual 'categoria.blade.php'
        // y le pasamos los datos que hemos sacado de la base de datos (titulo, descripcion y PRODUCTOS).
        return view('categoria', [
            'titulo' => $categoria->nombre,
            'descripcion' => $categoria->descripcion,
            'productos' => $categoria->products
        ]);
    }
}
