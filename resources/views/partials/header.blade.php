<header class="top">
    <div class="top-grid">
        <div class="logo">
            <a href="{{ route('inicio') }}">
                <img src="{{ asset('Imagenes/prueba_con_este.png') }}" alt="Futiverso logo">
            </a>
        </div>

        <div class="search">
            <input type="search" placeholder="(EJ: 'Camiseta España')">
        </div>

        @guest
            <button class="btn-login" id="openAuth" type="button">Iniciar sesión</button>
        @endguest

        @auth
            <div class="user-menu-container" style="position: relative; display: inline-block; justify-self: end; margin-right: 25px;">
                <button id="userMenuBtn" type="button" style="background: none; border: 2px solid #F7B633; border-radius: 50%; padding: 2px; cursor: pointer; display: flex; align-items: center; justify-content: center; width: 45px; height: 45px; overflow: hidden; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                    @else
                        <svg viewBox="0 0 24 24" fill="#070D59" style="width: 100%; height: 100%;"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    @endif
                </button>
                
                <!-- Menú Desplegable -->
                <div id="userDropdown" class="user-dropdown" style="display: none; position: absolute; right: 0; top: 60px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; box-shadow: 0 10px 25px rgba(7, 13, 89, 0.15); width: 220px; z-index: 1000; overflow: hidden; animation: dropdownFade 0.2s ease;">
                    <style>
                        @keyframes dropdownFade {
                            from { opacity: 0; transform: translateY(-10px); }
                            to { opacity: 1; transform: translateY(0); }
                        }
                        .dropdown-item {
                            display: block;
                            padding: 12px 20px;
                            color: #070D59;
                            text-decoration: none;
                            font-weight: 500;
                            font-size: 14px;
                            transition: background 0.2s ease;
                            border-bottom: 1px solid #f0f2f5;
                            text-align: left;
                        }
                        .dropdown-item:hover {
                            background: #f8f9fa;
                            color: #F7B633;
                        }
                        .dropdown-header {
                            padding: 15px 20px;
                            background: linear-gradient(135deg, #070D59 0%, #1a237e 100%);
                            color: white;
                            font-weight: 700;
                            font-size: 15px;
                            text-align: left;
                            border-bottom: 3px solid #F7B633;
                        }
                    </style>
                    <div class="dropdown-header">
                        👋 ¡Hola, {{ explode(' ', Auth::user()->name)[0] }}!
                    </div>
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item">⚙️ Panel de Control</a>
                    @endif
                    <a href="{{ route('perfil') }}" class="dropdown-item">👤 Mi Perfil</a>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="dropdown-item" style="width: 100%; border: none; background: none; color: #dc3545; cursor: pointer; text-align: left;">🚪 Cerrar sesión</button>
                    </form>
                </div>
            </div>

            <script>
                // Script para abrir/cerrar el menú
                document.getElementById('userMenuBtn').addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdown = document.getElementById('userDropdown');
                    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
                });

                // Cerrar si se hace click fuera
                document.addEventListener('click', function() {
                    document.getElementById('userDropdown').style.display = 'none';
                });
            </script>
        @endauth
    </div>
</header>