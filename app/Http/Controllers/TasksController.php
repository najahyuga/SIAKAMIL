<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\MasterCategoryCourses;
use App\Models\MasterCourses;
use App\Models\Students;
use App\Models\Tasks;
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
        // $students = Students::first()->getCourses->courseMaster;
        // dd($students);
        try {
            // get data to display in index page
            $tasks = Tasks::all();

            $activeRole = session('current_role');

            if ($activeRole === 'guru') {
                // Mengembalikan ke halaman index students guru
                return view('guru.tasks.index', compact('tasks'));
            } elseif ($activeRole === 'admin') {
                // Mengembalikan ke halaman index students admin
                return view('admin.tasks.index', compact('tasks'));
            }
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menampilkan halaman index ". $th->getMessage());
            response()->json([
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

            // Determine active role
            $activeRole = session('current_role');

            // Render view based on role
            if ($activeRole === 'guru') {
                return view('guru.tasks.show', [
                    'courses_id' => $courses_id,
                    'task' => $task,
                ]);
            } elseif ($activeRole === 'admin') {
                return view('admin.tasks.show', [
                    'courses_id' => $courses_id,
                    'task' => $task,
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

            // Redirect based on user level
            $user = Auth::user()->roles->first();

            if ($user->level == 'admin') {
                return redirect()->route('admin.tasks.index')->with(['success' => 'Data Berhasil Diubah oleh Admin!']);
            } elseif ($user->level == 'guru') {
                return redirect()->route('guru.tasks.index')->with(['success' => 'Data Berhasil Diubah oleh Guru!']);
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
            // get data to display in create page
            $courses_id = Courses::all();

            // display data based on ID
            // menampilkan data berdasarkan ID
            $task = Tasks::with('courses.masterCourses', 'tasksDetails')->findOrFail($id);

            // Determine active role
            $activeRole = session('current_role');

            // Render view based on role
            if ($activeRole === 'guru') {
                return view('guru.tasks.detail', [
                    'courses_id'                    => $courses_id,
                    'task'                          => $task,
                ]);
            } elseif ($activeRole === 'admin') {
                return view('admin.tasks.detail', [
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
            Log::error("Tidak dapat mengambil data ". $th->getMessage());
            response()->json([
                'status'    => false,
                'message'   => 'Tidak dapat mengambil data'
            ], 500);
        }
    }
}
