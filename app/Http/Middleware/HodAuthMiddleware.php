<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HodAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('hod')) {
            return redirect()->route('hod.login')->with('error', 'Access Denied. Please log in.');
        }
        return $next($request);
    }
}
