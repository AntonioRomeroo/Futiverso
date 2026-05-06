@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Gestión de Categorías</h1>
            <a href="{{ route('admin.dashboard') }}" style="color: #777; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Volver al Panel
            </a>
        </div>

        @if(session('success'))
            <div style="background: #2ecc71; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div style="background: #e74c3c; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        <div style="margin-bottom: 20px; text-align: right;">
            <a href="{{ route('admin.categories.create') }}" style="background: #070D59; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                <i class="fa-solid fa-plus"></i> Añadir Nueva Categoría
            </a>
        </div>

        <div style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="background: #f8f9fa; border-bottom: 2px solid #eee;">
                    <tr>
                        <th style="padding: 15px; color: #555;">ID</th>
                        <th style="padding: 15px; color: #555;">Nombre</th>
                        <th style="padding: 15px; color: #555;">URL (Slug)</th>
                        <th style="padding: 15px; color: #555;">Grupo</th>
                        <th style="padding: 15px; color: #555;">Productos Asignados</th>
                        <th style="padding: 15px; color: #555; text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 15px; color: #999;">#{{ $category->id }}</td>
                            <td style="padding: 15px; font-weight: bold; color: #070D59;">{{ $category->nombre }}</td>
                            <td style="padding: 15px; color: #777;">
                                <span style="background: #f1f1f1; padding: 3px 8px; border-radius: 4px; font-family: monospace; font-size: 12px;">/{{ $category->slug }}</span>
                            </td>
                            <td style="padding: 15px; color: #F7B633; font-weight: bold;">{{ $category->grupo ?? 'Sin grupo' }}</td>
                            <td style="padding: 15px;">
                                <span style="background: {{ $category->products_count > 0 ? '#e8f8f5' : '#fdedec' }}; color: {{ $category->products_count > 0 ? '#2ecc71' : '#e74c3c' }}; padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                    {{ $category->products_count }} productos
                                </span>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" style="color: #F7B633; margin-right: 10px; text-decoration: none;" title="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría? Si tiene productos, no te dejará borrarla.');">
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
                                <i class="fa-solid fa-layer-group" style="font-size: 40px; color: #ccc; margin-bottom: 10px; display: block;"></i>
                                No hay categorías registradas todavía.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
