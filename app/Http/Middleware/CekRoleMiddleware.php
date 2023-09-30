<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekRoleMiddleware
{
    public function handle(Request $request, Closure $next, $role_id)
    {

        if (Auth::user()->role_id != $role_id) {
            abort(403,'Akses tidak diizinkan');
        }

        return $next($request);
    }
}
