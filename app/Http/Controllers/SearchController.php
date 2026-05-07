<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    /**
     * Procesa la búsqueda de productos por nombre o descripción.
     */
    public function __invoke(Request $request)
    {
        $query = $request->input('q');

        // Si no hay búsqueda, redirigimos al inicio o mostramos vacío
        if (!$query) {
            return redirect()->route('inicio');
        }

        // Buscamos productos que coincidan con el término
        $products = Product::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('descripcion', 'LIKE', "%{$query}%")
            ->latest()
            ->paginate(12);

        return view('buscar', compact('products', 'query'));
    }
}
