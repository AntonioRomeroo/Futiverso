@extends('layouts.app')

@section('content')
<div class="wrap">
    <div class="content">
        <div style="border-bottom: 3px solid #F7B633; padding-bottom: 10px; margin-bottom: 30px;">
            <h1 style="text-transform: uppercase; color: #070D59; margin: 0;">Nuevo Cupón</h1>
        </div>

        <div style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); padding: 30px; max-width: 600px; margin: 0 auto;">
            <form action="{{ route('admin.coupons.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #555;">Código del Cupón</label>
                    <input type="text" name="code" value="{{ old('code') }}" required placeholder="EJ: PROMO2026" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                    @error('code') <small style="color: #e74c3c;">{{ $message }}</small> @enderror
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #555;">Tipo de Descuento</label>
                        <select name="type" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                            <option value="fixed">Fijo (€)</option>
                            <option value="percent">Porcentaje (%)</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #555;">Valor</label>
                        <input type="number" step="0.01" name="value" value="{{ old('value') }}" required placeholder="10.00" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                        @error('value') <small style="color: #e74c3c;">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #555;">Fecha de Expiración (Opcional)</label>
                    <input type="date" name="expires_at" value="{{ old('expires_at') }}" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
                    @error('expires_at') <small style="color: #e74c3c;">{{ $message }}</small> @enderror
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="checkbox" name="is_active" value="1" checked style="width: 18px; height: 18px;">
                        <span style="font-weight: bold; color: #555;">Cupón Activo</span>
                    </label>
                </div>

                <div style="display: flex; gap: 15px;">
                    <button type="submit" style="flex: 1; background: #070D59; color: white; border: none; padding: 15px; border-radius: 5px; font-weight: bold; cursor: pointer;">
                        Crear Cupón
                    </button>
                    <a href="{{ route('admin.coupons.index') }}" style="flex: 1; background: #eee; color: #333; text-decoration: none; padding: 15px; border-radius: 5px; font-weight: bold; text-align: center;">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
