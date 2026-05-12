@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content" style="padding-top: 40px; padding-bottom: 60px;">
        
        <div style="border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Mis Pedidos</h1>
            <a href="{{ route('perfil') }}" style="color: #777; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-user"></i> Volver a mi perfil
            </a>
        </div>

        @if($orders->count() > 0)
            <div style="background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden;">
                <div class="table-responsive">
                    <table style="width: 100%; border-collapse: collapse; text-align: left;">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th style="padding: 20px; color: #777; font-size: 14px; text-transform: uppercase;">ID Pedido</th>
                                <th style="padding: 20px; color: #777; font-size: 14px; text-transform: uppercase;">Fecha</th>
                                <th style="padding: 20px; color: #777; font-size: 14px; text-transform: uppercase;">Estado</th>
                                <th style="padding: 20px; color: #777; font-size: 14px; text-transform: uppercase;">Total</th>
                                <th style="padding: 20px; color: #777; font-size: 14px; text-transform: uppercase; text-align: right;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr style="border-bottom: 1px solid #eee; transition: background 0.2s;" onmouseover="this.style.background='#fcfcfc'" onmouseout="this.style.background='white'">
                                    <td style="padding: 20px; font-weight: bold; color: #070D59;">
                                        #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td style="padding: 20px; color: #555;">
                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td style="padding: 20px;">
                                        @php
                                            $color = match($order->status) {
                                                'Pendiente' => '#f39c12',
                                                'Aceptado', 'Embalado' => '#3498db',
                                                'En camino' => '#9b59b6',
                                                'Entregado' => '#2ecc71',
                                                'Cancelado' => '#e74c3c',
                                                default => '#777'
                                            };
                                        @endphp
                                        <span style="background: {{ $color }}; color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase;">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td style="padding: 20px; font-weight: bold; color: #070D59;">
                                        {{ number_format($order->total, 2) }} €
                                    </td>
                                    <td style="padding: 20px; text-align: right;">
                                        <a href="{{ route('perfil.pedido_detalle', $order->id) }}" style="display: inline-block; background: #070D59; color: white; text-decoration: none; padding: 8px 15px; border-radius: 8px; font-size: 13px; font-weight: bold; transition: all 0.2s;" onmouseover="this.style.background='#F7B633'; this.style.color='#070D59'" onmouseout="this.style.background='#070D59'; this.style.color='white'">
                                            Ver detalles <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div style="margin-top: 30px;">
                {{ $orders->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 80px 20px; background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                <i class="fa-solid fa-box-open" style="font-size: 60px; color: #eee; margin-bottom: 20px;"></i>
                <h2 style="color: #070D59;">Aún no tienes pedidos</h2>
                <p style="color: #777; font-size: 18px;">Tus compras aparecerán aquí una vez que realices tu primer pedido.</p>
                <a href="{{ route('inicio') }}" style="display: inline-block; margin-top: 30px; background: #070D59; color: white; text-decoration: none; padding: 15px 40px; border-radius: 30px; font-weight: bold; transition: background 0.2s;" onmouseover="this.style.background='#F7B633'; this.style.color='#070D59'" onmouseout="this.style.background='#070D59'; this.style.color='white'">
                    Ir a la tienda
                </a>
            </div>
        @endif

    </div>
</div>
@endsection
