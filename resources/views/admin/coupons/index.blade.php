@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Gestión de Cupones</h1>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('admin.dashboard') }}" style="background: #eee; color: #333; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-weight: bold;">
                    Volver al Panel
                </a>
                <a href="{{ route('admin.coupons.create') }}" style="background: #070D59; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-weight: bold;">
                    + Nuevo Cupón
                </a>
            </div>
        </div>

        @if(session('success'))
            <div style="background: #2ecc71; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="background: #f8f9fa;">
                    <tr>
                        <th style="padding: 15px; border-bottom: 1px solid #eee; color: #777;">Código</th>
                        <th style="padding: 15px; border-bottom: 1px solid #eee; color: #777;">Tipo</th>
                        <th style="padding: 15px; border-bottom: 1px solid #eee; color: #777;">Valor</th>
                        <th style="padding: 15px; border-bottom: 1px solid #eee; color: #777;">Estado</th>
                        <th style="padding: 15px; border-bottom: 1px solid #eee; color: #777;">Expira</th>
                        <th style="padding: 15px; border-bottom: 1px solid #eee; color: #777; text-align: right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $coupon)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 15px; font-weight: bold; color: #070D59;">{{ $coupon->code }}</td>
                            <td style="padding: 15px; color: #555;">
                                {{ $coupon->type === 'fixed' ? 'Fijo (€)' : 'Porcentaje (%)' }}
                            </td>
                            <td style="padding: 15px; font-weight: bold;">
                                {{ $coupon->type === 'fixed' ? number_format($coupon->value, 2) . ' €' : $coupon->value . ' %' }}
                            </td>
                            <td style="padding: 15px;">
                                @if($coupon->isValid())
                                    <span style="background: #2ecc71; color: white; padding: 3px 8px; border-radius: 4px; font-size: 11px;">ACTIVO</span>
                                @else
                                    <span style="background: #e74c3c; color: white; padding: 3px 8px; border-radius: 4px; font-size: 11px;">INACTIVO</span>
                                @endif
                            </td>
                            <td style="padding: 15px; color: #777;">
                                {{ $coupon->expires_at ? $coupon->expires_at->format('d/m/Y') : 'Nunca' }}
                            </td>
                            <td style="padding: 15px; text-align: right;">
                                <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                    <a href="{{ route('admin.coupons.edit', $coupon->id) }}" style="color: #3498db; text-decoration: none; font-size: 14px;">Editar</a>
                                    <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar este cupón?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: #e74c3c; cursor: pointer; padding: 0; font-size: 14px;">Borrar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $coupons->links() }}
        </div>
    </div>
</div>
@endsection
