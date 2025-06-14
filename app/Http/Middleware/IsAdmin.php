<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IsAdmin
{
    /**
     * Maneja la petición entrante.
     */
    public function handle(Request $request, Closure $next)
    {


        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        return abort(403, 'No tienes permiso para acceder a esta página.');
    }
}
