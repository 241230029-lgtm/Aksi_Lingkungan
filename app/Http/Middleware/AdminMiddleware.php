<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // WAJIB pakai Auth::check(), bukan Session::get('login')
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        return redirect()->route('login')->withErrors([
            'login' => 'Anda tidak memiliki akses ke panel Admin.',
        ]);
    }
}
