@extends('layouts.app', ['title' => 'Envíos y Devoluciones - Futiverso'])

@section('content')
<div class="container py-5" style="max-width: 800px; margin: 0 auto; padding: 40px 20px; font-family: 'Lexend', sans-serif;">
    <h1 style="color: #070D59; font-weight: 800; font-size: 2.5rem; margin-bottom: 1.5rem; border-bottom: 4px solid #F7B633; display: inline-block;">Envíos y Devoluciones</h1>
    
    <div style="line-height: 1.8; color: #333; font-size: 1.1rem;">
        <h2 style="color: #070D59; font-weight: 700; margin-top: 2rem; margin-bottom: 1rem;">Información de Envío</h2>
        <p>Realizamos envíos a todo el mundo. A continuación detallamos los costes y tiempos estimados:</p>
        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem; margin-bottom: 2rem;">
            <thead>
                <tr style="background: #070D59; color: #fff; text-align: left;">
                    <th style="padding: 12px; border: 1px solid #ddd;">Región</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Coste</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Tiempo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 12px; border: 1px solid #ddd;">España (Península)</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">4,95€ (Gratis > 60€)</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">24-72h</td>
                </tr>
                <tr>
                    <td style="padding: 12px; border: 1px solid #ddd;">Europa</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">9,95€</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">5-10 días</td>
                </tr>
                <tr>
                    <td style="padding: 12px; border: 1px solid #ddd;">Resto del Mundo</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">14,95€</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">10-20 días</td>
                </tr>
            </tbody>
        </table>

        <h2 style="color: #070D59; font-weight: 700; margin-top: 2rem; margin-bottom: 1rem;">Política de Devoluciones</h2>
        <p>Si no estás satisfecho con tu compra, puedes solicitar una devolución siguiendo estas condiciones:</p>
        <ul style="margin-bottom: 1.5rem; padding-left: 1.5rem;">
            <li>Tienes un plazo de <strong>14 días naturales</strong> desde la recepción del pedido.</li>
            <li>El artículo debe estar sin usar, en las mismas condiciones en que lo recibiste y con su embalaje original.</li>
            <li>Los gastos de envío de la devolución corren a cargo del cliente, a menos que el producto sea defectuoso o hayamos cometido un error en el envío.</li>
        </ul>

        <h2 style="color: #070D59; font-weight: 700; margin-top: 2rem; margin-bottom: 1rem;">Cómo realizar una devolución</h2>
        <ol style="margin-bottom: 1.5rem; padding-left: 1.5rem;">
            <li>Contacta con nosotros a través de nuestro formulario de contacto o email indicando tu número de pedido.</li>
            <li>Te enviaremos las instrucciones para el envío del paquete.</li>
            <li>Una vez recibido y revisado el producto, procederemos al reembolso en un plazo de 5-7 días laborables.</li>
        </ol>
    </div>
</div>
@endsection
