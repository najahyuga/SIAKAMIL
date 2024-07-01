<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use App\Models\TasksDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        //
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
