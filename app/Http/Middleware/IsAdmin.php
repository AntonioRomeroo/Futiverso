<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // El 'middleware' funciona como un portero de discoteca. 
        // Se pone delante de la puerta de la pagina 'admin' y hace dos preguntas:
        
        // Pregunta 1: ¿Tienes la sesion iniciada? (Auth::check)
        // Pregunta 2: En tu base de datos, ¿tienes la etiqueta de jefe? (Auth::user()->isAdmin())
        if (Auth::check() && Auth::user()->isAdmin()) {
            
            // Si cumples las dos condiciones, el portero abre la puerta y te deja pasar.
            return $next($request);
        }

        // Si fallas alguna de las dos, te echa fuera y te manda a la portada de la tienda.
        return redirect('/');
    }
}
