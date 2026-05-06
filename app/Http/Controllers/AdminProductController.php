<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen_url' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_featured' => 'boolean'
        ]);

        $data = $request->except('imagen_url');
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('imagen_url')) {
            $path = $request->file('imagen_url')->store('products', 'public');
            $data['imagen_url'] = $path;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen_url' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_featured' => 'boolean'
        ]);

        $data = $request->except('imagen_url');
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('imagen_url')) {
            // Eliminar imagen anterior si existe
            if ($product->imagen_url && Storage::disk('public')->exists($product->imagen_url)) {
                Storage::disk('public')->delete($product->imagen_url);
            }
            $path = $request->file('imagen_url')->store('products', 'public');
            $data['imagen_url'] = $path;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        if ($product->imagen_url && Storage::disk('public')->exists($product->imagen_url)) {
            Storage::disk('public')->delete($product->imagen_url);
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado correctamente.');
    }
}
