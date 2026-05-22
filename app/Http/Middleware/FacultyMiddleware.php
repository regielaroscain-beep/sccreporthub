<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacultyMiddleware
{
    /**
     * Handle an incoming request.
     * Only allows users with the 'faculty' role to proceed.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isFaculty()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized. Faculty/Staff access required.'], 403);
            }
            abort(403, 'Unauthorized. Faculty/Staff access required.');
        }

        return $next($request);
    }
}
