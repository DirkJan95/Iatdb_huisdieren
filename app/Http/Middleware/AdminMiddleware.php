<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->isAdmin()) {
            return redirect('/')->with('error', 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}
