<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if authenticated user has 'admin' role
        if ($request->user() && $request->user()->isAdmin()) {
            return $next($request);
        }

        // Return 403 Forbidden for insufficient permissions
        return response()->json([
            'message' => 'Forbidden. Administrator access required.'
        ], 403);
    }
}