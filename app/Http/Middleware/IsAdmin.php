<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->is_admin) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Acesso não autorizado.'], 403);
            }
            abort(403, 'Acesso não autorizado.');
        }

        return $next($request);
    }
} 