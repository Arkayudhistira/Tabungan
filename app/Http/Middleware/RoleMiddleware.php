<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roleId)
    {
        if (Auth::check() && Auth::user()->role_id != $roleId) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}

