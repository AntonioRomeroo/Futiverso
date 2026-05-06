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
}
