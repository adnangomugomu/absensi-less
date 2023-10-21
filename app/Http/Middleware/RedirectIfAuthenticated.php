<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $link = '/404';
                if (Auth::user()->role_id == 1) $link = route('admin.dashboard');
                elseif (Auth::user()->role_id == 2) $link = route('user.dashboard');
                return redirect($link);
            }
        }

        return $next($request);
    }
}
