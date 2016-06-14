<?php

namespace App\Http\Middleware;

use Closure;

class IsAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (\Auth::guard($guard)->guest() || !\Auth::guard($guard)->user()->is_admin) {
                return redirect()->guest('/');
        }

        return $next($request);
    }
}
