<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Presences;
use Illuminate\Support\Facades\Log;

class PresenceController extends Controller
{
    // Menampilkan semua presensi
    public function index()
    {
        try {
            $presences = Presences::all();

            // Determine active role cek session role
            $activeRole = session('current_role');
            if ($activeRole === 'admin') {
                return view('admin.presences.index', compact('presences'));
            } elseif ($activeRole === 'guru') {
                return view('guru.presences.index', compact('presences'));
            } elseif ($activeRole === 'siswa') {
                return view('siswa.presences.index', compact('presences'));
            }
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menampilkan halaman index " . $th->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Tidak dapat menampilkan halaman index'
            ], 500);
        }
    }
}
