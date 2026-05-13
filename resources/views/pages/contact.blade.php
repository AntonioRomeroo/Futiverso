@extends('layouts.app', ['title' => 'Contacto - Futiverso'])

@section('content')
<div class="container py-5" style="max-width: 800px; margin: 0 auto; padding: 40px 20px; font-family: 'Lexend', sans-serif;">
    <h1 style="color: #070D59; font-weight: 800; font-size: 2.5rem; margin-bottom: 1.5rem; border-bottom: 4px solid #F7B633; display: inline-block;">Contacto</h1>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-top: 2rem;">
        <div>
            <h2 style="color: #070D59; font-weight: 700; font-size: 1.5rem; margin-bottom: 1rem;">¿Tienes alguna duda?</h2>
            <p style="color: #555; line-height: 1.6; margin-bottom: 2rem;">Estamos aquí para ayudarte. Rellena el formulario y te responderemos en menos de 24 horas laborables.</p>
            
            <div style="margin-bottom: 1rem; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-envelope" style="color: #F7B633; font-size: 1.2rem;"></i>
                <span style="color: #333;">soporte@futiverso.com</span>
            </div>
            <div style="margin-bottom: 1rem; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-phone" style="color: #F7B633; font-size: 1.2rem;"></i>
                <span style="color: #333;">+34 900 123 456</span>
            </div>
            <div style="margin-bottom: 1rem; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-location-dot" style="color: #F7B633; font-size: 1.2rem;"></i>
                <span style="color: #333;">Calle del Fútbol, 10, Madrid, España</span>
            </div>
        </div>

        <form style="background: #f9f9f9; padding: 25px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #070D59;">Nombre</label>
                <input type="text" placeholder="Tu nombre" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: 'Lexend', sans-serif;">
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #070D59;">Email</label>
                <input type="email" placeholder="tu@email.com" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: 'Lexend', sans-serif;">
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #070D59;">Mensaje</label>
                <textarea rows="4" placeholder="¿En qué podemos ayudarte?" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: 'Lexend', sans-serif; resize: none;"></textarea>
            </div>
            <button type="button" style="background: #070D59; color: #fff; border: none; padding: 12px 25px; border-radius: 8px; font-weight: 700; cursor: pointer; width: 100%; transition: background 0.3s;">Enviar mensaje</button>
        </form>
    </div>
</div>
@endsection
