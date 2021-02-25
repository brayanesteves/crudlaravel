<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedireccionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if(auth()->check()) {
            abort(403, "USTED YA INICIO SESIÓN");
        }
        return $next($request);
    }
}
