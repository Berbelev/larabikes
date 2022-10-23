<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {

        // Pasar primero la petición y luego hacer las operaciones
        // $response=$next($request);

        // Operaciones:
        // mira si el usuario es menor de edad
        if($request->query('edad')<18)
            abort(403,
                  'Acceso denegado, debes er mayor de edad para acceder a este contenido.'
            );
        // podríamos comprobar la edad real en el modelo usr
        // if($user->edad<18)...

        //return $response;

        return $next($request);
    }
}
