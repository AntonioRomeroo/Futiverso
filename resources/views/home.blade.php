@extends('layouts.app')

@section('content')
    <div class="wrap">
        <div class="content">

            <section class="car-grid">

                <article class="sq" data-sqcarousel data-interval="2800">
                    <a class="sq-cardlink" href="{{ route('novedades') }}">
                        <div class="sq-viewport">
                            <div class="sq-track">
                                <img src="{{ asset('Imagenes/Camisetas Carrusel/camiseta_españa_mundial_2026.png') }}" alt="España Mundial 2026">
                                <img src="{{ asset('Imagenes/Camisetas Carrusel/camiseta_senegal_copa_africa_2026.png') }}" alt="Senegal Copa África 2026">
                                <img src="{{ asset('Imagenes/Camisetas Carrusel/camiseta_villarreal_25-26.png') }}" alt="Villarreal 25-26">
                            </div>
                        </div>
                        <h2 class="sq-title">NOVEDADES!!!</h2>
                    </a>
                </article>

                <article class="sq" data-sqcarousel data-interval="3200">
                    <a class="sq-cardlink" href="{{ route('novedades') }}">
                        <div class="sq-viewport">
                            <div class="sq-track">
                                <img src="{{ asset('Imagenes/Camisetas Carrusel/camiseta_antequera.png') }}" alt="Camiseta Antequera">
                                <img src="{{ asset('Imagenes/Camisetas Carrusel/camiseta_real_madrid_25-26.png') }}" alt="Camiseta Real Madrid 25-26">
                                <img src="{{ asset('Imagenes/Camisetas Carrusel/camiseta_espanyol_25-26.png') }}" alt="Camiseta Espanyol 25-26">
                            </div>
                        </div>
                        <h2 class="sq-title">MÁS VENDIDO!!!</h2>
                    </a>
                </article>

                <article class="sq" data-sqcarousel data-interval="3600">
                    <a class="sq-cardlink" href="{{ route('ofertas') }}">
                        <div class="sq-viewport">
                            <div class="sq-track">
                                <img src="{{ asset('Imagenes/Camisetas Carrusel/camiseta_barça_25-26.png') }}" alt="Camiseta Barça 25-26">
                                <img src="{{ asset('Imagenes/Camisetas Carrusel/camiseta_atletico_de_madrid_25-26.png') }}" alt="Camiseta Atlético de Madrid 25-26">
                                <img src="{{ asset('Imagenes/Camisetas Carrusel/camiseta_getafe_25-26.png') }}" alt="Camiseta Getafe 25-26">
                            </div>
                        </div>
                        <h2 class="sq-title">OFERTAS!!!</h2>
                    </a>
                </article>

                <article class="sq" data-sqcarousel data-interval="4000">
                    <a class="sq-cardlink" href="#">
                        <div class="sq-viewport">
                            <div class="sq-track">
                                <img src="{{ asset('Imagenes/Camisetas Carrusel/no_hay_sorteos.png') }}" alt="No hay sorteos">
                                <img src="{{ asset('Imagenes/Camisetas Carrusel/no_hay_sorteos.png') }}" alt="No hay sorteos">
                                <img src="{{ asset('Imagenes/Camisetas Carrusel/no_hay_sorteos.png') }}" alt="No hay sorteos">
                            </div>
                        </div>
                        <h2 class="sq-title">SORTEOS!!!</h2>
                    </a>
                </article>

            </section>

        </div>
    </div>
@endsection