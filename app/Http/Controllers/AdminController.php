<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Esta funcion se encarga de preparar y mostrar la pantalla principal del panel de control del jefe.
     */
    public function index()
    {
        // 1. Vamos a las tablas de la base de datos y contamos cuantas cosas hay en total.
        // Esto sirve para mostrar las estadisticas grandes de la pantalla principal.
        $totalCategorias = Category::count();
        $totalProductos = Product::count();
        $totalUsuarios = User::count();
        $totalPedidos = \App\Models\Order::count();
        $totalCupones = \App\Models\Coupon::count();

        // 2. Cargamos la vista visual del panel ('admin.dashboard') y le "inyectamos"
        // esas variables para que los numeros aparezcan en la pantalla.
        return view('admin.dashboard', compact('totalCategorias', 'totalProductos', 'totalUsuarios', 'totalPedidos', 'totalCupones'));
    }
}
