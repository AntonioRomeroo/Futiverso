@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Editar Usuario</h1>
            <a href="{{ route('admin.users.index') }}" style="color: #777; text-decoration: none; font-weight: bold;">
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
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <!-- Nombre -->
                    <div>
                        <label for="name" style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Nombre Completo</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Correo Electrónico</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>
                </div>

                <div style="margin-bottom: 30px;">
                    <label for="is_admin" style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Rol de Usuario</label>
                    <select id="is_admin" name="is_admin" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        <option value="0" {{ old('is_admin', $user->is_admin) == 0 ? 'selected' : '' }}>Usuario Estándar</option>
                        <option value="1" {{ old('is_admin', $user->is_admin) == 1 ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>

                <!-- Botones -->
                <div style="text-align: right; border-top: 1px solid #eee; padding-top: 20px;">
                    <a href="{{ route('admin.users.index') }}" style="color: #777; text-decoration: none; padding: 10px 20px; font-weight: bold; margin-right: 15px;">Cancelar</a>
                    <button type="submit" style="background: #070D59; color: white; border: none; padding: 12px 30px; border-radius: 5px; cursor: pointer; font-weight: bold; font-size: 16px;">
                        <i class="fa-solid fa-save"></i> Actualizar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
