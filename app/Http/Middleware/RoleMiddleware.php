<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Gunakan Auth::check() dengan huruf kapital 'A' di depan
        if (!Auth::check() || Auth::user()->role !== $role) {
            return redirect('/login')->with('error', 'Akses ditolak.');
        }

        return $next($request);
    }
}