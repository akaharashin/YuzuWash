<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna memiliki peran sebagai owner
        if ($request->user() && $request->user()->role === 'owner') {
            // Jika pengguna adalah owner, lanjutkan permintaan
            return $next($request);
        }

        // Jika bukan owner, alihkan pengguna kembali atau berikan pesan kesalahan
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
    }
}
