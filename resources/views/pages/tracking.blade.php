@extends('layouts.app', ['title' => 'Seguimiento de Pedido - Futiverso'])

@section('content')
<div class="container py-5" style="max-width: 800px; margin: 0 auto; padding: 40px 20px; font-family: 'Lexend', sans-serif;">
    <h1 style="color: #070D59; font-weight: 800; font-size: 2.5rem; margin-bottom: 1.5rem; border-bottom: 4px solid #F7B633; display: inline-block;">Seguimiento de Pedido</h1>
    
    <div style="background: #f9f9f9; padding: 40px; border-radius: 20px; text-align: center; margin-top: 2rem;">
        <i class="fas fa-truck-fast" style="font-size: 4rem; color: #070D59; margin-bottom: 1.5rem;"></i>
        <h2 style="color: #070D59; font-weight: 700; margin-bottom: 1rem;">¿Dónde está mi paquete?</h2>
        <p style="color: #555; line-height: 1.6; margin-bottom: 2rem;">Introduce tu número de seguimiento para conocer el estado actual de tu pedido.</p>
        
        <div style="max-width: 400px; margin: 0 auto; display: flex; gap: 10px;">
            <input type="text" placeholder="Ej: FV-12345678" style="flex: 1; padding: 12px; border: 2px solid #070D59; border-radius: 8px; font-family: 'Lexend', sans-serif; outline: none;">
            <button style="background: #070D59; color: #fff; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 700; cursor: pointer;">Rastrear</button>
        </div>
        
        <div style="margin-top: 3rem; text-align: left; background: #fff; padding: 25px; border-radius: 15px; border: 1px solid #eee;">
            <h3 style="color: #070D59; font-weight: 700; font-size: 1.1rem; margin-bottom: 1rem;">Información útil:</h3>
            <ul style="color: #666; font-size: 0.95rem; padding-left: 1.2rem;">
                <li style="margin-bottom: 0.8rem;">Recibirás tu número de seguimiento por email en cuanto el pedido salga de nuestro almacén.</li>
                <li style="margin-bottom: 0.8rem;">Si acabas de realizar el pedido, ten en cuenta que el procesamiento puede tardar de 24 a 48 horas.</li>
                <li style="margin-bottom: 0.8rem;">Trabajamos con Correos Express, SEUR y DHL.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
