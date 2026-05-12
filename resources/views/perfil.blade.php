@extends('layouts.app')

@section('title', 'Mi Perfil - Futiverso')

@section('content')
<style>
    .profile-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        padding: 40px 20px;
    }

    .profile-card {
        background: #ffffff;
        width: 100%;
        max-width: 500px;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(7, 13, 89, 0.08);
        padding: 40px;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-5px);
    }

    /* Franja decorativa superior */
    .profile-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, #070D59, #F7B633);
    }

    .profile-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .profile-header h2 {
        color: #070D59;
        font-size: 28px;
        font-weight: 800;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .profile-header p {
        color: #666;
        font-size: 14px;
        margin-top: 5px;
    }

    .avatar-upload-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 30px;
        position: relative;
    }

    .avatar-preview {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        border: 4px solid #F7B633;
        padding: 4px;
        background: #fff;
        box-shadow: 0 8px 16px rgba(247, 182, 51, 0.2);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .avatar-preview img, .avatar-preview svg {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .avatar-upload-btn {
        margin-top: 15px;
        background: #f0f2f5;
        color: #070D59;
        font-size: 13px;
        font-weight: 700;
        padding: 8px 20px;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid #e1e4e8;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .avatar-upload-btn:hover {
        background: #070D59;
        color: #fff;
        border-color: #070D59;
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    .form-group label {
        display: block;
        color: #070D59;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e1e4e8;
        border-radius: 10px;
        font-size: 15px;
        color: #333;
        transition: all 0.3s ease;
        background: #fafbfc;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #F7B633;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(247, 182, 51, 0.1);
    }

    .form-control:disabled {
        background: #f3f4f6;
        color: #888;
        cursor: not-allowed;
        border-color: #e5e7eb;
    }

    .btn-save {
        width: 100%;
        background: #070D59;
        color: #fff;
        font-weight: 700;
        font-size: 16px;
        padding: 16px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .btn-save:hover {
        background: #F7B633;
        color: #070D59;
        box-shadow: 0 8px 20px rgba(247, 182, 51, 0.3);
        transform: translateY(-2px);
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 25px;
        border-left: 5px solid #28a745;
        font-size: 14px;
        font-weight: 500;
        animation: slideIn 0.5s ease;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="profile-wrapper">
    <div class="profile-card">
        <div class="profile-header">
            <h2>Mi Perfil</h2>
            <p>Gestiona tu información personal y foto de avatar</p>
        </div>

        @if(session('success'))
            <div class="alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 25px; border-left: 5px solid #f5c6cb; font-size: 14px;">
                ❌ {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="avatar-upload-container">
                <div class="avatar-preview">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar de {{ $user->name }}">
                    @else
                        <!-- Icono genérico más premium -->
                        <svg viewBox="0 0 24 24" fill="#070D59" opacity="0.8">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    @endif
                </div>
                
                <label class="avatar-upload-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                    Subir nueva foto
                    <input type="file" name="avatar" accept="image/*" style="display: none;" onchange="previewImage(this)">
                </label>
            </div>

            <div class="form-group">
                <label>Nombre de Usuario</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required placeholder="¿Cómo quieres que te llamemos?">
            </div>

            <div class="form-group">
                <label>Correo Electrónico <span style="font-weight:normal; color:#888; font-size:12px;">(No modificable)</span></label>
                <input type="email" class="form-control" value="{{ $user->email }}" disabled>
            </div>

            <button type="submit" class="btn-save">
                Guardar Cambios
            </button>

            <a href="{{ route('perfil.pedidos') }}" style="display: flex; justify-content: center; align-items: center; gap: 8px; margin-top: 15px; color: #070D59; text-decoration: none; font-weight: 700; font-size: 14px; padding: 12px; border: 2px solid #070D59; border-radius: 10px; transition: all 0.3s ease;" onmouseover="this.style.background='#070D59'; this.style.color='white'" onmouseout="this.style.background='transparent'; this.style.color='#070D59'">
                <i class="fa-solid fa-box"></i> Ver mis pedidos
            </a>
        </form>
    </div>
</div>

<script>
    // Pequeño script para previsualizar la imagen antes de subirla
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.querySelector('.avatar-preview');
                previewContainer.innerHTML = '<img src="' + e.target.result + '" alt="Nueva foto">';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
