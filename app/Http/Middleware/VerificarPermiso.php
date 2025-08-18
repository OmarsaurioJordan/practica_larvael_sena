<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class VerificarPermiso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $accionNombre): Response
    {
        $usuario = auth::user();
        if (!$usuario || !$usuario->tienePermiso($accionNombre)) {
            abort(403, 'No tienes permiso para esta acción');
        }
        return $next($request);
    }
}
