<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JerseyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;

use App\Http\Controllers\AdminCategoryController;

// --------------------------------------------------------------------------
// RUTAS PRINCIPALES (Páginas públicas)
// --------------------------------------------------------------------------

// Cuando alguien entra a la pagina principal (la raiz '/'), le enseñamos la vista 'home'.
Route::get('/', function () {
    return view('home');
})->name('inicio');

// Pagina para ver las novedades de la tienda.
Route::get('/novedades', function () {
    return view('novedades');
})->name('novedades');


// --------------------------------------------------------------------------
// RUTAS DE INICIO Y CIERRE DE SESION
// --------------------------------------------------------------------------

// Esta es la ruta para mostrar el formulario de login. Solo pueden entrar los que NO han iniciado sesion (guest).
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');

// Esta es la ruta oculta que procesa los datos cuando le das al boton de "Entrar".
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Esta es la ruta oculta que procesa los datos de registro cuando creas una cuenta.
Route::post('/registro', [RegisterController::class, 'register'])->name('register.post');

// Esta ruta destruye la sesion y te devuelve a la portada.
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// --------------------------------------------------------------------------
// RUTAS DEL PANEL DE CONTROL (Solo para el jefe)
// --------------------------------------------------------------------------

// Para entrar aqui tienes que haber iniciado sesion ('auth') y ser administrador ('is_admin').
Route::middleware(['auth', 'is_admin'])->group(function () {
    // Te lleva a la pantalla principal del panel de control donde ves los graficos y botones.
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Rutas para gestionar los productos (CRUD completo)
    Route::resource('/admin/products', AdminProductController::class)->names('admin.products');
    
    // Rutas para gestionar las categorías (CRUD completo)
    Route::resource('/admin/categories', AdminCategoryController::class)->names('admin.categories');

    // Rutas para gestionar los usuarios
    Route::resource('/admin/users', \App\Http\Controllers\AdminUserController::class)->names('admin.users');

    // Rutas para gestionar los pedidos
    Route::get('/admin/orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{order}', [\App\Http\Controllers\AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/admin/orders/{order}/status', [\App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::delete('/admin/orders/{order}', [\App\Http\Controllers\AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');
});


// --------------------------------------------------------------------------
// RUTAS DE USUARIOS REGISTRADOS
// --------------------------------------------------------------------------

// Cualquier persona que haya iniciado sesion ('auth') puede entrar aqui, sea admin o no.
Route::middleware(['auth'])->group(function () {
    // Muestra la pagina para editar tu perfil.
    Route::get('/perfil', [\App\Http\Controllers\ProfileController::class, 'show'])->name('perfil');
    // Guarda los cambios de tu nombre o foto cuando envias el formulario.
    Route::post('/perfil', [\App\Http\Controllers\ProfileController::class, 'update'])->name('perfil.update');
});


// --------------------------------------------------------------------------
// RUTAS DINAMICAS DE TIENDA (Públicas)
// --------------------------------------------------------------------------

// Ruta para ver los detalles de un producto específico
Route::get('/producto/{id}', [\App\Http\Controllers\PublicProductController::class, 'show'])->name('producto.show');

// MUY IMPORTANTE: Esta ruta siempre va al final. 
// Captura cualquier palabra que pongas detras de la barra (ejemplo: /laliga, /retro) 
// y va a la base de datos a buscar esa categoria para mostrar los productos.
Route::get('/{slug}', [JerseyController::class, 'show'])->name('categoria');