@extends('layouts.app')

@section('content')
    <div class="wrap">
        <div class="content">
            <h1 style="text-transform: uppercase; color: #070D59; border-bottom: 3px solid #F7B633; display: inline-block; padding-bottom: 10px; margin-bottom: 20px;">
                {{ $titulo }}
            </h1>
            
            <p style="font-size: 18px; color: #555; line-height: 1.6; max-width: 800px;">
                {{ $descripcion }}
            </p>

            <div style="margin-top: 50px; padding: 40px; background: #fff; border-radius: 20px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                <i class="fa-solid fa-shirt" style="font-size: 50px; color: #ededed; margin-bottom: 20px;"></i>
                <h3 style="color: #999;">Cargando catálogo de {{ $titulo }}...</h3>
                <p style="color: #bbb;">Estamos actualizando el stock para la temporada 25/26.</p>
            </div>
        </div>
    </div>
@endsection
