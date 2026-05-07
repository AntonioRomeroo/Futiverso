@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Gestionar Oferta</h1>
            <a href="{{ route('admin.products.index') }}" style="color: #777; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Volver a Productos
            </a>
        </div>

        <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); max-width: 600px; margin: 0 auto;">
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #eee;">
                <img src="{{ asset('storage/' . $product->imagen_url) }}" style="width: 80px; height: 80px; object-fit: contain; background: #f9f9f9; border-radius: 10px;">
                <div>
                    <h3 style="margin: 0; color: #070D59;">{{ $product->nombre }}</h3>
                    <p style="margin: 5px 0 0; color: #777;">Precio Original: <strong>{{ number_format($product->precio, 2) }} €</strong></p>
                </div>
            </div>

            <form action="{{ route('admin.products.updateOffer', $product->id) }}" method="POST">
                @csrf
                @method('PATCH')

                {{-- Añadimos el precio original oculto para que la validación funcione --}}
                <input type="hidden" name="precio" value="{{ $product->precio }}">

                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: bold; color: #555; margin-bottom: 10px;">Nuevo Precio de Oferta (€)</label>
                    <input type="number" name="precio_oferta" step="0.01" min="0" max="{{ $product->precio - 0.01 }}" value="{{ $product->precio_oferta }}" 
                           placeholder="Ej: 19.95" 
                           style="width: 100%; padding: 15px; border: 2px solid #eee; border-radius: 10px; font-size: 18px; outline: none; transition: border-color 0.3s;"
                           onfocus="this.style.borderColor='#F7B633'" onblur="this.style.borderColor='#eee'">
                    <p style="font-size: 13px; color: #777; margin-top: 8px;">
                        Deja el campo vacío para eliminar la oferta y volver al precio original.
                    </p>
                    @error('precio_oferta')
                        <p style="color: #e74c3c; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" style="width: 100%; background: #070D59; color: white; border: none; padding: 15px; border-radius: 10px; font-weight: bold; font-size: 16px; cursor: pointer; transition: background 0.3s;" onmouseover="this.style.background='#F7B633'; this.style.color='#070D59'" onmouseout="this.style.background='#070D59'; this.style.color='white'">
                    Actualizar Oferta
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
