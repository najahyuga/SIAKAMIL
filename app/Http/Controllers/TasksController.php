<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classrooms;
use App\Models\Courses;
use App\Models\Students;
use App\Models\Tasks;
use App\Models\TasksDetails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Ambil peran aktif dari sesi
            $activeRole = session('current_role');

            // Inisialisasi classrooms menjadi null
            $classroomName = null;

            // Jika peran adalah guru atau admin, ambil semua tugas
            if ($activeRole === 'guru' || $activeRole === 'admin') {
                $tasks = Tasks::all();

                // Ambil nama classrooms yang terkait dengan setiap task
                $classroomNames = Tasks::with('courses.classrooms')
                ->get()
                ->pluck('courses.classrooms.name', 'courses.classrooms.id')
                ->toArray();

                if ($activeRole === 'guru') {
                    return view('guru.tasks.index', compact('tasks', 'classroomNames'));
                } elseif ($activeRole === 'admin') {
                    return view('admin.tasks.index', compact('tasks', 'classroomNames'));
                }
            }
            // Jika peran adalah siswa, ambil tugas yang terkait dengan classrooms_id siswa
            elseif ($activeRole === 'siswa') {
                // Dapatkan siswa yang sedang login
                $student = Auth::user()->student;

                // Periksa apakah siswa valid dan memiliki classrooms_id
                if ($student && $student->classrooms_id) {
                    // Dapatkan classrooms_id dari siswa tersebut
                    $classroomsId = $student->classrooms_id;

                    // Dapatkan nama classrooms
                    $classroomName = Classrooms::findorFail($classroomsId)->name;

                    // Dapatkan semua courses yang terkait dengan classrooms_id
                    $courses = Courses::where('classrooms_id', $classroomsId)->pluck('id')->toArray();

                    // Dapatkan semua tasks yang terkait dengan courses_id
                    $tasks = Tasks::whereIn('courses_id', $courses)->get();
                } else {
                    // Jika siswa tidak valid atau tidak memiliki classrooms_id, inisialisasi $tasks sebagai koleksi kosong
                    $tasks = collect();
                }

                // Mengembalikan ke halaman index siswa
                return view('siswa.tasks.index', compact('tasks', 'classroomName'));
            }
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
        try {
            // get data to display in create page
            $courses_id = Courses::with('masterCourses', 'classrooms')->get();
            $activeRole = session('current_role');

            if ($activeRole === 'guru') {
                // Mengembalikan ke halaman index students guru
                return view('guru.tasks.create', compact('courses_id'));
            } elseif ($activeRole === 'admin') {
                // Mengembalikan ke halaman index students admin
                return view('admin.tasks.create', compact('courses_id'));
            }
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menampilkan halaman create ". $th->getMessage());
            response()->json([
                'status' => false,
                'message' => 'Tidak dapat menampilkan halaman create'
            ], 500);
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            // Validate form
            $validatedData = $request->validate([
                'name'                      => 'required|min:5',
                'description'               => 'required|min:5',
                'deadline'                  => 'required|date',
                'file'                      => 'required|file|max:20048',
                'courses_id'                => 'required|exists:courses,id',
                'master_courses_id'         => 'required|exists:master_courses,id',
            ]);

            // Store the file
            $path = $request->file('file');
            $path->getClientOriginalName();
            $filePath = $path->storeAs('public/file', $path->getClientOriginalName());

            // Get the courses and master_courses_id based on courses_id
            $course = Courses::findOrFail($request->courses_id);
            $master_courses_id = $request->master_courses_id;

            if (!$master_courses_id) {
                return redirect()->back()->with(['error' => 'Master Courses tidak ditemukan untuk courses_id yang dipilih']);
            }

            // Create the task using Active Record pattern
            $task                       = new Tasks();
            $task->name                 = $validatedData['name'];
            $task->description          = $validatedData['description'];
            $task->deadline             = $validatedData['deadline'];
            $task->file                 = basename($filePath);
            $task->courses_id           = $validatedData['courses_id'];
            $task->master_courses_id    = $validatedData['master_courses_id'];
            $task->save();

            // Check the role with higher priority first
            $activeRole = session('current_role');
            if ($activeRole === 'guru') {
                // redirect to guru students index
                return redirect()->route('guru.tasks.index')->with(['success' => 'Data Berhasil Disimpan oleh Guru!']);
            } elseif ($activeRole === 'admin') {
                // redirect to admin students index
                return redirect()->route('admin.tasks.index')->with(['success' => 'Data Berhasil Disimpan oleh Admin!']);
            }

        } catch (\Throwable $th) {
            Log::error("Tidak dapat menyimpan data tugas: " . $th->getMessage());
            if ($th instanceof \Illuminate\Validation\ValidationException) {
                $errors = $th->validator->errors()->all();
                foreach ($errors as $error) {
                    Log::error($error);
                }
            }
            return redirect()->back()->with(['error' => 'Tidak dapat menyimpan data tugas']);
        }
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads', $filename);

            $url = Storage::url('uploads/' . $filename);

            return response()->json([
                'uploaded' => true,
                'url' => $url,
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'File upload failed.',
            ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // get data to display in create page
            $courses_id = Courses::with('masterCourses', 'classrooms')->get();

            // display data based on ID
            // menampilkan data berdasarkan ID
            $task = Tasks::findOrFail($id);
            $classroomName = $task->courses->classrooms->name;
            $semesterName = $task->courses->classrooms->semesters->name;

            // Determine active role
            $activeRole = session('current_role');

            // Render view based on role
            if ($activeRole === 'guru') {
                return view('guru.tasks.show', [
                    'courses_id'    => $courses_id,
                    'task'          => $task,
                    'classroomName' => $classroomName,
                    'semesterName'  => $semesterName,
                ]);
            } elseif ($activeRole === 'admin') {
                return view('admin.tasks.show', [
                    'courses_id'    => $courses_id,
                    'task'          => $task,
                    'classroomName' => $classroomName,
                    'semesterName'  => $semesterName,
                ]);
            }

            // Jika peran tidak dikenali (idealnya, ada default case atau validasi yang lebih baik)
            return response()->json([
                'status' => false,
                'message' => 'Peran tidak sah',
            ], 403);
        } catch (\Throwable $th) {
            Log::error("Gagal mengambil data show tugas: " . $th->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengambil data show tugas',
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            // display data based on ID
            // menampilkan data berdasarkan ID
            $task = Tasks::with('courses.masterCourses', 'tasksDetails')->findOrFail($id);

            // get data to display in create page
            $courses_id = Courses::where('id', '!=', $task->courses_id)->with('masterCourses', 'classrooms')->get();

            // Determine active role
            $activeRole = session('current_role');

            // Render view based on role
            if ($activeRole === 'guru') {
                return view('guru.tasks.edit', [
                    'courses_id'                    => $courses_id,
                    'task'                          => $task,
                ]);
            } elseif ($activeRole === 'admin') {
                return view('admin.tasks.edit', [
                    'courses_id'                    => $courses_id,
                    'task'                          => $task,
                ]);
            }

            // Jika peran tidak dikenali (idealnya, ada default case atau validasi yang lebih baik)
            return response()->json([
                'status' => false,
                'message' => 'Peran tidak sah',
            ], 403);
        } catch (\Throwable $th) {
            Log::error("Gagal mengambil data show tugas: " . $th->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengambil data show tugas',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)//: RedirectResponse
    {
        try {
            // Validate form
            $request->validate([
                'name'          => 'required|min:5',
                'description'   => 'required|min:5',
                'deadline'      => 'required',
                'file'          => 'nullable|file|max:20048',
            ]);

            // Get data by ID
            $task = Tasks::findOrFail($id);

            // Check if file is uploaded
            if ($request->hasFile('file')) {
                // Store new file
                $path = $request->file('file');
                $path->getClientOriginalName();
                $filePath = $path->storeAs('public/file', $path->getClientOriginalName());

                // Delete old file if exists
                if ($task->file) {
                    Storage::delete('public/file/' . $task->file);
                }

                // Update task with new file
                $task->update([
                    'name'          => $request->name,
                    'description'   => $request->description,
                    'deadline'      => $request->deadline,
                    'file'          => basename($filePath),
                ]);
            } else {
                // Update task without new file
                $task->update([
                    'name'          => $request->name,
                    'description'   => $request->description,
                    'deadline'      => $request->deadline,
                ]);
            }

            // Determine active role cek session role
            $activeRole = session('current_role');

            // Check role
            if (!in_array($activeRole, ['admin', 'guru', 'students'])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Peran tidak sah',
                ], 403);
            }

            // Render view based on role
            if ($activeRole === 'guru') {
                // Redirect to a suitable view for guru
                return redirect()->route('guru.tasks.show', ['task' => $task->id])->with(['success' => 'Data Berhasil Disimpan oleh Guru!']);
            } elseif ($activeRole === 'admin') {
                // Redirect to a suitable view for admin
                return redirect()->route('admin.tasks.show', ['task' => $task->id])->with(['success' => 'Data Berhasil Disimpan oleh Admin!']);
            }
        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengubah data: " . $th->getMessage());
            return redirect()->back()->with(['error' => 'Tidak dapat mengubah data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function detail(string $id)
    {
        try {
            // display data based on ID
            $task = Tasks::with('courses.masterCourses', 'tasksDetails')->findOrFail($id);

            // Mengambil students_id berdasarkan $id
            $student = Students::findOrFail($id);

            // Mengambil tasks_details berdasarkan students_id dan tasks_id
            $tasksDetails = TasksDetails::where('students_id', $student)->where('tasks_id', $task->id)->get();

            // Determine active role
            $activeRole = session('current_role');

            // Render view based on role
            if ($activeRole === 'guru') {
                return view('guru.tasks.detail', [
                    'tasksDetails' => $tasksDetails,
                    'task'         => $task,
                    'students_id'  => $student,
                ]);
            } elseif ($activeRole === 'admin') {
                return view('admin.tasks.detail', [
                    'tasksDetails' => $tasksDetails,
                    'task'         => $task,
                    'students_id'  => $student,
                ]);
            }

            // Jika peran tidak dikenali (idealnya, ada default case atau validasi yang lebih baik)
            return response()->json([
                'status' => false,
                'message' => 'Peran tidak sah',
            ], 403);
        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengambil data " . $th->getMessage());
            return response()->json([
                'status'    => false,
                'message'   => 'Tidak dapat mengambil data'
            ], 500);
        }
    }
}
