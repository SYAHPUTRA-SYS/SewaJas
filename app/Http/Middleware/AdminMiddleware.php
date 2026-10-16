<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')
                    ->with('error', 'Silakan login terlebih dahulu!');
        }

         // Cek apakah user adalah admin
        if (Auth::user()->role !== 'admin') {
            Auth::logout();
            return redirect()->route('login')
                    ->with('error', 'Anda tidak memiliki akses admin!');
        }
        return $next($request);
    }
}
