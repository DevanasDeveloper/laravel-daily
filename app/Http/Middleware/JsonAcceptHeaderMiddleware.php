<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JsonAcceptHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set('Access-Control-Allow-Origin', '*'); // Allow all origins, replace '*' with specific domains for better security
        $request->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH');
        $request->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization');
        $request->headers->set('Content-Type', 'application/json');
        return $next($request);
    }
}
