<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // view to page index
    public function dashboard() {
        return view('index');
    }

    // view to page dashboard admin index
    public function indexAdmin(){
        return view('admin.index');
    }

    // view to page dashboard guru index
    public function indexGuru(){
        return view('guru.index');
    }

    // view to page dashboard siswa index
    public function indexSiswa(){
        return view('siswa.index');
    }

    // view to page dashboard calonSiswa index
    public function indexCalonSiswa(){
        return view('calonSiswa.index');
    }

    // view to page login
    public function indexLogin() {
        return view('login');
    }

    // proses autentikasi login
    public function login(Request $request) {
        // validate form
        $request->validate([
            'username'      => 'required|min:4',
            // 'email'         => 'required|email',
            'password'      => 'required'
        ],[
            'username.required'      => 'Username Wajib di Isi!',
            // 'email'         => 'Email Wajib di Isi!',
            'password.required'      => 'Password Wajib di Isi!'
        ]);

        $login = [
            'username'      => $request->username,
            'password'      => $request->password
        ];

        if (Auth::attempt($login)) {
            $user = Auth::user();
            // Asumsi apabila users setidaknya memiliki satu role
            $primaryRole = $user->roles->first()->level;

            // Simpan peran utama dalam sesi
            session(['current_role' => $primaryRole]);

            return $this->redirectToRoleDashboard($primaryRole);
        } else {
            return redirect('login')->with('error', 'Username dan Password Tidak Sesuai!');
        }
    }

    private function redirectToRoleDashboard($role) {
        switch ($role) {
            case 'admin':
                return redirect('/admin')->with('success', 'Login Berhasil! Selamat Datang Admin ' . Auth::user()->username);
            case 'guru':
                return redirect('/guru')->with('success', 'Login Berhasil! Selamat Datang Guru ' . Auth::user()->username);
            case 'siswa':
                return redirect('/siswa')->with('success', 'Login Berhasil! Selamat Datang Siswa ' . Auth::user()->username);
            case 'calonSiswa':
                return redirect('/calonSiswa')->with('success', 'Login Berhasil! Selamat Datang Calon Siswa ' . Auth::user()->username);
            default:
                return redirect('login')->with('success', 'Login Berhasil, Anda Tidak Memiliki Akses Pengguna! Selamat Datang ' . Auth::user()->username);
        }
    }

    public function switchRole(Request $request)
    {
        $role = $request->role;

        // Cari users berdasarkan ID atau apapun yang sesuai
        $user = Auth::user();

        // Pastikan users ditemukan
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Periksa apakah users memiliki peran yang diminta
        if ($user->roles->where('level', $role)->isNotEmpty()) {
            // Update peran dalam sesi
            session(['current_role' => $role]);

            // Arahkan users ke dashboard yang sesuai dengan peran yang dipilih
            return $this->redirectToRoleDashboard($role);
        } else {
            return redirect()->back()->with('error', 'User does not have the requested role.');
        }
    }

    // view to page register
    public function indexRegister() {
        return view('register');
    }

    // create user bt default level calonSiswa
    public function storeRegister(Request $request) : RedirectResponse {
        // validate form
        $request->validate([
            'username'      => 'required|min:4',
            'email'         => 'required|min:5|email',
            'password'      => 'required|min:6'
        ],[
            'username.required'      => 'Username Wajib di Isi!',
            'email.required'         => 'Email Wajib di Isi!',
            'password.required'      => 'Password Wajib di Isi!'
        ]);

        // create data user
        User::create([
            'username'      => $request->username,
            'email'         => $request->email,
            'password'      => $request->password
        ]);

        $register = [
            'username'      => $request->username,
            'email'         => $request->email,
            'password'      => $request->password
        ];

        if (Auth::attempt($register)) {
            // mengembalikan ke halaman dashboard
            return redirect('/')->with(['success' => 'register Berhasil!']);
        } else {
            return redirect('/register')->with(['error' => 'Data Tidak Sesuai!']);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login')->with(['success' => 'Logout Berhasil!']);
    }
}
