<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\Tasks;
use App\Models\TasksDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TasksDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($studentsId, $taskId)
    {
        try {
             // Mendapatkan task berdasarkan taskId
            $task = Tasks::findOrFail($taskId);

            // Mendapatkan data pada tasksDetails berdasarkan studentsId dan taskId
            $tasksDetails = TasksDetails::where('students_id', $studentsId)->where('tasks_id', $taskId)->get();

            // Determine active role cek session role
            $activeRole = session('current_role');

            // Render view based on role
            if ($activeRole === 'guru') {
                return view('guru.tasks.detailByStudent', [
                    'tasksDetails' => $tasksDetails,
                    'task'         => $task,
                ]);
            } elseif ($activeRole === 'admin') {
                return view('admin.tasks.detailByStudent', [
                    'tasksDetails' => $tasksDetails,
                    'task'         => $task,
                ]);
            } elseif ($activeRole === 'siswa') {
                return view('siswa.tasks.create', [
                    'tasksDetails' => $tasksDetails,
                    'task'         => $task,
                ]);
            }

            // Jika peran tidak dikenali
            return response()->json([
                'status' => false,
                'message' => 'Peran tidak sah',
            ], 403);
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menampilkan halaman index " . $th->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Tidak dapat menampilkan halaman index'
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($taskId)
    {
        $student = Auth::user()->student;

        if (!$student) {
            return redirect()->route('home')->with(['error' => 'Anda bukan siswa.']);
        }

        $task = Tasks::findOrFail($taskId);

        return view('siswa.tasks.create', compact('task', 'student'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Determine active role cek session role
            $activeRole = session('current_role');

            // Check role
            if (!in_array($activeRole, ['admin', 'guru', 'siswa'])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Peran tidak sah',
                ], 403);
            }

            // Validate request based on role
            if ($activeRole === 'siswa') {
                $request->validate([
                    'description'   => 'nullable|string|max:255',
                    'file'          => 'required|file',
                    'students_id'   => 'required|exists:students,id',
                    'tasks_id'      => 'required|exists:tasks,id',
                ]);
            } else { // Admin or Guru
                $request->validate([
                    'description'   => 'nullable|string|max:255',
                    'result'        => 'required_if:role,admin,guru|numeric',
                    'students_id'   => 'required|exists:students,id',
                    'tasks_id'      => 'required|exists:tasks,id',
                ]);
            }

            // Dapatkan task
            $task = Tasks::findOrFail($request->tasks_id);

            // Pastikan task yang ditemukan memiliki relasi course yang valid
            $course = $task->courses;
            if (!$course) {
                return response()->json([
                    'status' => false,
                    'message' => 'Course tidak ditemukan untuk task ini.',
                ], 404);
            }


            // Periksa apakah tugas terkait dengan classrooms_id siswa
            $student = Students::findOrFail($request->students_id);
            if ($task->courses->classrooms_id != $student->classrooms_id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Task tidak terkait dengan classrooms siswa.',
                ], 403);
            }

            // Find existing task detail or create new one
            // Cari task detail yang sudah ada atau buat yang baru
            $tasksDetails = TasksDetails::where('students_id', $request->students_id)->where('tasks_id', $request->tasks_id)->first();

            if (!$tasksDetails) {
                $tasksDetails = new TasksDetails();
                $tasksDetails->students_id = $request->students_id;
                $tasksDetails->tasks_id = $request->tasks_id;
            }

            // Check if file is uploaded
            if ($request->hasFile('file')) {
                // Save new file
                $path = $request->file('file');
                $path->getClientOriginalName();
                $filePath = $path->storeAs('public/file', $path->getClientOriginalName());

                // Delete old file if exists and not from the original task
                if ($tasksDetails->file && $tasksDetails->file !== $task->file) {
                Storage::delete('public/file/' . $tasksDetails->file);
                }

                // Use new file for tasksDetails
                $tasksDetails->file = basename($filePath);
            } else {
                // Use existing file from tasks if no new file is uploaded
                // Menggunakan file yang ada dari tasks jika tidak ada file baru yang diunggah
                if (!$tasksDetails->file) {
                $tasksDetails->file = $task->file;
                }
            }

            // Update task detail
            // Jika request berisi deskripsi, gunakan deskripsi tersebut untuk tasksDetails.
            // Jika tidak, gunakan deskripsi dari task asli.
            $tasksDetails->description = $request->description ?? $task->description;
            // Perbarui hasil hanya jika peran adalah admin atau guru
            if ($activeRole === 'admin' || $activeRole === 'guru') {
                $tasksDetails->result = $request->result;
            }
            $tasksDetails->save();

            // Redirect berdasarkan peran
            switch ($activeRole) {
                case 'guru':
                    return redirect()->route('guru.taskDetails.index', [
                        'studentsId'    => $tasksDetails->students_id,
                        'taskId'        => $tasksDetails->tasks_id,
                    ])->with(['success' => 'Data berhasil disimpan oleh Guru!']);
                case 'admin':
                    return redirect()->route('admin.taskDetails.index', [
                        'studentsId'    => $tasksDetails->students_id,
                        'taskId'        => $tasksDetails->tasks_id,
                    ])->with(['success' => 'Data berhasil disimpan oleh Admin!']);
                case 'siswa':
                    return redirect()->route('siswa.tasks.show', [
                        // 'studentsId'    => $tasksDetails->students_id,
                        'task'        => $tasksDetails->tasks_id,
                    ])->with(['success' => 'Data berhasil disimpan oleh Siswa!']);
                default:
                    return response()->json([
                        'status' => false,
                        'message' => 'Peran tidak sah',
                    ], 403);
            }

        } catch (\Throwable $th) {
            Log::error("Gagal menyimpan data " . $th->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan data'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $studentId)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
