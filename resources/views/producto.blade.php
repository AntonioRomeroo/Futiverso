@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content" style="padding-top: 40px; padding-bottom: 60px;">
        
        <div style="margin-bottom: 20px;">
            <a href="{{ url()->previous() }}" style="color: #777; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Volver atrás
            </a>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 40px; background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
            
            {{-- Columna Izquierda: Imagen --}}
            <div style="flex: 1; min-width: 300px; background: #f9f9f9; border-radius: 15px; padding: 20px; text-align: center; position: relative;">
                @if($producto->is_featured)
                    <span style="position: absolute; top: 20px; left: 20px; background: #F7B633; color: #070D59; font-size: 14px; font-weight: bold; padding: 8px 15px; border-radius: 20px; z-index: 2;">NOVEDAD</span>
                @endif
                
                @if($producto->imagen_url)
                    {{-- Cambiamos a object-fit: contain para que la camiseta entera se vea perfecta independientemente de su tamaño original --}}
                    <img src="{{ str_starts_with($producto->imagen_url, 'http') ? $producto->imagen_url : asset('storage/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}" style="width: 100%; max-height: 500px; object-fit: contain;">
                @else
                    <i class="fa-solid fa-shirt" style="font-size: 150px; color: #eee; padding: 100px 0;"></i>
                @endif
            </div>

            {{-- Columna Derecha: Detalles --}}
            <div style="flex: 1; min-width: 300px; display: flex; flex-direction: column; justify-content: center;">
                @if($producto->category)
                    <p style="color: #777; text-transform: uppercase; font-weight: bold; font-size: 14px; letter-spacing: 1px; margin-bottom: 10px;">{{ $producto->category->nombre }}</p>
                @endif
                
                <h1 style="color: #070D59; font-size: 36px; margin-top: 0; margin-bottom: 15px; line-height: 1.2;">{{ $producto->nombre }}</h1>
                
                <p style="color: #F7B633; font-weight: bold; font-size: 30px; margin-top: 0; margin-bottom: 25px;">{{ number_format($producto->precio, 2) }} €</p>
                
                <div style="margin-bottom: 30px; line-height: 1.6; color: #555; font-size: 16px;">
                    {!! nl2br(e($producto->descripcion ?? 'No hay descripción disponible para esta camiseta.')) !!}
                </div>

                {{-- Selector de Tallas --}}
                <div style="margin-bottom: 30px;">
                    <p style="margin-bottom: 15px; font-weight: bold; color: #555; font-size: 16px;">Selecciona tu talla:</p>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;" id="size-container">
                        @if($producto->category && $producto->category->slug === 'botas')
                            {{-- Tallas de Botas --}}
                            @for($i = 35; $i <= 47; $i += 0.5)
                                <button type="button" class="size-btn" onclick="selectSize(this)" style="background: white; border: 2px solid #ddd; border-radius: 5px; padding: 10px 15px; font-weight: bold; color: #555; cursor: pointer; transition: all 0.2s;">
                                    {{ $i }}
                                </button>
                            @endfor
                        @else
                            {{-- Tallas de Camisetas/Ropa --}}
                            @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $talla)
                                <button type="button" class="size-btn" onclick="selectSize(this)" style="background: white; border: 2px solid #ddd; border-radius: 5px; padding: 10px 20px; font-weight: bold; color: #555; cursor: pointer; transition: all 0.2s;">
                                    {{ $talla }}
                                </button>
                            @endforeach
                        @endif
                    </div>
                    <p id="size-error" style="color: #e74c3c; font-size: 14px; margin-top: 10px; display: none;"><i class="fa-solid fa-circle-exclamation"></i> Por favor, selecciona una talla primero.</p>
                </div>

                {{-- Botón Añadir al Carrito (Oculto inicialmente) --}}
                <div>
                    @if($producto->stock > 0)
                        <button id="add-to-cart-btn" style="width: 100%; max-width: 300px; background: #070D59; color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; font-size: 18px; cursor: pointer; display: none; justify-content: center; align-items: center; gap: 10px; transition: transform 0.2s, background 0.2s;" onmouseover="this.style.background='#0a158f'; this.style.transform='scale(1.02)';" onmouseout="this.style.background='#070D59'; this.style.transform='scale(1)';">
                            <i class="fa-solid fa-cart-shopping"></i> Añadir al carrito
                        </button>
                    @else
                        <button disabled style="width: 100%; max-width: 300px; background: #eee; color: #999; border: none; padding: 15px; border-radius: 8px; font-weight: bold; font-size: 18px; cursor: not-allowed; display: flex; justify-content: center; align-items: center;">
                            Agotado
                        </button>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>
    function selectSize(element) {
        // Quitar la clase/estilo de seleccionado a todos los botones
        let buttons = document.querySelectorAll('.size-btn');
        buttons.forEach(btn => {
            btn.style.borderColor = '#ddd';
            btn.style.color = '#555';
            btn.style.background = 'white';
        });

        // Aplicar estilo al botón clickeado
        element.style.borderColor = '#070D59';
        element.style.color = 'white';
        element.style.background = '#070D59';

        // Ocultar mensaje de error si estaba visible
        document.getElementById('size-error').style.display = 'none';

        // Mostrar el botón de añadir al carrito si hay stock
        let cartBtn = document.getElementById('add-to-cart-btn');
        if (cartBtn) {
            cartBtn.style.display = 'flex';
        }
    }
</script>
@endsection
