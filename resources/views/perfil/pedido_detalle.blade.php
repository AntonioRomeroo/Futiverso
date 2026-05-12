@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content" style="padding-top: 40px; padding-bottom: 60px;">
        
        <div style="border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Detalle de Pedido #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h1>
            <a href="{{ route('perfil.pedidos') }}" style="color: #777; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Volver a mis pedidos
            </a>
        </div>

        <div class="responsive-grid-checkout">
            
            {{-- Lista de Productos --}}
            <div>
                <div style="background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 30px;">
                    <div class="table-responsive">
                        <table style="width: 100%; border-collapse: collapse; text-align: left;">
                            <thead style="background: #f8f9fa;">
                                <tr>
                                    <th style="padding: 20px; color: #777; font-size: 14px; text-transform: uppercase;">Producto</th>
                                    <th style="padding: 20px; color: #777; font-size: 14px; text-transform: uppercase; text-align: center;">Cantidad</th>
                                    <th style="padding: 20px; color: #777; font-size: 14px; text-transform: uppercase; text-align: right;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <td style="padding: 20px;">
                                            <div style="display: flex; align-items: center; gap: 15px;">
                                                <div style="width: 50px; height: 50px; background: #f9f9f9; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                                    @if($item->product->imagen_url)
                                                        <img src="{{ str_starts_with($item->product->imagen_url, 'http') ? $item->product->imagen_url : asset('storage/' . $item->product->imagen_url) }}" style="width: 100%; height: 100%; object-fit: contain;">
                                                    @else
                                                        <i class="fa-solid fa-shirt" style="color: #ddd;"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div style="font-weight: bold; color: #070D59;">{{ $item->product->nombre }}</div>
                                                    <div style="font-size: 12px; color: #777;">Talla: {{ $item->talla }}</div>
                                                    @if($item->custom_name || $item->custom_number)
                                                        <div style="font-size: 11px; color: #F7B633; font-weight: bold;">
                                                            <i class="fa-solid fa-pen-nib"></i> {{ $item->custom_name }} #{{ $item->custom_number }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 20px; text-align: center; font-weight: bold; color: #555;">
                                            {{ $item->quantity }}
                                        </td>
                                        <td style="padding: 20px; text-align: right; font-weight: bold; color: #070D59;">
                                            {{ number_format($item->price * $item->quantity, 2) }} €
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot style="background: #f8f9fa;">
                                <tr>
                                    <td colspan="2" style="padding: 20px; text-align: right; font-weight: bold; color: #777;">TOTAL</td>
                                    <td style="padding: 20px; text-align: right; font-size: 22px; font-weight: bold; color: #F7B633;">
                                        {{ number_format($order->total, 2) }} €
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Información del Envío y Estado --}}
            <div>
                <div style="background: #070D59; color: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(7, 13, 89, 0.2);">
                    <h3 style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px;">Estado del Pedido</h3>
                    
                    <div style="display: flex; align-items: center; gap: 15px; margin: 20px 0;">
                        <div style="width: 45px; height: 45px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <div>
                            <div style="font-size: 14px; opacity: 0.7;">Estado actual</div>
                            <div style="font-size: 18px; font-weight: bold; color: #F7B633;">{{ $order->status }}</div>
                        </div>
                    </div>

                    <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; margin-top: 20px;">
                        <h4 style="margin-top: 0; margin-bottom: 15px;"><i class="fa-solid fa-truck" style="color: #F7B633;"></i> Dirección de Envío</h4>
                        <p style="margin: 0; font-size: 15px; opacity: 0.9; line-height: 1.6;">
                            {{ $order->address }}
                        </p>
                        <p style="margin-top: 10px; font-size: 15px; opacity: 0.9;">
                            <i class="fa-solid fa-phone" style="font-size: 12px;"></i> {{ $order->phone }}
                        </p>
                    </div>

                    @if($order->notes)
                        <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; margin-top: 20px;">
                            <h4 style="margin-top: 0; margin-bottom: 10px;"><i class="fa-solid fa-comment" style="color: #F7B633;"></i> Notas</h4>
                            <p style="margin: 0; font-size: 14px; font-style: italic; opacity: 0.8;">
                                "{{ $order->notes }}"
                            </p>
                        </div>
                    @endif

                    <div style="margin-top: 30px; background: rgba(255,255,255,0.05); padding: 15px; border-radius: 10px; text-align: center; font-size: 13px;">
                        Realizado el {{ $order->created_at->format('d/m/Y') }} a las {{ $order->created_at->format('H:i') }}
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
