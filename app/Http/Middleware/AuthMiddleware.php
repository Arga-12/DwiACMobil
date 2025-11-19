<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Usage examples on routes:
     * - middleware('auth.custom:auth,web')
     * - middleware('auth.custom:auth,montir')
     * - middleware('auth.custom:guest,web')
     */
    public function handle(Request $request, Closure $next, string $mode = 'auth', string $guard = 'web'): Response
    {
        Auth::shouldUse($guard);

        if ($mode === 'guest') {
            if (Auth::guard($guard)->check()) {
                // Already authenticated: redirect to the appropriate dashboard
                $redirect = $guard === 'montir' ? route('admin.dashboard') : route('dashboard');
                return redirect()->to($redirect);
            }
        } else {
            // Default mode: 'auth' (must be authenticated)
            if (!Auth::guard($guard)->check()) {
                // Not authenticated: redirect to login page
                // If you later add a separate admin login, you can branch by $guard here
                return redirect()->route('login');
            }
        }
        return $next($request);
    }
}
