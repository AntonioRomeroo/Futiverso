@extends('layouts.app')

@section('content')
    <div class="wrap">
        <div class="content">
            <h1 style="text-transform: uppercase; color: #070D59; border-bottom: 3px solid #F7B633; display: inline-block; padding-bottom: 10px; margin-bottom: 20px;">
                {{ $titulo }}
            </h1>
            
            <p style="font-size: 18px; color: #555; line-height: 1.6; max-width: 800px;">
                {{ $descripcion }}
            </p>

            @if(isset($productos) && count($productos) > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px; margin-top: 40px;">
                    @foreach($productos as $producto)
                        <div style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: transform 0.3s ease;">
                            <a href="{{ route('producto.show', $producto->id) }}" style="text-decoration: none; display: block;">
                                <div style="height: 250px; background: #f9f9f9; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
                                    @if($producto->is_featured)
                                        <span style="position: absolute; top: 10px; right: 10px; background: #F7B633; color: #070D59; font-size: 12px; font-weight: bold; padding: 5px 10px; border-radius: 20px; z-index: 2;">NOVEDAD</span>
                                    @endif
                                    @if($producto->imagen_url)
                                        <img src="{{ str_starts_with($producto->imagen_url, 'http') ? $producto->imagen_url : asset('storage/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}" style="width: 100%; height: 100%; object-fit: contain; padding: 10px;">
                                    @else
                                        <i class="fa-solid fa-shirt" style="font-size: 80px; color: #eee;"></i>
                                    @endif
                                </div>
                            </a>
                            <div style="padding: 20px;">
                                <a href="{{ route('producto.show', $producto->id) }}" style="text-decoration: none;">
                                    <h3 style="color: #070D59; margin-top: 0; margin-bottom: 10px; font-size: 18px; transition: color 0.2s;" onmouseover="this.style.color='#F7B633'" onmouseout="this.style.color='#070D59'">{{ $producto->nombre }}</h3>
                                </a>
                                <p style="color: #F7B633; font-weight: bold; font-size: 20px; margin-bottom: 15px;">{{ number_format($producto->precio, 2) }} €</p>
                                
                                @if($producto->stock > 0)
                                    <button style="width: 100%; background: #070D59; color: white; border: none; padding: 10px; border-radius: 5px; font-weight: bold; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 10px;">
                                        <i class="fa-solid fa-cart-shopping"></i> Añadir al carrito
                                    </button>
                                @else
                                    <button disabled style="width: 100%; background: #eee; color: #999; border: none; padding: 10px; border-radius: 5px; font-weight: bold; cursor: not-allowed;">
                                        Agotado
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="margin-top: 50px; padding: 40px; background: #fff; border-radius: 20px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                    <i class="fa-solid fa-shirt" style="font-size: 50px; color: #ededed; margin-bottom: 20px;"></i>
                    <h3 style="color: #999;">Aún no hay productos en {{ $titulo }}</h3>
                    <p style="color: #bbb;">Estamos actualizando el stock para esta temporada. ¡Vuelve pronto!</p>
                </div>
            @endif
        </div>
    </div>
@endsection
