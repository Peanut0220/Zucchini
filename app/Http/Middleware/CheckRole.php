<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect('/login');  // Redirect to login if not authenticated
        }

        // Check if the user has the specified role using the hasRole method from Spatie package
        if (!Auth::user()->hasRole($role)) {
            return redirect('/');  // Redirect to home if not authorized
        }

        return $next($request);
    }
}
