<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // cek apakah users diautentikasi
        if (!Auth::check()) {
            return redirect('login');
        }

        // dapatkan users yang diautentikasi
        $user = auth()->user();

        // dapatkan peran role dari session
        $currentRole = session('current_role', null);

        // cek autentikasi sesuai level
        // Check if user has the required role
        if ($currentRole && $currentRole == $level) {
            return $next($request);
        }

        // Simpan pesan error dalam session
        $errorMessage = 'Anda tidak memiliki hak akses untuk mengakses halaman ini.';
        session()->flash('unauthorized', $errorMessage);

        // Cek dan alihkan berdasarkan peran users
        if (Auth::user()->roles->contains('level', 'admin')) {
            return redirect('admin');
        } elseif (Auth::user()->roles->contains('level', 'guru')) {
            return redirect('guru');
        } elseif (Auth::user()->roles->contains('level', 'siswa')) {
            return redirect('siswa');
        } elseif (Auth::user()->roles->contains('level', 'calonSiswa')) {
            return redirect('/');
        } else {
            return redirect('login');
        }
        return redirect('login')->with('error', 'Unauthorized');
    }
}
