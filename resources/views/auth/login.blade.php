@extends('layouts.app')

@section('content')
<div class="wrap" style="display: flex; justify-content: center; align-items: center; min-height: 60vh;">
    <div style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px;">
        <h2 style="text-align: center; margin-bottom: 20px; color: #070D59;">Iniciar Sesión</h2>

        {{-- Mostrar errores si las credenciales fallan --}}
        @if ($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px; font-size: 14px;">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div style="margin-bottom: 20px;">
                <label for="email" style="display: block; margin-bottom: 5px; color: #555;">Correo Electrónico</label>
                <input type="email" name="email" id="email" required autofocus
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; outline: none;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="password" style="display: block; margin-bottom: 5px; color: #555;">Contraseña</label>
                <input type="password" name="password" id="password" required
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; outline: none;">
            </div>

            <button type="submit" 
                    style="width: 100%; padding: 12px; background: #F7B633; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.3s;">
                Entrar
            </button>
        </form>
    </div>
</div>
@endsection
