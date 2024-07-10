<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\PresenceDetails;
use App\Models\Presences;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PresenceController extends Controller
{
    // Menampilkan semua presensi
    public function index()
    {
        try {
            $presences = Presences::all();

            // Ambil peran aktif dari sesi
            $activeRole = session('current_role');

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

    // Menampilkan form untuk membuat presensi baru
    public function create()
    {
        try {
            // Logic untuk menampilkan form create, misalnya daftar guru yang bisa dipilih
            $teachers = User::whereHas('roles', function($query) {
                $query->where('level', 'guru');
            })->get();

            $courses = Courses::all();

            // Ambil peran aktif dari sesi
            $activeRole = session('current_role');

            // Determine active role cek session role
            $activeRole = session('current_role');
            if ($activeRole === 'admin') {
                return view('admin.presences.create', compact('teachers', 'courses'));
            } elseif ($activeRole === 'guru') {
                return view('guru.presences.create', compact('teachers', 'courses'));
            } elseif ($activeRole === 'siswa') {
                return view('siswa.presences.index', compact('teachers', 'courses'));
            }
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menampilkan halaman create presensi " . $th->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Tidak dapat menampilkan halaman create presensi'
            ], 500);
        }
    }

    // Menyimpan presensi baru yang dibuat oleh admin
    public function store(Request $request)
    {
        $request->validate([
            'deadline' => 'required|date',
            'courses_id' => 'required|exists:courses,id',
            // 'teacher_id' => 'required|exists:users,id',
        ]);

        $presence = new Presences();
        $presence->deadline = $request->deadline;
        $presence->courses_id = $request->courses_id;
        $presence->created_by = Auth::id();
        // $presence->is_for_teacher = true; // Sesuaikan dengan kebutuhan
        $presence->save();

        // Ambil peran aktif dari sesi
        $activeRole = session('current_role');
        if ($activeRole === 'guru') {
            // redirect to guru students index
            return redirect()->route('guru.presences.index')->with(['success' => 'Data Presensi Berhasil Disimpan oleh Guru!']);
        } elseif ($activeRole === 'admin') {
            // redirect to admin students index
            return redirect()->route('admin.presences.index')->with(['success' => 'Data Presensi Berhasil Disimpan oleh Admin!']);
        }
    }

    public function show($id)
    {
        try {
            // Mengambil presensi dengan relasi yang dibutuhkan
            $presence = Presences::with(['course.classrooms.students', 'creator', 'presenceDetails'])->findOrFail($id);

            // Ambil peran aktif dari sesi
            $activeRole = session('current_role');

            if ($activeRole === 'admin') {
                return view('admin.presences.show', compact('presence'));
            } elseif ($activeRole === 'guru') {
                return view('guru.presences.show', compact('presence'));
            } elseif ($activeRole === 'siswa') {
                return view('siswa.presences.show', compact('presence'));
            }
        } catch (ModelNotFoundException $e) {
            // Handle jika data tidak ditemukan
            Log::error('Data presensi tidak ditemukan. ID: ' . $id);

            return redirect()->route('admin.presences.index')->with('error', 'Data presensi tidak ditemukan.');

        } catch (\Exception $e) {
            // Handle kesalahan umum lainnya
            Log::error('Terjadi kesalahan saat menampilkan presensi. ID: ' . $id . ' - Error: ' . $e->getMessage());

            return redirect()->route('admin.presences.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function showSubmit($id)
    {
        try {
            // Mengambil presensi dengan relasi presenceDetails
            $presence = Presences::with('presenceDetails')->findOrFail($id);

            // Menampilkan view dengan data presensi dan siswa
            return view('admin.presences.submitPresensi', compact('presence'));
        } catch (ModelNotFoundException $e) {
            // Handle jika data presensi tidak ditemukan
            Log::error('Data presensi tidak ditemukan saat menyimpan presensi. ID: ' . $id);
            return redirect()->route('admin.presences.show')->with('error', 'Data presensi tidak ditemukan.');

        } catch (\Exception $e) {
            // Handle kesalahan umum lainnya
            Log::error('Terjadi kesalahan saat menyimpan presensi. ID: ' . $id . ' - Error: ' . $e->getMessage());
            return redirect()->route('admin.presences.show')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function submit(Request $request, $id)
    {
        try {
            // Mengambil presensi dengan relasi presenceDetails
            $presence = Presences::with('presenceDetails')->findOrFail($id);

            // Mendapatkan data input status dan marked_by_teacher dari request
            $statuses = $request->input('status', []);
            $markedByTeacher = $request->input('marked_by_teacher', []);

            // Looping setiap students dalam course untuk menyimpan atau mengupdate detail presensi
            foreach ($presence->course->classrooms->students as $student) {
                $detail = PresenceDetails::firstOrNew([ // mencari atau membuat detail presensi
                    'presences_id' => $presence->id,
                    'students_id' => $student->id,
                ]);

                // Mengatur nilai status, marked_by_teacher, dan presence_date
                $detail->status = $statuses[$student->id] ?? 'alpha';
                $detail->marked_by_teacher = isset($markedByTeacher[$student->id]);
                $detail->presence_date = now(); // Set tanggal presensi ke waktu sekarang

                $detail->save();
            }

            // Redirect ke halaman detail presensi dengan pesan sukses
            return redirect()->route('admin.presences.show', $presence->id)->with(['success' => 'Presensi berhasil disimpan!']);

        } catch (ModelNotFoundException $e) {
            // Handle jika data presensi tidak ditemukan
            Log::error('Data presensi tidak ditemukan saat menyimpan presensi. ID: ' . $id);
            return redirect()->route('admin.presences.show')->with('error', 'Data presensi tidak ditemukan.');

        } catch (\Exception $e) {
            // Handle kesalahan umum lainnya
            Log::error('Terjadi kesalahan saat menyimpan presensi. ID: ' . $id . ' - Error: ' . $e->getMessage());
            return redirect()->route('admin.presences.show')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
