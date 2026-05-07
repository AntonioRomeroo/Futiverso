<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class PublicProductController extends Controller
{
    public function show($id)
    {
        // Buscamos el producto en la base de datos junto con su categoría
        $producto = Product::with('category')->findOrFail($id);
        
        return view('producto', compact('producto'));
    }

    /**
     * Muestra todos los productos marcados como Novedad (is_featured).
     */
    public function novedades()
    {
        $products = Product::where('is_featured', true)->latest()->paginate(12);
        $title = "Novedades";
        return view('lista_especial', compact('products', 'title'));
    }

    /**
     * Muestra todos los productos que tienen un precio de oferta.
     */
    public function ofertas()
    {
        $products = Product::whereNotNull('precio_oferta')->latest()->paginate(12);
        $title = "Ofertas Especiales";
        return view('lista_especial', compact('products', 'title'));
    }
}
