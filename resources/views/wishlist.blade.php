@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content" style="padding-top: 40px; padding-bottom: 60px;">
        
        <div style="border-bottom: 3px solid #e74c3c; padding-bottom: 10px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Mis Favoritos <i class="fa-solid fa-heart" style="color: #e74c3c;"></i></h1>
            <a href="{{ route('inicio') }}" style="color: #777; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-store"></i> Seguir comprando
            </a>
        </div>

        @if($wishlistItems->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px;">
                @foreach($wishlistItems as $item)
                    <div style="background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden; position: relative; transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                        
                        {{-- Botón eliminar --}}
                        <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" style="position: absolute; top: 15px; right: 15px; z-index: 10;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: rgba(255,255,255,0.9); border: none; width: 35px; height: 35px; border-radius: 50%; color: #e74c3c; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: background 0.2s;" onmouseover="this.style.background='#e74c3c'; this.style.color='white'" onmouseout="this.style.background='rgba(255,255,255,0.9)'; this.style.color='#e74c3c'">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>

                        <a href="{{ route('producto.show', $item->product->id) }}" style="text-decoration: none; color: inherit;">
                            <div style="height: 250px; background: #f9f9f9; display: flex; align-items: center; justify-content: center; padding: 20px;">
                                @if($item->product->imagen_url)
                                    <img src="{{ str_starts_with($item->product->imagen_url, 'http') ? $item->product->imagen_url : asset('storage/' . $item->product->imagen_url) }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                @else
                                    <i class="fa-solid fa-shirt" style="font-size: 80px; color: #eee;"></i>
                                @endif
                            </div>

                            <div style="padding: 20px;">
                                <h3 style="margin: 0; color: #070D59; font-size: 18px;">{{ $item->product->nombre }}</h3>
                                <p style="color: #777; font-size: 14px; margin: 10px 0;">{{ Str::limit($item->product->descripcion, 60) }}</p>
                                
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
                                    <span style="font-size: 20px; font-weight: 800; color: #070D59;">{{ number_format($item->product->precio, 2) }} €</span>
                                    <span style="background: #070D59; color: white; padding: 8px 15px; border-radius: 8px; font-size: 13px; font-weight: bold;">Ver producto</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align: center; padding: 80px 20px; background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                <i class="fa-solid fa-heart-circle-xmark" style="font-size: 80px; color: #eee; margin-bottom: 20px;"></i>
                <h2 style="color: #070D59;">Tu lista de deseos está vacía</h2>
                <p style="color: #777; font-size: 18px;">Guarda tus productos favoritos para tenerlos siempre a mano.</p>
                <a href="{{ route('inicio') }}" style="display: inline-block; margin-top: 30px; background: #070D59; color: white; text-decoration: none; padding: 15px 40px; border-radius: 30px; font-weight: bold; transition: background 0.2s;" onmouseover="this.style.background='#F7B633'; this.style.color='#070D59'" onmouseout="this.style.background='#070D59'; this.style.color='white'">
                    Explorar productos
                </a>
            </div>
        @endif

    </div>
</div>
@endsection
