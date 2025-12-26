<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // TAMBAHKAN variabel $role di sini
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Mengecek apakah user login dan memiliki role yang sesuai
        if (auth()->check() && auth()->user()->role === $role) {
            return $next($request);
        }

        // Jika tidak sesuai, kembalikan ke dashboard dengan pesan error
        return redirect('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
}