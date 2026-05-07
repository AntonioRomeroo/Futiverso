@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Gestión de Productos</h1>
            <a href="{{ route('admin.dashboard') }}" style="color: #777; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Volver al Panel
            </a>
        </div>

        @if(session('success'))
            <div style="background: #2ecc71; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="margin-bottom: 20px; text-align: right;">
            <a href="{{ route('admin.products.create') }}" style="background: #070D59; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                <i class="fa-solid fa-plus"></i> Añadir Nuevo Producto
            </a>
        </div>

        <div style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="background: #f8f9fa; border-bottom: 2px solid #eee;">
                    <tr>
                        <th style="padding: 15px; color: #555;">Imagen</th>
                        <th style="padding: 15px; color: #555;">Nombre</th>
                        <th style="padding: 15px; color: #555;">Categoría</th>
                        <th style="padding: 15px; color: #555;">Precio</th>
                        <th style="padding: 15px; color: #555;">Stock</th>
                        <th style="padding: 15px; color: #555; text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 15px;">
                                @if($product->imagen_url)
                                    <img src="{{ str_starts_with($product->imagen_url, 'http') ? $product->imagen_url : asset('storage/' . $product->imagen_url) }}" alt="{{ $product->nombre }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                    <div style="width: 50px; height: 50px; background: #eee; border-radius: 5px; display: flex; align-items: center; justify-content: center; color: #aaa;">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 15px; font-weight: bold; color: #070D59;">{{ $product->nombre }}</td>
                            <td style="padding: 15px; color: #777;">{{ $product->category ? $product->category->nombre : 'Sin categoría' }}</td>
                             <td style="padding: 15px; font-weight: bold;">
                                 @if($product->precio_oferta)
                                     <span style="color: #e74c3c; text-decoration: line-through; font-size: 12px;">{{ number_format($product->precio, 2) }} €</span><br>
                                     <span style="color: #2ecc71;">{{ number_format($product->precio_oferta, 2) }} €</span>
                                 @else
                                     <span style="color: #2ecc71;">{{ number_format($product->precio, 2) }} €</span>
                                 @endif
                             </td>
                            <td style="padding: 15px;">
                                <span style="background: {{ $product->stock > 0 ? '#e8f8f5' : '#fdedec' }}; color: {{ $product->stock > 0 ? '#2ecc71' : '#e74c3c' }}; padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                    {{ $product->stock }} unids.
                                </span>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="{{ route('admin.products.offer', $product->id) }}" style="color: #2ecc71; margin-right: 15px; text-decoration: none;" title="Gestionar Oferta">
                                    <i class="fa-solid fa-tag"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $product->id) }}" style="color: #F7B633; margin-right: 15px; text-decoration: none;" title="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: #e74c3c; cursor: pointer; padding: 0;" title="Eliminar">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 30px; text-align: center; color: #777;">
                                <i class="fa-solid fa-box-open" style="font-size: 40px; color: #ccc; margin-bottom: 10px; display: block;"></i>
                                No hay productos registrados todavía.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
