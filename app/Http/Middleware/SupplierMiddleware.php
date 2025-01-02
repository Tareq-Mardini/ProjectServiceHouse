<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SupplierMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('Supplier')->check()) {
            return redirect()->route('AuthLoginn');
        }

        return $next($request);
    }
}
