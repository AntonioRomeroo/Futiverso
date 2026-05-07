<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Esta funcion recoge los datos del formulario de registro, crea la cuenta
     * y automaticamente inicia la sesion del usuario.
     */
    public function register(Request $request)
    {
        // 1. Validamos que los datos introducidos sean correctos.
        // - El correo debe ser unico (no existir ya en la tabla 'users')
        // - La contraseña debe tener al menos 8 caracteres y coincidir con la de repeticion (confirmed)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 2. Creamos al usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // Guardamos la contraseña encriptada por seguridad
            'password' => Hash::make($request->password),
            // is_admin se queda en false por defecto automaticamente segun nuestra migracion
        ]);

        // 3. Le iniciamos la sesion automaticamente
        Auth::login($user);

        // 4. Lo mandamos a la portada principal
        return redirect('/');
    }
}
