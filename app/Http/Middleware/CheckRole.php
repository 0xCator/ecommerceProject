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
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role): mixed
    {
        $user = Auth::user();

        // Check if the user exists and has the required role
        if ($user && $user->role === $role) {
            return $next($request);
        }

        // Redirect unauthorized users
        return redirect('/')->with('error', 'Unauthorized access.');
    }
}
