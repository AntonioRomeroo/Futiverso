<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    /**
     * Muestra la lista principal de productos en el panel de administrador (con paginación).
     */
    public function index()
    {
        // Trae los productos junto con su categoría para evitar demasiadas consultas a la base de datos.
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Muestra el formulario para añadir un nuevo producto.
     */
    public function create()
    {
        // Necesitamos todas las categorías para mostrarlas en el desplegable (select) del formulario.
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Recibe los datos del formulario de creación y guarda el producto en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validar que los datos que ha metido el administrador son correctos y seguros.
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'precio_oferta' => 'nullable|numeric|min:0|lt:precio', // La oferta debe ser menor que el precio original
            'stock' => 'required|integer|min:0',
            'imagen_url' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_featured' => 'boolean'
        ]);

        // 2. Extraer todos los datos menos la imagen, porque esa la guardamos de forma especial.
        $data = $request->except('imagen_url');
        
        // 3. Convertir el checkbox de 'Destacado' a un valor booleano (true o false).
        $data['is_featured'] = $request->has('is_featured');

        // 4. Si se ha subido una imagen, la guardamos en la carpeta 'public/products'.
        if ($request->hasFile('imagen_url')) {
            $path = $request->file('imagen_url')->store('products', 'public');
            $data['imagen_url'] = $path; // Guardamos la ruta en los datos para la base de datos.
        }

        // 5. Crear el producto en la base de datos.
        Product::create($data);

        // 6. Volver a la lista de productos con un mensaje de éxito.
        return redirect()->route('admin.products.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un producto que ya existe.
     */
    public function edit(Product $product)
    {
        // Igual que en 'create', necesitamos las categorías para el desplegable.
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Recibe los datos del formulario de edición y actualiza el producto en la base de datos.
     */
    public function update(Request $request, Product $product)
    {
        // 1. Validar los nuevos datos. La imagen aquí es opcional (puede que no la quiera cambiar).
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'precio_oferta' => 'nullable|numeric|min:0|lt:precio',
            'stock' => 'required|integer|min:0',
            'imagen_url' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_featured' => 'boolean'
        ]);

        $data = $request->except('imagen_url');
        $data['is_featured'] = $request->has('is_featured');

        // 2. Si se sube una nueva imagen...
        if ($request->hasFile('imagen_url')) {
            // ...primero eliminamos la imagen antigua del servidor para no ocupar espacio tontamente.
            if ($product->imagen_url && Storage::disk('public')->exists($product->imagen_url)) {
                Storage::disk('public')->delete($product->imagen_url);
            }
            // ...luego guardamos la nueva y actualizamos la ruta.
            $path = $request->file('imagen_url')->store('products', 'public');
            $data['imagen_url'] = $path;
        }

        // 3. Actualizamos el registro en la base de datos con los datos nuevos.
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Elimina completamente un producto de la base de datos.
     */
    public function destroy(Product $product)
    {
        // Antes de borrar el producto, borramos su imagen asociada del disco duro del servidor.
        if ($product->imagen_url && Storage::disk('public')->exists($product->imagen_url)) {
            Storage::disk('public')->delete($product->imagen_url);
        }
        
        // Borramos el producto de la base de datos.
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado correctamente.');
    }

    /**
     * Muestra el pequeño formulario específico para poner o quitar una oferta a un producto.
     */
    public function editOffer(Product $product)
    {
        return view('admin.products.offer', compact('product'));
    }

    /**
     * Actualiza solamente el campo 'precio_oferta' de un producto.
     */
    public function updateOffer(Request $request, Product $product)
    {
        // Validamos que sea un número y que sea menor que el precio original del producto.
        $request->validate([
            'precio_oferta' => 'nullable|numeric|min:0|lt:precio'
        ]);

        // Actualizamos.
        $product->update([
            'precio_oferta' => $request->precio_oferta
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Oferta actualizada correctamente.');
    }
}
