@extends('layouts.app', ['title' => 'Preguntas Frecuentes - Futiverso'])

@section('content')
<div class="container py-5" style="max-width: 800px; margin: 0 auto; padding: 40px 20px; font-family: 'Lexend', sans-serif;">
    <h1 style="color: #070D59; font-weight: 800; font-size: 2.5rem; margin-bottom: 1.5rem; border-bottom: 4px solid #F7B633; display: inline-block;">Preguntas Frecuentes</h1>
    
    <div style="margin-top: 2rem;">
        <div style="margin-bottom: 2rem; background: #f9f9f9; padding: 20px; border-radius: 10px; border-left: 5px solid #070D59;">
            <h3 style="color: #070D59; font-weight: 700; margin-bottom: 0.5rem;">¿Cuánto tarda en llegar mi pedido?</h3>
            <p style="color: #333; line-height: 1.6;">Los envíos nacionales suelen tardar entre 2 y 5 días laborables. Para envíos internacionales, el plazo puede variar entre 10 y 20 días dependiendo del país de destino.</p>
        </div>

        <div style="margin-bottom: 2rem; background: #f9f9f9; padding: 20px; border-radius: 10px; border-left: 5px solid #070D59;">
            <h3 style="color: #070D59; font-weight: 700; margin-bottom: 0.5rem;">¿Cómo puedo saber mi talla?</h3>
            <p style="color: #333; line-height: 1.6;">En cada página de producto encontrarás una guía de tallas detallada. Recomendamos medir una camiseta que ya tengas y compararla con nuestras medidas para asegurar el ajuste perfecto.</p>
        </div>

        <div style="margin-bottom: 2rem; background: #f9f9f9; padding: 20px; border-radius: 10px; border-left: 5px solid #070D59;">
            <h3 style="color: #070D59; font-weight: 700; margin-bottom: 0.5rem;">¿Puedo devolver un producto?</h3>
            <p style="color: #333; line-height: 1.6;">Sí, aceptamos devoluciones dentro de los 14 días posteriores a la recepción del pedido, siempre que el producto esté en su estado original y con las etiquetas puestas. Los productos personalizados no admiten devolución.</p>
        </div>

        <div style="margin-bottom: 2rem; background: #f9f9f9; padding: 20px; border-radius: 10px; border-left: 5px solid #070D59;">
            <h3 style="color: #070D59; font-weight: 700; margin-bottom: 0.5rem;">¿Qué métodos de pago aceptáis?</h3>
            <p style="color: #333; line-height: 1.6;">Aceptamos tarjetas de crédito/débito (Visa, Mastercard), PayPal, Apple Pay y Google Pay. Todos los pagos se procesan de forma segura.</p>
        </div>

        <div style="margin-bottom: 2rem; background: #f9f9f9; padding: 20px; border-radius: 10px; border-left: 5px solid #070D59;">
            <h3 style="color: #070D59; font-weight: 700; margin-bottom: 0.5rem;">¿Los productos son oficiales?</h3>
            <p style="color: #333; line-height: 1.6;">Ofrecemos tanto réplicas de alta calidad como productos oficiales. La descripción de cada producto especifica claramente su tipo y origen.</p>
        </div>
    </div>
</div>
@endsection
