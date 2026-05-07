@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content" style="padding-top: 40px; padding-bottom: 60px;">
        
        <div style="border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Tu Carrito</h1>
            <a href="{{ route('inicio') }}" style="color: #777; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Seguir comprando
            </a>
        </div>

        @if(count($cart) > 0)
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px; align-items: start;">
                
                {{-- Lista de Productos --}}
                <div style="background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left;">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th style="padding: 20px; color: #777; font-size: 14px; text-transform: uppercase;">Producto</th>
                                <th style="padding: 20px; color: #777; font-size: 14px; text-transform: uppercase;">Talla</th>
                                <th style="padding: 20px; color: #777; font-size: 14px; text-transform: uppercase;">Precio</th>
                                <th style="padding: 20px; color: #777; font-size: 14px; text-transform: uppercase;">Cantidad</th>
                                <th style="padding: 20px; color: #777; font-size: 14px; text-transform: uppercase; text-align: right;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $key => $item)
                                <tr style="border-bottom: 1px solid #eee;">
                                    <td style="padding: 20px;">
                                        <div style="display: flex; align-items: center; gap: 15px;">
                                            <div style="width: 60px; height: 60px; background: #f9f9f9; border-radius: 10px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                                @if($item['image'])
                                                    <img src="{{ str_starts_with($item['image'], 'http') ? $item['image'] : asset('storage/' . $item['image']) }}" style="width: 100%; height: 100%; object-fit: contain; padding: 5px;">
                                                @else
                                                    <i class="fa-solid fa-shirt" style="color: #ddd;"></i>
                                                @endif
                                            </div>
                                            <div style="display: flex; flex-direction: column;">
                                                <span style="font-weight: bold; color: #070D59;">{{ $item['name'] }}</span>
                                                @if(!empty($item['custom_name']) || !empty($item['custom_number']))
                                                    <span style="font-size: 11px; color: #F7B633; background: #070D59; padding: 2px 6px; border-radius: 4px; margin-top: 4px; width: fit-content;">
                                                        <i class="fa-solid fa-pen-nib"></i> {{ $item['custom_name'] ?? '' }} #{{ $item['custom_number'] ?? '' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding: 20px; font-weight: bold; color: #555;">{{ $item['talla'] }}</td>
                                    <td style="padding: 20px; color: #777;">{{ number_format($item['price'], 2) }} €</td>
                                    <td style="padding: 20px;">
                                        <div style="display: flex; align-items: center; gap: 10px; background: #f1f2f6; width: fit-content; padding: 5px 10px; border-radius: 50px;">
                                            {{-- Botón Menos --}}
                                            <form action="{{ route('cart.decrement', $key) }}" method="POST" style="margin: 0;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" style="background: white; border: none; width: 25px; height: 25px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #070D59; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">-</button>
                                            </form>
                                            
                                            <span style="font-weight: bold; min-width: 20px; text-align: center;">{{ $item['quantity'] }}</span>
                                            
                                            {{-- Botón Más --}}
                                            <form action="{{ route('cart.increment', $key) }}" method="POST" style="margin: 0;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" style="background: white; border: none; width: 25px; height: 25px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #070D59; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">+</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td style="padding: 20px; text-align: right;">
                                        <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 5px;">
                                            <span style="font-weight: bold; color: #070D59;">{{ number_format($item['price'] * $item['quantity'], 2) }} €</span>
                                            
                                            {{-- Botón Eliminar --}}
                                            <form action="{{ route('cart.remove', $key) }}" method="POST" style="margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background: none; border: none; color: #e74c3c; font-size: 12px; cursor: pointer; text-decoration: underline; padding: 0;">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Resumen del Pedido --}}
                <div style="background: #070D59; color: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(7, 13, 89, 0.2);">
                    <h2 style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px; font-size: 20px;">Resumen del Pedido</h2>
                    
                    <div style="display: flex; justify-content: space-between; margin: 20px 0; font-size: 18px;">
                        <span>Subtotal</span>
                        <span>{{ number_format($total, 2) }} €</span>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 16px; color: rgba(255,255,255,0.7);">
                        <span>Gastos de envío</span>
                        <span>Gratis</span>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; border-top: 2px solid #F7B633; padding-top: 20px; margin-top: 20px;">
                        <span style="font-size: 22px; font-weight: bold;">TOTAL</span>
                        <span style="font-size: 22px; font-weight: bold; color: #F7B633;">{{ number_format($total, 2) }} €</span>
                    </div>

                    <button style="width: 100%; background: #F7B633; color: #070D59; border: none; padding: 15px; border-radius: 10px; font-weight: bold; font-size: 18px; margin-top: 30px; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
                        FINALIZAR PEDIDO <i class="fa-solid fa-arrow-right"></i>
                    </button>
                    
                    <p style="text-align: center; font-size: 12px; margin-top: 15px; opacity: 0.6;">
                        <i class="fa-solid fa-lock"></i> Pago 100% seguro y garantizado
                    </p>
                </div>

            </div>
        @else
            {{-- Carrito Vacío --}}
            <div style="text-align: center; padding: 100px 20px; background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                <i class="fa-solid fa-cart-shopping" style="font-size: 80px; color: #eee; margin-bottom: 20px;"></i>
                <h2 style="color: #070D59;">Tu carrito está vacío</h2>
                <p style="color: #777; font-size: 18px;">¡Añade alguna camiseta para empezar tu pedido!</p>
                <a href="{{ route('inicio') }}" style="display: inline-block; margin-top: 30px; background: #070D59; color: white; text-decoration: none; padding: 15px 40px; border-radius: 30px; font-weight: bold; transition: background 0.2s;" onmouseover="this.style.background='#F7B633'; this.style.color='#070D59'" onmouseout="this.style.background='#070D59'; this.style.color='white'">
                    Ir a la tienda
                </a>
            </div>
        @endif

    </div>
</div>
@endsection
