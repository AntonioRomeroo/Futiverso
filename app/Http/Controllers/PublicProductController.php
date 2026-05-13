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

    /**
     * Muestra los productos más vendidos basándose en la cantidad total pedida.
     */
    public function masVendidos()
    {
        // Unimos con order_items para sumar las cantidades vendidas de cada producto
        $products = Product::leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->select('products.*', \DB::raw('SUM(COALESCE(order_items.quantity, 0)) as total_sales'))
            ->groupBy('products.id', 'products.nombre', 'products.descripcion', 'products.precio', 'products.precio_oferta', 'products.stock', 'products.imagen_url', 'products.category_id', 'products.is_featured', 'products.created_at', 'products.updated_at')
            ->orderByDesc('total_sales')
            ->orderByDesc('products.created_at')
            ->paginate(12);

        $title = "Más Vendidos";
        return view('lista_especial', compact('products', 'title'));
    }
}
