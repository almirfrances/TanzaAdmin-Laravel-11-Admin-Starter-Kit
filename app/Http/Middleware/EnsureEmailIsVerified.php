<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $guards = ['web', 'vendor', 'university'];

        foreach ($guards as $guard) {
            $user = Auth::guard($guard)->user();

            if ($user && !$user->is_verified) {
                return redirect()->route('verify.email');
            }
        }

        return $next($request);
    }
}