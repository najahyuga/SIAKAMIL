<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use App\Models\TasksDetails;
use Illuminate\Http\Request;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'description'   => 'nullable|string|max:255',
                'result'        => 'required|numeric',
                'students_id'   => 'required|exists:students,id',
                'tasks_id'      => 'required|exists:tasks,id',
            ]);

            // Determine active role cek session role
            $activeRole = session('current_role');

            // Check role
            if (!in_array($activeRole, ['admin', 'guru', 'students'])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Peran tidak sah',
                ], 403);
            }

            // Get the task
            $task = Tasks::findOrFail($request->tasks_id);

            // Find existing task detail or create new one
            $tasksDetails = TasksDetails::where('students_id', $request->students_id)->where('tasks_id', $request->tasks_id)->first();

            if (!$tasksDetails) {
                $tasksDetails = new TasksDetails();
                $tasksDetails->students_id = $request->students_id;
                $tasksDetails->tasks_id = $request->tasks_id;
            }

            // Check if file is uploaded
            if ($request->hasFile('file')) {
                // Store new file
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
                if (!$tasksDetails->file) {
                $tasksDetails->file = $task->file;
                }
            }

            // Update task detail
            $tasksDetails->description = $request->description ?? $task->description;
            $tasksDetails->result = $request->result;
            $tasksDetails->save();

            // Render view based on role
            if ($activeRole === 'guru') {
                // Redirect to a suitable view for guru
                return redirect()->route('guru.taskDetails.index', ['studentsId' => $tasksDetails->students_id, 'taskId' => $tasksDetails->tasks_id])->with(['success' => 'Data Berhasil Disimpan oleh Guru!']);
            } elseif ($activeRole === 'admin') {
                // Redirect to a suitable view for admin
                return redirect()->route('admin.taskDetails.index', ['studentsId' => $tasksDetails->students_id, 'taskId' => $tasksDetails->tasks_id])->with(['success' => 'Data Berhasil Disimpan oleh Admin!']);
            } elseif ($activeRole === 'students') {
                // Redirect to a suitable view for students
                return redirect()->route('siswa.taskDetails.index', ['studentsId' => $tasksDetails->students_id, 'taskId' => $tasksDetails->tasks_id])->with(['success' => 'Data Berhasil Disimpan oleh Siswa!']);
            }

            // Jika peran tidak dikenali
            return response()->json([
                'status' => false,
                'message' => 'Peran tidak sah',
            ], 403);

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
