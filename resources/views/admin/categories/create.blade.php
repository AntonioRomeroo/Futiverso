@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Añadir Nueva Categoría</h1>
            <a href="{{ route('admin.categories.index') }}" style="color: #777; text-decoration: none; font-weight: bold;">
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
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <!-- Nombre -->
                    <div>
                        <label for="nombre" style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Nombre de la Categoría *</label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required placeholder="Ej: La Liga" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        <small style="color: #777; display: block; margin-top: 5px;"><i class="fa-solid fa-magic"></i> La URL se generará automáticamente.</small>
                    </div>

                    <!-- Grupo -->
                    <div>
                        <label for="grupo" style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Grupo *</label>
                        <select id="grupo" name="grupo" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                            <option value="">Selecciona un grupo...</option>
                            <option value="Ligas" {{ old('grupo') == 'Ligas' ? 'selected' : '' }}>Ligas</option>
                            <option value="Selecciones" {{ old('grupo') == 'Selecciones' ? 'selected' : '' }}>Selecciones</option>
                            <option value="Retro" {{ old('grupo') == 'Retro' ? 'selected' : '' }}>Retro</option>
                            <option value="Otros" {{ old('grupo') == 'Otros' ? 'selected' : '' }}>Otros</option>
                        </select>
                    </div>
                </div>

                <!-- Descripción -->
                <div style="margin-bottom: 30px;">
                    <label for="descripcion" style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="4" placeholder="Breve descripción de la categoría (opcional)" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">{{ old('descripcion') }}</textarea>
                </div>

                <!-- Botones -->
                <div style="text-align: right; border-top: 1px solid #eee; padding-top: 20px;">
                    <a href="{{ route('admin.categories.index') }}" style="color: #777; text-decoration: none; padding: 10px 20px; font-weight: bold; margin-right: 15px;">Cancelar</a>
                    <button type="submit" style="background: #070D59; color: white; border: none; padding: 12px 30px; border-radius: 5px; cursor: pointer; font-weight: bold; font-size: 16px;">
                        <i class="fa-solid fa-save"></i> Guardar Categoría
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
