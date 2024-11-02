<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfGuest
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            session()->flash('message', 'Silakan login terlebih dahulu untuk mengakses halaman');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
