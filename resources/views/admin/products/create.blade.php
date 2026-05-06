@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Añadir Nuevo Producto</h1>
            <a href="{{ route('admin.products.index') }}" style="color: #777; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Volver a la Lista
            </a>
        </div>

        @if($errors->any())
            <div style="background: #fdedec; color: #e74c3c; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); padding: 30px;">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <!-- Nombre -->
                    <div>
                        <label for="nombre" style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Nombre del Producto *</label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <!-- Categoría -->
                    <div>
                        <label for="category_id" style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Categoría *</label>
                        <select id="category_id" name="category_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                            <option value="">Selecciona una categoría...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Precio -->
                    <div>
                        <label for="precio" style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Precio (€) *</label>
                        <input type="number" id="precio" name="precio" step="0.01" min="0" value="{{ old('precio') }}" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock" style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Stock *</label>
                        <input type="number" id="stock" name="stock" min="0" value="{{ old('stock', 0) }}" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>
                </div>

                <!-- Descripción -->
                <div style="margin-bottom: 20px;">
                    <label for="descripcion" style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="4" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">{{ old('descripcion') }}</textarea>
                </div>

                <!-- Imagen -->
                <div style="margin-bottom: 20px;">
                    <label for="imagen_url" style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Imagen del Producto *</label>
                    <input type="file" id="imagen_url" name="imagen_url" accept="image/*" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background: #f9f9f9;">
                    <small style="color: #777; display: block; margin-top: 5px;">Formatos aceptados: JPG, PNG, WEBP. Tamaño máximo: 2MB.</small>
                </div>

                <!-- Destacado -->
                <div style="margin-bottom: 30px;">
                    <label style="display: flex; align-items: center; cursor: pointer;">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="width: 20px; height: 20px; margin-right: 10px;">
                        <span style="font-weight: bold; color: #555;">Marcar como producto destacado (novedad)</span>
                    </label>
                </div>

                <!-- Botones -->
                <div style="text-align: right; border-top: 1px solid #eee; padding-top: 20px;">
                    <a href="{{ route('admin.products.index') }}" style="color: #777; text-decoration: none; padding: 10px 20px; font-weight: bold; margin-right: 15px;">Cancelar</a>
                    <button type="submit" style="background: #070D59; color: white; border: none; padding: 12px 30px; border-radius: 5px; cursor: pointer; font-weight: bold; font-size: 16px;">
                        <i class="fa-solid fa-save"></i> Guardar Producto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
