<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BlockDokter
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('dokter')->check()) {
            return redirect('/dashboard'); // Ganti dengan URL atau halaman yang sesuai untuk pengguna dokter
        }

        return $next($request);
    }
}
