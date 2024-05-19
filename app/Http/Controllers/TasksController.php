<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Courses;
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
        try {
            // get data to display in index page
            $tasks = Tasks::all();

            if (Auth::user()->level == 'admin') {
                // mengembalikan ke halaman dashboard admin
                return view('admin.tasks.index', compact('tasks'));
            } elseif (Auth::user()->level == 'guru') {
                // mengembalikan ke halaman dashboard guru
                return view('guru.tasks.index', compact('tasks'));
            }
        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengambil data ". $th->getMessage());
            response()->json([
                'status'    => false,
                'message'   => 'Tidak dapat mengambil data'
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
            $courses_id = Courses::select('id', 'name')->get();

            if (Auth::user()->level == 'admin') {
                // mengembalikan ke halaman create admin
                return view('admin.tasks.create', ['courses_id' => $courses_id]);
            } elseif (Auth::user()->level == 'guru') {
                // mengembalikan ke halaman create admin
                return view('guru.tasks.create', ['courses_id' => $courses_id]);
            } {
                # code...
            }
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menampilkan halaman ". $th->getMessage());
            response()->json([
                'status'    => false,
                'message'   => 'Tidak dapat menampilkan halaman'
            ], 500);
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            // Validate form
            $request->validate([
                'name'          => 'required|min:5',
                'description'   => 'required|min:5',
                'deadline'      => 'required',
                'file'          => 'required|file|max:20048',
                'courses_id'    => 'required'
            ]);

            // Store the file
            $fileTugas = $request->file('file');
            $fileName = $fileTugas->getClientOriginalName();
            $fileTugas->storeAs('public/file', $fileName);

            // Create the task using Active Record pattern
            $task = new Tasks();
            $task->name = $request->name;
            $task->description = $request->description;
            $task->deadline = $request->deadline;
            $task->file = $fileName;
            $task->courses_id = $request->courses_id;
            $task->save();

            // Redirect based on user level
            $user = Auth::user();

            if ($user->level == 'admin') {
                // Redirect to admin tasks store
                return redirect()->route('admin.tasks.index')->with(['success' => 'Data Berhasil Disimpan oleh Admin!']);
            } elseif ($user->level == 'guru') {
                // Redirect to guru tasks store
                return redirect()->route('guru.tasks.index')->with(['success' => 'Data Berhasil Disimpan oleh Guru!']);
            } else {
                // Redirect to a default route if level is not recognized
                return redirect()->route('home')->with(['error' => 'Level pengguna tidak dikenali']);
            }

        } catch (\Throwable $th) {
            Log::error("Tidak dapat menyimpan data: " . $th->getMessage());
            return response()->json([
                'status'    => false,
                'message'   => 'Tidak dapat menyimpan data'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // get data to display in create page
            $courses_id = Courses::select('id', 'name')->get();

            // display data based on ID
            // menampilkan data berdasarkan ID
            $task = Tasks::findOrFail($id);

            // mengembalikan ke halaman create
            return view('admin.tasks.show', ['courses_id' => $courses_id], compact('task'));
        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengambil data ". $th->getMessage());
            response()->json([
                'status'    => false,
                'message'   => 'Tidak dapat mengambil data'
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $courses_id = Courses::select('id', 'name')->get();

            $task = Tasks::findOrFail($id);
            return view('admin.tasks.edit', ['courses_id' => $courses_id], compact('task'));
        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengambil data ". $th->getMessage());
            response()->json([
                'status'    => false,
                'message'   => 'Tidak dapat mengambil data'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            // validate form
            $request->validate([
                'name'          => 'required|min:5',
                'description'   => 'required|min:5',
                'deadline'      => 'required',
                'file'          => 'required',
                'courses_id'    => 'required'
            ]);

            // get data by ID
            $task = Tasks::findOrFail($id);

            // cek file apakah diupload
            if ($request->hasFile('file')) {
                // upload file baru
                $fileTugas = $request->file('file');
                $fileTugas->storeAs('public/file', $fileTugas->getClientOriginalName());

                // delete file lama
                Storage::delete('public/file' . $fileTugas->getClientOriginalName());

                // update data dengan file baru
                $task->update([
                    'name'          => $request->name,
                    'description'   => $request->description,
                    'deadline'      => $request->deadline,
                    'file'          => $fileTugas->getClientOriginalName(),
                    'courses_id'    => $request->courses_id
                ]);
            } else {
                // update data tanpa file
                $task->update([
                    'name'          => $request->name,
                    'description'   => $request->description,
                    'deadline'      => $request->deadline,
                    'courses_id'    => $request->courses_id
                ]);
            }

            // mengembalikan ke halaman index
            return redirect()->route('tasks.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengubah data ". $th->getMessage());
            response()->json([
                'status'    => false,
                'message'   => 'Tidak dapat mengubah data'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
