<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $level): Response
    {
        // cek autentikasi sesuai level
        if (auth()->user()->level == $level) {
            return $next($request);
        }

        // cek pembatasan hak akses level
        if (auth()->user()->level == 'admin') {
            // mengembalikan ke halaman dashboard admin
            return redirect('admin');
        } elseif (auth()->user()->level == 'guru') {
            // mengembalikan ke halaman dashboard guru
            return redirect('guru');
        } elseif (auth()->user()->level == 'siswa') {
            // mengembalikan ke halaman dashboard guru
            return redirect('siswa');
        } else {
            // mengembalikan ke halaman dashboard utama
            return redirect('/');
        }
    }
}
