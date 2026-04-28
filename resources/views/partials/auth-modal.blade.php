<!-- MODAL AUTH -->
<div class="auth-modal" id="authModal" aria-hidden="true">
    <div class="auth-card" role="dialog" aria-modal="true" aria-labelledby="authTitle">
        <button class="auth-close" id="closeAuth" type="button" aria-label="Cerrar">✕</button>

        <div class="auth-tabs">
            <button class="auth-tab active" data-tab="login" type="button">Login</button>
            <button class="auth-tab" data-tab="register" type="button">Registro</button>
        </div>

        <!-- LOGIN -->
        <form class="auth-form active" id="loginForm">
            <h2 id="authTitle">Bienvenido a Futiverso🔥</h2>

            <label>Email</label>
            <input type="email" name="email" placeholder="fulanito@correo.com" required>

            <label>Contraseña</label>
            <input type="password" name="password" placeholder="••••••••" required>

            <button class="auth-submit" type="submit">Entrar</button>

            <p class="auth-small">
                ¿Olvidaste tu contraseña? <a href="#" id="forgotLink">Recuperar</a>
            </p>
        </form>

        <!-- REGISTRO -->
        <form class="auth-form" id="registerForm">
            <h2>Crear cuenta</h2>

            <label>Nombre</label>
            <input type="text" name="name" placeholder="José Antonio" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="fulanito@correo.com" required>

            <label>Contraseña</label>
            <input type="password" name="password" placeholder="Mínimo 8 caracteres" minlength="8" required>

            <label>Repetir contraseña</label>
            <input type="password" name="password2" placeholder="Repite la contraseña" minlength="8" required>

            <button class="auth-submit" type="submit">Crear cuenta</button>
        </form>
    </div>
</div>