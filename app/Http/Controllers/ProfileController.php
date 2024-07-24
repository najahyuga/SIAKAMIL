<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function editProfile() {
        try {
            // Ambil ID pengguna yang sedang login
            $userId = auth()->id();

            // Ambil data pengguna beserta relasinya
            $user = User::with(['roles', 'teacher', 'student'])->findOrFail($userId);

            // Ambil data teacher jika ada
            $teacher = $user->teacher;

            // Ambil semua data roles
            $roles = Roles::all();

            // Ambil peran aktif dari sesi
            $activeRole = session('current_role');
            // Render view based on role
            if ($activeRole === 'guru') {
                return view('guru.editProfile.show', compact('user', 'roles', 'teacher'));
            } elseif ($activeRole === 'admin') {
                return view('admin.editProfile.show', compact('user', 'roles', 'teacher'));
            } elseif ($activeRole === 'siswa') {
                // Mengembalikan ke halaman index siswa
                return view('siswa.editProfile.show', compact('user', 'roles', 'teacher'));
            }

            // Kembalikan ke halaman edit profile
            // return view('admin.editProfile.show', compact('user', 'roles', 'teacher'));

        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengambil data: ". $th->getMessage());
            return response()->json([
                'status'    => false,
                'message'   => 'Tidak dapat mengambil data'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // try {
        //     // Validasi form
        //     $request->validate([
        //         'username'                  => 'required|min:4',
        //         'email'                     => 'required|min:5|email',
        //         'password'                  => 'nullable|string|min:6|confirmed',

        //         // table roles
        //         'level.*'                   => 'exists:roles,id',
        //     ]);

        //     // Update data user
        //     $user = User::findOrFail($id);
        //         // Update data pengguna
        //     $user->username = $request->input('username');
        //     $user->email = $request->input('email');
        //     if ($request->filled('password')) {
        //         $user->password = Hash::make($request->input('password'));
        //     }
        //     $user->save();

        //     // Update roles
        //     $user->roles()->sync($request->input('level'));

        //     // Determine active role cek session role
        //     $activeRole = session('current_role');

        //     // Check role
        //     if (!in_array($activeRole, ['admin', 'guru', 'students'])) {
        //         return response()->json([
        //             'status' => false,
        //             'message' => 'Peran tidak sah',
        //         ], 403);
        //     }

        //     // Render view based on role
        //     if ($activeRole === 'guru') {
        //         // Redirect to a suitable view for guru
        //         return redirect()->route('guru.editProfile')->with('success', 'Profil berhasil diperbarui oleh Guru.');
        //     } elseif ($activeRole === 'admin') {
        //         // Redirect to a suitable view for admin
        //         return redirect()->route('admin.editProfile')->with('success',  'Profil berhasil diperbarui oleh Admin!');
        //     }
        // } catch (\Throwable $th) {
        //     Log::error("Tidak dapat mengubah data " . $th->getMessage());
        //     return redirect()->back()->with(['error' => 'Tidak dapat mengubah data']);
        // }
        try {
            // Validasi input
            $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:6|confirmed',
                'level' => 'required|array',
            ]);

            // Ambil pengguna
            $user = User::findOrFail($id);

            // Update data pengguna
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();

            // Update roles
            $user->roles()->sync($request->input('level'));

            // Determine active role cek session role
            $activeRole = session('current_role');

            // Render view based on role
            if ($activeRole === 'guru') {
                return redirect()->route('guru.editProfile')->with('success', 'Profil berhasil diperbarui Guru.');
            } elseif ($activeRole === 'admin') {
                return redirect()->route('admin.editProfile')->with('success', 'Profil berhasil diperbarui Admin.');
            } elseif ($activeRole === 'siswa') {
                return redirect()->route('siswa.editProfile')->with('success', 'Profil berhasil diperbarui Siswa.');
            }
        } catch (\Throwable $th) {
            Log::error("Tidak dapat memperbarui data: ". $th->getMessage());
            return back()->withErrors(['message' => 'Tidak dapat memperbarui data'])->withInput();
        }
    }
}
