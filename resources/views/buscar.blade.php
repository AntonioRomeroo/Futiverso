@extends('layouts.app')

@section('content')
    <div class="wrap">
        <div class="content">
            <div style="margin-bottom: 40px;">
                <h1 style="text-transform: uppercase; color: #070D59; border-bottom: 3px solid #F7B633; display: inline-block; padding-bottom: 10px; margin-bottom: 15px;">
                    Resultados para: "{{ $query }}"
                </h1>
                <p style="font-size: 16px; color: #777;">
                    Hemos encontrado {{ $products->total() }} productos que coinciden con tu búsqueda.
                </p>
            </div>

            @if($products->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px;">
                    @foreach($products as $producto)
                        <div style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: transform 0.3s ease;">
                            <a href="{{ route('producto.show', $producto->id) }}" style="text-decoration: none; display: block;">
                                <div style="height: 280px; background: #f9f9f9; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
                                    {{-- Etiqueta de Novedad (Izquierda) --}}
                                    @if($producto->is_featured)
                                        <span style="position: absolute; top: 10px; left: 10px; background: #F7B633; color: #070D59; font-size: 11px; font-weight: bold; padding: 4px 10px; border-radius: 20px; z-index: 2;">NOVEDAD</span>
                                    @endif

                                    {{-- Etiqueta de Descuento (Derecha) --}}
                                    @if($producto->precio_oferta)
                                        @php
                                            $descuento = round((1 - ($producto->precio_oferta / $producto->precio)) * 100);
                                        @endphp
                                        <div style="position: absolute; top: 10px; right: 10px; background: #e74c3c; color: white; width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px; box-shadow: 0 4px 10px rgba(231, 76, 60, 0.3); z-index: 2; flex-direction: column; line-height: 1;">
                                            <span>-{{ $descuento }}%</span>
                                        </div>
                                    @endif
                                    
                                    @if($producto->imagen_url)
                                        <img src="{{ str_starts_with($producto->imagen_url, 'http') ? $producto->imagen_url : asset('storage/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}" style="width: 100%; height: 100%; object-fit: contain; padding: 5px;">
                                    @elseif($producto->imagen)
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" style="width: 100%; height: 100%; object-fit: contain; padding: 5px;">
                                    @else
                                        <i class="fa-solid fa-shirt" style="font-size: 100px; color: #eee;"></i>
                                    @endif

                                    {{-- Botón Favoritos (Esquina Inferior Derecha) --}}
                                    @auth
                                        @php
                                            $inWishlist = Auth::user()->wishlist->where('product_id', $producto->id)->first();
                                        @endphp
                                        <form action="{{ route('wishlist.toggle', $producto->id) }}" method="POST" style="position: absolute; bottom: 10px; right: 10px; z-index: 5;">
                                            @csrf
                                            <button type="submit" style="background: rgba(255,255,255,0.9); border: none; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; cursor: pointer; box-shadow: 0 4px 8px rgba(0,0,0,0.1); color: {{ $inWishlist ? '#e74c3c' : '#ccc' }}; transition: all 0.2s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                                <i class="fa-{{ $inWishlist ? 'solid' : 'regular' }} fa-heart"></i>
                                            </button>
                                        </form>
                                    @else
                                        <div style="position: absolute; bottom: 10px; right: 10px; z-index: 5;">
                                            <button onclick="alert('Inicia sesión para guardar favoritos')" style="background: rgba(255,255,255,0.9); border: none; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; cursor: pointer; color: #ccc;">
                                                <i class="fa-regular fa-heart"></i>
                                            </button>
                                        </div>
                                    @endauth
                                </div>
                            </a>
                            <div style="padding: 20px;">
                                <a href="{{ route('producto.show', $producto->id) }}" style="text-decoration: none;">
                                    <h3 style="color: #070D59; margin-top: 0; margin-bottom: 10px; font-size: 18px; transition: color 0.2s;" onmouseover="this.style.color='#F7B633'" onmouseout="this.style.color='#070D59'">{{ $producto->nombre }}</h3>
                                </a>
                                
                                @if($producto->precio_oferta)
                                    <p style="margin-bottom: 15px;">
                                        <span style="color: #e74c3c; text-decoration: line-through; font-size: 16px; margin-right: 10px;">{{ number_format($producto->precio, 2) }} €</span>
                                        <span style="color: #e74c3c; font-weight: bold; font-size: 22px;">{{ number_format($producto->precio_oferta, 2) }} €</span>
                                    </p>
                                @else
                                    <p style="color: #F7B633; font-weight: bold; font-size: 20px; margin-bottom: 15px;">{{ number_format($producto->precio, 2) }} €</p>
                                @endif
                                
                                @if($producto->stock == 0)
                                    <div style="width: 100%; background: #eee; color: #999; border: none; padding: 12px; border-radius: 5px; font-weight: bold; text-align: center; margin-top: 10px;">
                                        Agotado
                                    </div>
                                @else
                                    @if($producto->stock < 15)
                                        <p style="color: #e67e22; font-size: 13px; font-weight: bold; margin-bottom: 10px;">
                                            <i class="fa-solid fa-fire-flame-curved"></i> ¡Solo quedan {{ $producto->stock }} unidades!
                                        </p>
                                    @endif

                                    <a href="{{ route('producto.show', $producto->id) }}" style="width: 100%; background: #070D59; color: white; border: none; padding: 12px; border-radius: 5px; font-weight: bold; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 10px; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='#F7B633'; this.style.color='#070D59'" onmouseout="this.style.background='#070D59'; this.style.color='white'">
                                        <i class="fa-solid fa-eye"></i> COMPRAR
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 40px;">
                    {{ $products->appends(['q' => $query])->links() }}
                </div>
            @else
                <div style="margin-top: 50px; padding: 60px; background: #fff; border-radius: 20px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                    <i class="fa-solid fa-magnifying-glass" style="font-size: 60px; color: #ededed; margin-bottom: 20px;"></i>
                    <h2 style="color: #070D59;">No hemos encontrado nada</h2>
                    <p style="color: #777; font-size: 18px;">Intenta buscar con otras palabras, como el nombre del equipo o el año.</p>
                    <a href="{{ route('inicio') }}" style="display: inline-block; margin-top: 25px; background: #070D59; color: white; text-decoration: none; padding: 12px 30px; border-radius: 30px; font-weight: bold;">
                        Volver a la tienda
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
