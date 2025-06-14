<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Event;

class OwnerOnly
{
    public function handle(Request $request, Closure $next)
    {
        $event = $request->route('event');

        if ($event && $event->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        return $next($request);
    }
}
