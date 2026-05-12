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
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display: flex; gap: 5px; align-items: center;">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" style="padding: 5px; border-radius: 5px; border: 1px solid #ddd; font-size: 12px; font-weight: bold; color: #070D59;">
                                        @foreach(['Pendiente', 'Aceptado', 'Embalado', 'En camino', 'Entregado', 'Cancelado'] as $st)
                                            <option value="{{ $st }}" {{ $order->status == $st ? 'selected' : '' }}>{{ $st }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <div style="display: flex; gap: 10px; justify-content: center; align-items: center;">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" style="color: #070D59; text-decoration: none; background: #eee; padding: 5px 8px; border-radius: 4px;" title="Ver Detalles">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    
                                    @if($order->status !== 'Cancelado')
                                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="Cancelado">
                                            <button type="submit" style="background: #e67e22; color: white; border: none; padding: 5px 8px; border-radius: 4px; cursor: pointer;" title="Anular/Cancelar Pedido" onclick="return confirm('¿Seguro que quieres cancelar este pedido?')">
                                                <i class="fa-solid fa-ban"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('¿Eliminar pedido permanentemente de la base de datos?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: #e74c3c; color: white; border: none; padding: 5px 8px; border-radius: 4px; cursor: pointer;" title="Eliminar Registro">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
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
