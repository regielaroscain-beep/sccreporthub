<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     * Only allows users with the 'maintenance' role to proceed.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isMaintenance()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized. Maintenance Staff access required.'], 403);
            }
            abort(403, 'Unauthorized. Maintenance Staff access required.');
        }

        return $next($request);
    }
}
