<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDokter
{
    public function handle(Request $request, Closure $next)
    {

        // Cek role pengguna, jika bukan 'Dokter', redireksi
        if (auth()->guard('dokter')->check() && auth()->guard('dokter')->user()->role === 'Dokter') {
            return $next($request);
        }

        // Jika tidak, alihkan ke halaman yang sesuai atau berikan respons yang sesuai
        return redirect('/dashboard')->with('error', 'Akses ditolak. Hanya dokter yang diperbolehkan.');
    }
}
