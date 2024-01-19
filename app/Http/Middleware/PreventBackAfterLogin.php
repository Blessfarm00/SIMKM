<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventBackAfterLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
