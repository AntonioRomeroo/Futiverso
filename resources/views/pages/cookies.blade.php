@extends('layouts.app', ['title' => 'Política de Cookies - Futiverso'])

@section('content')
<div class="container py-5" style="max-width: 800px; margin: 0 auto; padding: 40px 20px; font-family: 'Lexend', sans-serif;">
    <h1 style="color: #070D59; font-weight: 800; font-size: 2.5rem; margin-bottom: 1.5rem; border-bottom: 4px solid #F7B633; display: inline-block;">Política de Cookies</h1>
    
    <div style="line-height: 1.8; color: #333; font-size: 1rem;">
        <p>Este sitio web utiliza cookies para mejorar la experiencia del usuario y garantizar el funcionamiento correcto de la tienda.</p>

        <h2 style="color: #070D59; font-weight: 700; margin-top: 2rem; margin-bottom: 1rem;">¿Qué son las cookies?</h2>
        <p>Las cookies son pequeños archivos de texto que se almacenan en tu dispositivo cuando visitas un sitio web. Ayudan al sitio a recordar información sobre tu visita, como tu idioma preferido y otros ajustes.</p>

        <h2 style="color: #070D59; font-weight: 700; margin-top: 2rem; margin-bottom: 1rem;">Cookies que utilizamos</h2>
        <ul style="padding-left: 1.5rem;">
            <li><strong>Cookies técnicas:</strong> Necesarias para el funcionamiento del carrito de compra y el inicio de sesión.</li>
            <li><strong>Cookies de análisis:</strong> Nos permiten entender cómo los visitantes interactúan con la web para mejorar nuestros servicios.</li>
            <li><strong>Cookies de marketing:</strong> Utilizadas para mostrar anuncios relevantes según tus intereses.</li>
        </ul>

        <h2 style="color: #070D59; font-weight: 700; margin-top: 2rem; margin-bottom: 1rem;">Cómo gestionar las cookies</h2>
        <p>Puedes configurar tu navegador para rechazar todas las cookies o para que te avise cuando se envíe una cookie. Sin embargo, si desactivas las cookies, es posible que algunas funciones de <strong>Futiverso</strong> no funcionen correctamente (como el carrito de compra).</p>

        <p style="margin-top: 2rem; font-size: 0.9rem; color: #777;">Al navegar por nuestro sitio, aceptas el uso de cookies de acuerdo con esta política.</p>
    </div>
</div>
@endsection
