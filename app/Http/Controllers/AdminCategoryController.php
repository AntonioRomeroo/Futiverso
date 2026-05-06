<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        // Traemos todas las categorias y contamos cuantos productos tiene cada una
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'grupo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $data = $request->all();
        // Generar slug automáticamente desde el nombre (Ej: "La Liga" -> "la-liga")
        $data['slug'] = Str::slug($request->nombre);

        // Asegurarnos de que el slug sea único
        $count = Category::where('slug', 'LIKE', "{$data['slug']}%")->count();
        if ($count > 0) {
            $data['slug'] .= '-' . ($count + 1);
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'grupo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $data = $request->all();
        
        // Si el nombre ha cambiado, regeneramos el slug
        if ($request->nombre !== $category->nombre) {
            $data['slug'] = Str::slug($request->nombre);
            
            // Asegurarnos de que el nuevo slug sea único (excluyendo la categoría actual)
            $count = Category::where('slug', 'LIKE', "{$data['slug']}%")->where('id', '!=', $category->id)->count();
            if ($count > 0) {
                $data['slug'] .= '-' . ($count + 1);
            }
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Category $category)
    {
        // Verificar si la categoría tiene productos
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'No puedes eliminar esta categoría porque tiene productos asignados. Mueve los productos a otra categoría primero.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Categoría eliminada correctamente.');
    }
}
