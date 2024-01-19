<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!$request->user() || $request->user()->role !== $role) {
            Session::flash('eror', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect('/dashboard'); // Ganti dengan URL atau halaman yang sesuai jika pengguna tidak memiliki hak akses yang diperlukan.
        }

        return $next($request);
    }
}
