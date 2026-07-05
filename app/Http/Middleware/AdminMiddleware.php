<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah session login ada DAN rolenya admin
        if (Session::get('login') && Session::get('role') === 'admin') {
            return $next($request);
        }

        // Kalau tidak, lempar ke halaman login
        return redirect()->route('login');
    }
}
