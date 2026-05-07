@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Gestión de Pedidos</h1>
            <a href="{{ route('admin.dashboard') }}" style="color: #777; text-decoration: none; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Volver al Panel
            </a>
        </div>

        @if(session('success'))
            <div style="background: #2ecc71; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="background: #f8f9fa; border-bottom: 2px solid #eee;">
                    <tr>
                        <th style="padding: 15px; color: #555;">Nº Pedido</th>
                        <th style="padding: 15px; color: #555;">Usuario</th>
                        <th style="padding: 15px; color: #555;">Fecha</th>
                        <th style="padding: 15px; color: #555;">Total</th>
                        <th style="padding: 15px; color: #555;">Estado</th>
                        <th style="padding: 15px; color: #555; text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 15px; font-weight: bold; color: #070D59;">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td style="padding: 15px; color: #555;">{{ $order->user->name }}</td>
                            <td style="padding: 15px; color: #777;">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td style="padding: 15px; font-weight: bold; color: #070D59;">{{ number_format($order->total, 2) }}€</td>
                            <td style="padding: 15px;">
                                @php
                                    $statusColors = [
                                        'Pendiente' => ['bg' => '#f1c40f', 'text' => '#000'],
                                        'Aceptado' => ['bg' => '#3498db', 'text' => '#fff'],
                                        'Embalado' => ['bg' => '#9b59b6', 'text' => '#fff'],
                                        'En camino' => ['bg' => '#e67e22', 'text' => '#fff'],
                                        'Entregado' => ['bg' => '#2ecc71', 'text' => '#fff'],
                                        'Cancelado' => ['bg' => '#e74c3c', 'text' => '#fff'],
                                    ];
                                    $color = $statusColors[$order->status] ?? ['bg' => '#7f8c8d', 'text' => '#fff'];
                                @endphp
                                <span style="background: {{ $color['bg'] }}; color: {{ $color['text'] }}; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase;">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="{{ route('admin.orders.show', $order->id) }}" style="color: #070D59; margin-right: 15px; text-decoration: none;" title="Ver Detalles">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Eliminar pedido?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: #e74c3c; cursor: pointer; padding: 0;" title="Eliminar">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 30px; text-align: center; color: #777;">
                                <i class="fa-solid fa-box-open" style="font-size: 40px; color: #ccc; margin-bottom: 10px; display: block;"></i>
                                No hay pedidos registrados todavía.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
