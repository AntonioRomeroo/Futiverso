<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Futiverso' }}</title>

    <link rel="icon" href="{{ asset('Imagenes/favicon_prueba2.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Lexend:wght@100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('CSS/estilos_prueba.css') }}">
    @stack('styles')
</head>

<body>

    @include('partials.header')
    @include('partials.auth-modal')
    @include('partials.nav')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="{{ asset('JS/carruseles.js') }}" defer></script>
    <script src="{{ asset('JS/auth.js') }}" defer></script>
    @stack('scripts')
</body>

</html>