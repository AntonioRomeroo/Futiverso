# Futiverso 

Futiverso es una plataforma de comercio electrónico especializada en la venta de equipaciones de fútbol exclusivas, camisetas retro y artículos deportivos para apasionados del deporte rey. Este proyecto ha sido desarrollado como una aplicación web moderna y robusta utilizando el framework Laravel.

##  Funcionalidades Principales

### Para Usuarios (Clientes)
- **Catálogo Dinámico:** Navegación por categorías (Ligas, Retro, Botas, Bufandas).
- **Personalización de Productos:** Opción de añadir nombre y número a las camisetas.
- **Carrito de Compra:** Gestión intuitiva de productos con validación de stock.
- **Sistema de Cupones:** Aplicación de códigos de descuento en tiempo real.
- **Lista de Deseos (Wishlist):** Guardado de productos favoritos mediante iconos de corazón.
- **Historial de Pedidos:** Panel de usuario para consultar compras realizadas y estados de envío.
- **Perfil de Usuario:** Personalización de datos y subida de imagen de perfil (Avatar).
- **Buscador Inteligente:** Búsqueda rápida de productos por nombre o descripción.

### Para Administradores (Backoffice)
- **Dashboard de Estadísticas:** Resumen visual de productos, categorías y ventas.
- **Gestión de Inventario (CRUD):** Creación, edición y borrado de productos y categorías.
- **Gestión de Pedidos:** Control total sobre los estados de los pedidos (Aceptado, Enviado, Cancelado, etc.).
- **Gestión de Cupones:** Creación de ofertas fijas o porcentuales con fechas de expiración.
- **Control de Usuarios:** Listado y gestión de cuentas registradas.

##  Tecnologías Utilizadas
- **Backend:** [Laravel 8.x](https://laravel.com/) (PHP 8.x)
- **Frontend:** Blade Templating Engine, Vanilla CSS, FontAwesome 6.
- **Base de Datos:** SQLite 
- **Gestión de Dependencias:** Composer & NPM.

##  Instalación y Configuración

Sigue estos pasos para poner en marcha el proyecto localmente:

1. **Clonar el repositorio:**
   ```bash
   git clone <url-del-repositorio>
   cd Futiverso2
   ```

2. **Instalar dependencias de PHP:**
   ```bash
   composer install
   ```

3. **Configurar el entorno:**
   - Copia el archivo `.env.example` a `.env`.
   - Configura tus credenciales de base de datos en el archivo `.env`.
   ```bash
   cp .env.example .env
   ```

4. **Generar la clave de aplicación:**
   ```bash
   php artisan key:generate
   ```

5. **Ejecutar migraciones y seeders:**
   Este comando creará las tablas necesarias y cargará los datos de prueba (incluyendo el admin).
   ```bash
   php artisan migrate --seed
   ```

6. **Enlazar el almacenamiento (Storage):**
   Para que las imágenes se visualicen correctamente:
   ```bash
   php artisan storage:link
   ```

7. **Iniciar servidor local:**
   ```bash
   php artisan serve
   ```

##  Usuarios de Prueba

Para probar todas las funcionalidades, puedes utilizar las siguientes credenciales:

### Administrador (Acceso total al Panel)
- **Email:** `admin@futiverso.com`
- **Password:** `Futiverso2026!`

### Usuario Estándar
- Puedes registrar un nuevo usuario directamente desde el modal de "Registrarse" en la web para probar el flujo completo de compra.

---
