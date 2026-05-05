<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Esta funcion se encarga de mostrar la pantalla visual de inicio de sesion.
     */
    public function showLoginForm()
    {
        // Le dice a Laravel que pinte en la pantalla el archivo resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Esta funcion hace el trabajo duro de comprobar si el correo y la contraseña son correctos.
     */
    public function login(Request $request)
    {
        // 1. Primero, nos aseguramos de que el usuario haya escrito algo en los dos huecos.
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Auth::attempt es una herramienta de Laravel que va a la base de datos 
        // y comprueba si existe alguien con ese correo y esa contraseña.
        if (Auth::attempt($credentials)) {
            
            // Si los datos son correctos, renovamos el billete de sesion por seguridad para evitar ataques.
            $request->session()->regenerate();

            // 3. Comprobamos el tipo de usuario que acaba de entrar:
            // Si en la base de datos tiene la columna "is_admin" marcada como verdadera,
            if (Auth::user()->is_admin) {
                // Lo mandamos directo al panel de control.
                return redirect()->intended('admin');
            }

            // Si es un usuario normal, lo mandamos a la portada.
            return redirect()->intended('/');
        }

        // 4. Si el correo o la contraseña estaban mal, lo devolvemos a la pantalla anterior
        // y le mostramos un mensaje de error.
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    /**
     * Esta funcion se activa cuando alguien hace clic en cerrar sesion.
     */
    public function logout(Request $request)
    {
        // Destruimos la sesion actual para que nadie mas pueda usarla.
        Auth::logout();

        // Borramos todos los datos temporales del navegador por seguridad.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Finalmente, devolvemos al usuario a la pagina principal.
        return redirect('/');
    }
}
