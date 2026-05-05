@guest
<!-- MODAL AUTH -->
<div class="auth-modal" id="authModal" aria-hidden="true">
    <div class="auth-card" role="dialog" aria-modal="true" aria-labelledby="authTitle">
        <button class="auth-close" id="closeAuth" type="button" aria-label="Cerrar">✕</button>

        <div class="auth-tabs">
            <button class="auth-tab active" data-tab="login" type="button">Login</button>
            <button class="auth-tab" data-tab="register" type="button">Registro</button>
        </div>

        <!-- LOGIN -->
        <form class="auth-form active" id="loginForm" method="POST" action="{{ route('login.post') }}" autocomplete="off">
            @csrf
            <h2 id="authTitle">Bienvenido a Futiverso🔥</h2>

            @if ($errors->any() && !$errors->has('name'))
                <div style="color: red; margin-bottom: 15px; font-size: 14px;">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <label>Email</label>
            <input type="email" name="email" placeholder="fulanito@correo.com" autocomplete="off" required>

            <label>Contraseña</label>
            <input type="password" name="password" placeholder="••••••••" autocomplete="new-password" required>

            <button class="auth-submit" type="submit">Entrar</button>

            <p class="auth-small">
                ¿Olvidaste tu contraseña? <a href="#" id="forgotLink">Recuperar</a>
            </p>
        </form>

        <!-- REGISTRO -->
        <form class="auth-form {{ old('name') || $errors->has('name') ? 'active' : '' }}" id="registerForm" method="POST" action="{{ route('register.post') }}" autocomplete="off">
            @csrf
            <h2>Crear cuenta</h2>

            @if ($errors->any() && (old('name') || $errors->has('name')))
                <div style="color: red; margin-bottom: 15px; font-size: 14px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <label>Nombre</label>
            <input type="text" name="name" placeholder="José Antonio" value="{{ old('name') }}" autocomplete="off" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="fulanito@correo.com" value="{{ old('email') }}" autocomplete="off" required>

            <label>Contraseña</label>
            <input type="password" name="password" placeholder="Mínimo 8 caracteres" minlength="8" autocomplete="new-password" required>

            <label>Repetir contraseña</label>
            <input type="password" name="password_confirmation" placeholder="Repite la contraseña" minlength="8" autocomplete="new-password" required>

            <button class="auth-submit" type="submit">Crear cuenta</button>
        </form>
    </div>
</div>

@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Automatically open the modal if there are login/register errors
        document.getElementById("authModal").classList.add("show");
        document.getElementById("authModal").setAttribute("aria-hidden", "false");

        // Si el error viene del formulario de registro (sabemos que intentaba registrarse porque hay 'old(name)' o error en 'name')
        @if(old('name') || $errors->has('name'))
            // Desactivamos la pestaña de login y activamos registro
            document.querySelector('.auth-tab[data-tab="login"]').classList.remove('active');
            document.getElementById('loginForm').classList.remove('active');
            
            document.querySelector('.auth-tab[data-tab="register"]').classList.add('active');
            document.getElementById('registerForm').classList.add('active');
        @endif
    });
</script>
@endif
@endguest