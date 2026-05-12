<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Esta funcion se encarga de mostrar la pagina visual donde el usuario edita su perfil.
     */
    public function show()
    {
        // Envia a la vista 'perfil.blade.php' los datos del usuario que tiene la sesion abierta.
        return view('perfil', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Esta funcion se activa cuando el usuario le da al boton de "Guardar Cambios".
     */
    public function update(Request $request)
    {
        // 1. Validamos que nos manden datos correctos. 
        // El nombre es obligatorio y la imagen debe ser un archivo de menos de 2MB.
        // Quitamos la validación estricta de 'image' porque a veces XAMPP en Windows falla al detectar el tipo de archivo.
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|file|max:2048',
        ]);

        // Validación manual de la extensión para evitar el bug de XAMPP
        if ($request->hasFile('avatar')) {
            $extension = strtolower($request->file('avatar')->getClientOriginalExtension());
            $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
            if (!in_array($extension, $extensiones_permitidas)) {
                return back()->withErrors(['avatar' => 'El archivo debe ser una imagen válida (jpg, png, gif...).']);
            }
        }

        // Cogemos al usuario actual.
        $user = Auth::user();

        // 2. Actualizamos su nombre en nuestra variable temporal.
        $user->name = $request->name;

        // 3. Comprobamos si el usuario ha subido una foto nueva.
        if ($request->hasFile('avatar')) {
            // Si el usuario ya tenia una foto antes, borramos la antigua del disco duro para ahorrar espacio.
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Guardamos la nueva foto en la carpeta 'public/avatars'.
            $path = $request->file('avatar')->store('avatars', 'public');
            
            // Apuntamos esa ruta en la base de datos para saber donde esta la foto.
            $user->avatar = $path;
        }

        // 4. Finalmente, guardamos todos los cambios en la base de datos de verdad.
        $user->save();

        // Devolvemos al usuario a la misma pagina pero mostrandole un mensajito verde de exito.
        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Muestra el historial de pedidos del usuario.
     */
    public function orders()
    {
        // Obtenemos los pedidos del usuario autenticado, ordenados por los más recientes
        $orders = Auth::user()->orders()->latest()->paginate(10);
        
        return view('perfil.pedidos', compact('orders'));
    }

    /**
     * Muestra los detalles de un pedido específico del usuario.
     */
    public function orderDetails($id)
    {
        // Buscamos el pedido asegurándonos de que pertenezca al usuario actual
        $order = Auth::user()->orders()->with('items.product')->findOrFail($id);
        
        return view('perfil.pedido_detalle', compact('order'));
    }
}
