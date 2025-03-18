<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();

        if (!$user || !$user->role || $user->role->name !== $role)
        {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
