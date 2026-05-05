<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class JerseyController extends Controller
{
    /**
     * Muestra la categoría solicitada desde la base de datos.
     */
    public function show($slug)
    {
        // Buscamos la categoría por su slug en la base de datos
        $categoria = Category::where('slug', $slug)->first();

        // Si no existe, lanzamos un 404
        if (!$categoria) {
            abort(404);
        }

        return view('categoria', [
            'titulo' => $categoria->nombre,
            'descripcion' => $categoria->descripcion
        ]);
    }
}
