@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Panel de Control</h1>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="background: #e74c3c; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                    <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
                </button>
            </form>
        </div>

        <h3 style="color: #555; margin-bottom: 20px;">Bienvenido, Administrador</h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            
            {{-- Tarjeta Categorías --}}
            <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); text-align: center;">
                <i class="fa-solid fa-layer-group" style="font-size: 40px; color: #F7B633; margin-bottom: 15px;"></i>
                <h2 style="color: #070D59; font-size: 36px; margin: 0;">{{ $totalCategorias }}</h2>
                <p style="color: #777; margin-top: 5px;">Categorías / Ligas</p>
                <button style="margin-top: 15px; background: #070D59; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">Gestionar</button>
            </div>

            {{-- Tarjeta Productos --}}
            <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); text-align: center;">
                <i class="fa-solid fa-shirt" style="font-size: 40px; color: #F7B633; margin-bottom: 15px;"></i>
                <h2 style="color: #070D59; font-size: 36px; margin: 0;">{{ $totalProductos }}</h2>
                <p style="color: #777; margin-top: 5px;">Productos</p>
                <button style="margin-top: 15px; background: #070D59; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">Gestionar</button>
            </div>

            {{-- Tarjeta Usuarios --}}
            <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); text-align: center;">
                <i class="fa-solid fa-users" style="font-size: 40px; color: #F7B633; margin-bottom: 15px;"></i>
                <h2 style="color: #070D59; font-size: 36px; margin: 0;">{{ $totalUsuarios }}</h2>
                <p style="color: #777; margin-top: 5px;">Usuarios</p>
                <button style="margin-top: 15px; background: #070D59; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">Gestionar</button>
            </div>

        </div>
    </div>
</div>
@endsection
