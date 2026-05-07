@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content" style="padding-top: 40px; padding-bottom: 60px;">
        
        <div style="margin-bottom: 20px;">
            <a href="{{ url()->previous() }}" style="color: #777; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Volver atrás
            </a>
        </div>

        {{-- Mensaje de éxito al añadir al carrito --}}
        @if(session('success'))
            <div style="background: #2ecc71; color: white; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-weight: bold; text-align: center; animation: slideDown 0.5s ease;">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
            <style>
                @keyframes slideDown {
                    from { transform: translateY(-20px); opacity: 0; }
                    to { transform: translateY(0); opacity: 1; }
                }
            </style>
        @endif

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

                @if($producto->precio_oferta)
                    <div style="margin-bottom: 25px;">
                        <span style="color: #e74c3c; text-decoration: line-through; font-size: 20px; margin-right: 15px;">{{ number_format($producto->precio, 2) }} €</span>
                        <span style="color: #e74c3c; font-weight: bold; font-size: 36px;">{{ number_format($producto->precio_oferta, 2) }} €</span>
                    </div>
                @else
                    <p style="color: #F7B633; font-weight: bold; font-size: 30px; margin-top: 0; margin-bottom: 25px;">{{ number_format($producto->precio, 2) }} €</p>
                @endif
                
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
                        @elseif($producto->category && $producto->category->slug === 'tallanino')
                            {{-- Tallas de Niños (por edades/altura habitual) --}}
                            @foreach(['2', '4', '6', '8', '10', '12', '14', '16'] as $talla)
                                <button type="button" class="size-btn" onclick="selectSize(this)" style="background: white; border: 2px solid #ddd; border-radius: 5px; padding: 10px 20px; font-weight: bold; color: #555; cursor: pointer; transition: all 0.2s;">
                                    {{ $talla }}
                                </button>
                            @endforeach
                        @elseif($producto->category && str_contains($producto->category->slug, 'bufandas') || ($producto->category && in_array($producto->category->slug, ['clubes', 'selecciones_bufandas', 'retro_bufandas'])))
                            {{-- Bufandas: Talla única --}}
                            <button type="button" class="size-btn" onclick="selectSize(this)" style="background: white; border: 2px solid #ddd; border-radius: 5px; padding: 10px 20px; font-weight: bold; color: #555; cursor: pointer; transition: all 0.2s;">
                                Talla Única
                            </button>
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

                {{-- Personalización (Solo para Camisetas, no botas ni bufandas) --}}
                @if($producto->category && !str_contains($producto->category->slug, 'botas') && !str_contains($producto->category->slug, 'bufandas') && !in_array($producto->category->slug, ['clubes', 'selecciones_bufandas', 'retro_bufandas']))
                    <div id="customization-box" style="margin-bottom: 30px; display: none; background: #f8f9fa; padding: 20px; border-radius: 12px; border: 1px dashed #ddd;">
                        <p style="margin-top: 0; margin-bottom: 15px; font-weight: bold; color: #070D59;"><i class="fa-solid fa-pen-nib"></i> Personaliza tu camiseta:</p>
                        
                        <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                            <div style="flex: 2; min-width: 150px;">
                                <label style="display: block; font-size: 12px; color: #777; margin-bottom: 5px; text-transform: uppercase;">Nombre (Máx 15)</label>
                                <input type="text" id="custom-name" name="custom_name" maxlength="15" placeholder="Ej: MBAPPÉ" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; outline: none;">
                            </div>
                            <div style="flex: 1; min-width: 80px;">
                                <label style="display: block; font-size: 12px; color: #777; margin-bottom: 5px; text-transform: uppercase;">Número (0-99)</label>
                                <input type="number" id="custom-number" name="custom_number" min="0" max="99" placeholder="10" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; outline: none;">
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Botón Añadir al Carrito (Dentro de un Formulario) --}}
                <div>
                    @if($producto->stock > 0)
                        @if($producto->stock < 15)
                            <p style="color: #e67e22; font-size: 15px; font-weight: bold; margin-bottom: 15px;">
                                <i class="fa-solid fa-fire-flame-curved"></i> ¡Rápido! Solo quedan {{ $producto->stock }} unidades en stock.
                            </p>
                        @endif

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            {{-- Campo oculto para el ID del producto --}}
                            <input type="hidden" name="product_id" value="{{ $producto->id }}">
                            
                            {{-- Campo oculto para la talla (se rellenará con JS) --}}
                            <input type="hidden" name="talla" id="selected-size-input" value="">
                            
                            {{-- Campos ocultos para personalización (se rellenarán con JS) --}}
                            <input type="hidden" name="custom_name" id="hidden-custom-name" value="">
                            <input type="hidden" name="custom_number" id="hidden-custom-number" value="">

                            <button type="submit" id="add-to-cart-btn" style="width: 100%; max-width: 300px; background: #070D59; color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; font-size: 18px; cursor: pointer; display: none; justify-content: center; align-items: center; gap: 10px; transition: transform 0.2s, background 0.2s;" onmouseover="this.style.background='#0a158f'; this.style.transform='scale(1.02)';" onmouseout="this.style.background='#070D59'; this.style.transform='scale(1)';">
                                <i class="fa-solid fa-cart-shopping"></i> Añadir al carrito
                            </button>
                        </form>
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

        // 1. Guardamos la talla seleccionada en el input oculto del formulario
        document.getElementById('selected-size-input').value = element.innerText.trim();

        // 2. Mostrar el botón de añadir al carrito y la caja de personalización si hay stock
        let cartBtn = document.getElementById('add-to-cart-btn');
        let customBox = document.getElementById('customization-box');
        if (cartBtn) {
            cartBtn.style.display = 'flex';
        }
        if (customBox) {
            customBox.style.display = 'block';
        }
    }

    // Al enviar el formulario, pasamos los valores de personalización a los inputs ocultos
    document.querySelector('form[action="{{ route("cart.add") }}"]')?.addEventListener('submit', function(e) {
        const nameInput = document.getElementById('custom-name');
        const numInput = document.getElementById('custom-number');
        
        if (nameInput) document.getElementById('hidden-custom-name').value = nameInput.value;
        if (numInput) document.getElementById('hidden-custom-number').value = numInput.value;
    });
</script>
@endsection
