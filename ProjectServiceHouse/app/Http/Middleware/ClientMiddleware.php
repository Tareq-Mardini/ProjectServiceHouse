<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('Client')->check()) {
            return redirect()->route('AuthLogin');
        }

        return $next($request);
    }
}
