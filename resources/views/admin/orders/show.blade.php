@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Detalles del Pedido #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h1>
            <a href="{{ route('admin.orders.index') }}" style="color: #777; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Volver a la Lista
            </a>
        </div>

        @if(session('success'))
            <div style="background: #2ecc71; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
            
            {{-- Columna Izquierda: Productos --}}
            <div>
                <div style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 30px;">
                    <div style="padding: 15px 20px; background: #f8f9fa; border-bottom: 1px solid #eee; font-weight: bold; color: #070D59;">
                        Productos en el pedido
                    </div>
                    <table style="width: 100%; border-collapse: collapse; text-align: left;">
                        <thead>
                            <tr style="border-bottom: 1px solid #eee;">
                                <th style="padding: 15px; color: #777;">Producto</th>
                                <th style="padding: 15px; color: #777; text-align: center;">Cantidad</th>
                                <th style="padding: 15px; color: #777; text-align: right;">Precio Unit.</th>
                                <th style="padding: 15px; color: #777; text-align: right;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr style="border-bottom: 1px solid #eee;">
                                    <td style="padding: 15px;">
                                        <div style="display: flex; align-items: center; gap: 15px;">
                                            <img src="{{ asset('storage/' . $item->product->imagen) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                            <div>
                                                <div style="font-weight: bold; color: #070D59;">{{ $item->product->nombre }}</div>
                                                <div style="font-size: 12px; color: #999;">Talla: {{ $item->talla }} | Ref: #{{ $item->product->id }}</div>
                                                @if($item->custom_name || $item->custom_number)
                                                    <div style="font-size: 11px; color: #F7B633; font-weight: bold;">
                                                        <i class="fa-solid fa-pen-nib"></i> {{ $item->custom_name }} #{{ $item->custom_number }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding: 15px; text-align: center;">{{ $item->quantity }}</td>
                                    <td style="padding: 15px; text-align: right;">{{ number_format($item->price, 2) }}€</td>
                                    <td style="padding: 15px; text-align: right; font-weight: bold;">{{ number_format($item->quantity * $item->price, 2) }}€</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" style="padding: 20px; text-align: right; font-size: 18px; color: #777;">Total del Pedido:</td>
                                <td style="padding: 20px; text-align: right; font-size: 24px; font-weight: bold; color: #070D59;">{{ number_format($order->total, 2) }}€</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                @if($order->notes)
                    <div style="background: #fff9e6; padding: 20px; border-radius: 10px; border-left: 5px solid #F7B633; color: #856404;">
                        <strong>Notas del pedido:</strong><br>
                        {{ $order->notes }}
                    </div>
                @endif
            </div>

            {{-- Columna Derecha: Estado y Cliente --}}
            <div>
                {{-- Gestionar Estado --}}
                <div style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); padding: 20px; margin-bottom: 30px;">
                    <h3 style="color: #070D59; margin-top: 0; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Administrar Estado</h3>
                    
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; font-size: 12px; color: #777; margin-bottom: 5px; text-transform: uppercase;">Estado Actual</label>
                            <select name="status" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-weight: bold; background: #f8f9fa;">
                                @foreach(['Pendiente', 'Aceptado', 'Embalado', 'En camino', 'Entregado', 'Cancelado'] as $st)
                                    <option value="{{ $st }}" {{ $order->status == $st ? 'selected' : '' }}>{{ $st }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" style="width: 100%; background: #070D59; color: white; border: none; padding: 12px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                            Actualizar Estado
                        </button>
                    </form>
                </div>

                {{-- Datos del Cliente --}}
                <div style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); padding: 20px;">
                    <h3 style="color: #070D59; margin-top: 0; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Datos del Cliente</h3>
                    
                    <div style="margin-bottom: 15px;">
                        <span style="display: block; font-size: 12px; color: #999; text-transform: uppercase;">Cliente</span>
                        <strong style="color: #070D59;">{{ $order->user->name }}</strong>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <span style="display: block; font-size: 12px; color: #999; text-transform: uppercase;">Email</span>
                        <span style="color: #555;">{{ $order->user->email }}</span>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <span style="display: block; font-size: 12px; color: #999; text-transform: uppercase;">Dirección de Envío</span>
                        <span style="color: #555;">{{ $order->address ?? 'No especificada' }}</span>
                    </div>

                    <div style="margin-bottom: 0;">
                        <span style="display: block; font-size: 12px; color: #999; text-transform: uppercase;">Teléfono</span>
                        <span style="color: #555;">{{ $order->phone ?? 'No especificado' }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
