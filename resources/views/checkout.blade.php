@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content" style="padding-top: 40px; padding-bottom: 60px;">
        
        <div style="border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Finalizar Pedido</h1>
            <a href="{{ route('cart.index') }}" style="color: #777; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Volver al carrito
            </a>
        </div>

        <div class="responsive-grid-checkout">
            
            {{-- Formulario de Envío --}}
            <div style="background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); padding: 40px;">
                <h2 style="color: #070D59; margin-top: 0; margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-truck-fast" style="color: #F7B633;"></i> Datos de Envío
                </h2>

                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #555; font-weight: bold;">Dirección Completa</label>
                        <input type="text" name="address" required placeholder="Calle, número, piso, código postal y ciudad" 
                            style="width: 100%; padding: 12px 15px; border: 2px solid #eee; border-radius: 10px; outline: none; transition: border-color 0.2s;"
                            onfocus="this.style.borderColor='#F7B633'">
                        @error('address') <span style="color: #e74c3c; font-size: 14px;">{{ $message }}</span> @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; color: #555; font-weight: bold;">Teléfono de Contacto</label>
                        <input type="text" name="phone" required placeholder="Ej: +34 600 000 000" 
                            style="width: 100%; padding: 12px 15px; border: 2px solid #eee; border-radius: 10px; outline: none; transition: border-color 0.2s;"
                            onfocus="this.style.borderColor='#F7B633'">
                        @error('phone') <span style="color: #e74c3c; font-size: 14px;">{{ $message }}</span> @enderror
                    </div>

                    <div style="margin-bottom: 30px;">
                        <label style="display: block; margin-bottom: 8px; color: #555; font-weight: bold;">Notas adicionales (opcional)</label>
                        <textarea name="notes" rows="4" placeholder="Alguna indicación para el repartidor..." 
                            style="width: 100%; padding: 12px 15px; border: 2px solid #eee; border-radius: 10px; outline: none; transition: border-color 0.2s; resize: none;"
                            onfocus="this.style.borderColor='#F7B633'"></textarea>
                        @error('notes') <span style="color: #e74c3c; font-size: 14px;">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" style="width: 100%; background: #070D59; color: white; border: none; padding: 18px; border-radius: 12px; font-weight: bold; font-size: 18px; cursor: pointer; transition: all 0.2s; box-shadow: 0 5px 15px rgba(7, 13, 89, 0.2);"
                        onmouseover="this.style.background='#F7B633'; this.style.color='#070D59'; this.style.transform='translateY(-2px)'"
                        onmouseout="this.style.background='#070D59'; this.style.color='white'; this.style.transform='translateY(0)'">
                        CONFIRMAR Y PAGAR {{ number_format($total, 2) }} €
                    </button>
                </form>
            </div>

            {{-- Resumen del Carrito --}}
            <div style="background: #f8f9fa; border-radius: 20px; padding: 30px; position: sticky; top: 20px;">
                <h3 style="color: #070D59; margin-top: 0; margin-bottom: 20px; border-bottom: 2px solid #F7B633; padding-bottom: 10px;">Tu pedido</h3>
                
                <div style="max-height: 400px; overflow-y: auto; margin-bottom: 20px; padding-right: 10px;">
                    @foreach($cart as $item)
                        <div style="display: flex; gap: 15px; margin-bottom: 15px; align-items: center; background: white; padding: 10px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                            <div style="width: 50px; height: 50px; flex-shrink: 0; background: #f1f2f6; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                @if($item['image'])
                                    <img src="{{ str_starts_with($item['image'], 'http') ? $item['image'] : asset('storage/' . $item['image']) }}" style="width: 100%; height: 100%; object-fit: contain;">
                                @else
                                    <i class="fa-solid fa-shirt" style="color: #ddd;"></i>
                                @endif
                            </div>
                            <div style="flex-grow: 1;">
                                <div style="font-weight: bold; font-size: 14px; color: #070D59;">{{ $item['name'] }}</div>
                                <div style="font-size: 12px; color: #777;">Talla: {{ $item['talla'] }} | Cant: {{ $item['quantity'] }}</div>
                                @if(!empty($item['custom_name']) || !empty($item['custom_number']))
                                    <div style="font-size: 11px; color: #F7B633; font-weight: bold;">
                                        {{ $item['custom_name'] ?? '' }} #{{ $item['custom_number'] ?? '' }}
                                    </div>
                                @endif
                            </div>
                            <div style="font-weight: bold; color: #070D59;">{{ number_format($item['price'] * $item['quantity'], 2) }} €</div>
                        </div>
                    @endforeach
                </div>

                <div style="border-top: 2px dashed #ddd; padding-top: 15px; margin-top: 15px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px; color: #555;">
                        <span>Subtotal</span>
                        <span>{{ number_format($total, 2) }} €</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px; color: #555;">
                        <span>Envío</span>
                        <span style="color: #2ecc71; font-weight: bold;">GRATIS</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 15px; font-size: 20px; font-weight: bold; color: #070D59;">
                        <span>TOTAL</span>
                        <span style="color: #F7B633;">{{ number_format($total, 2) }} €</span>
                    </div>
                </div>

                <div style="margin-top: 25px; display: flex; gap: 10px; justify-content: center; opacity: 0.5; font-size: 20px;">
                    <i class="fa-brands fa-cc-visa"></i>
                    <i class="fa-brands fa-cc-mastercard"></i>
                    <i class="fa-brands fa-cc-paypal"></i>
                    <i class="fa-brands fa-cc-apple-pay"></i>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
