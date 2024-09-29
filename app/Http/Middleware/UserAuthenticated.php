<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null)

   {

    if (!Auth::guard($guard)->check()) {

        session()->put('redirectTo', $request->fullUrl());

            if ($guard === 'admin') {
                return redirect()->route('admin.login');
            } elseif ($guard === 'vendor') {
                return redirect()->route('vendor.login');
            } elseif ($guard === 'university') {
                return redirect()->route('university.login');
            } else {
                return redirect()->route('user.login');
            }
        }


        $currentGuard = session('user_type');


        if ($currentGuard && $currentGuard !== $guard) {
            Auth::guard($currentGuard)->logout();
            session()->invalidate();
            session()->regenerateToken();

            if ($guard === 'admin') {
                return redirect()->route('admin.login')->with('message', 'You were logged out due to a different user type login attempt.');
            } elseif ($guard === 'vendor') {
                return redirect()->route('vendor.login')->with('message', 'You were logged out due to a different user type login attempt.');
            } elseif ($guard === 'university') {
                return redirect()->route('university.login')->with('message', 'You were logged out due to a different user type login attempt.');
            } else {
                return redirect()->route('user.login')->with('message', 'You were logged out due to a different user type login attempt.');
            }
        }


        session(['user_type' => $guard]);
        Log::info('User type set in session: ' . session('user_type'));

        return $next($request);
    }
}