<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EducationLevels;
use App\Models\FilesUploads;
use App\Models\Roles;
use App\Models\Teachers;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            //get data to view index
            $teachers = Teachers::all();
            return view('admin.teachers.index', compact('teachers'));
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
            $education_levels_id = EducationLevels::select('id', 'name')->get();
            $roles = Roles::all();
            return view('admin.teachers.create', ['education_levels_id' => $education_levels_id, 'roles' => $roles]);
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menampilkan halaman ". $th->getMessage());
            response()->json([
                'status'    => false,
                'message'   => 'Tidak dapat menampilkan halaman'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            //validate form
            $request->validate([
                'name'                      => 'required|min:4',
                'address'                   => 'required|min:10',
                'gender'                    => 'required',
                'dateOfBirth'               => 'required',
                'status'                    => 'required',
                'education_levels_id'       => 'required|exists:education_levels,id',
                // 'users_id'                  => 'required|exists:users,id',
                'files_uploads_id'          => 'exists:files_uploads,id',

                // table users
                'username'                  => 'required|min:4',
                'email'                     => 'required|min:5|email',
                'password'                  => 'required|min:6',

                // table roles
                'level.*'                   => 'exists:roles,id',

                // table files_uploads
                'path'                      => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ]);

            // Upload new image
            $path = $request->file('path');
            // $path->getClientOriginalName();
            // $imagePath = $path->storeAs('public/images', $path->getClientOriginalName());
            $imageName = $path->getClientOriginalName();
            $imagePath = $path->storeAs('public/images', $imageName);

            // create data user
            $user = User::create([
                'username'      => $request->username,
                'email'         => $request->email,
                'password'      => $request->password,
            ]);

            // Tangani array nilai level
            if ($request->has('level')) {
                // Tetapkan nilai level yang dipilih ke atribut roles
                $user->roles()->sync($request->input('level'));
            } else {
                // Tetapkan nilai default ke atribut roles jika tidak ada level yang dipilih
                // Misalnya, default level sebagai calonSiswa
                $defaultRole = Roles::where('level', 'calonSiswa')->first();
                if ($defaultRole) {
                    $user->roles()->sync([$defaultRole->id]);
                }
            }

            // if ($request->has('level')) {
            //     $user->roles()->sync($request->input('level'));
            // }

            // create data files_uploads record
            $file_uploads = FilesUploads::updateOrCreate(
                ['id' => $request->files_uploads_id],
                ['path' => basename($imagePath)]
            );

            //create data teacher
            Teachers::create([
                'name'                      => $request->name,
                'address'                   => $request->address,
                'gender'                    => $request->gender,
                'dateOfBirth'               => $request->dateOfBirth,
                'status'                    => $request->status,
                'education_levels_id'       => $request->education_levels_id,
                'users_id'                  => $user->id,
                'files_uploads_id'          => $file_uploads->id
            ]);

            //redirect to index
            return redirect()->route('admin.teacher.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menyimpan data: " . $th->getMessage());
            return redirect()->back()->with(['error' => 'Tidak dapat menyimpan data'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // display data based on ID
            // menampilkan data berdasarkan ID
            $teacher = Teachers::with(['education_levels', 'user'])->findOrFail($id);

            // get data relation
            $education_levels_id = EducationLevels::where('id', '!=', $teacher->education_levels_id)->get();
            $user = User::where('id', '!=', $teacher->user)->get();
            $roles = Roles::all();

            // mengembalikan ke halaman show
            return view('admin.teachers.show', compact('teacher', 'education_levels_id', 'user', 'roles'));
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
        // display data based on ID
        // menampilkan data berdasarkan ID
        $teacher = Teachers::with(['education_levels', 'user', 'files_uploads'])->findOrFail($id);

        // get data relation
        $education_levels_id = EducationLevels::where('id', '!=', $teacher->education_levels_id)->get();
        $user = User::where('id', '!=', $teacher->user)->get();
        $roles = Roles::all();

        // mengembalikan ke halaman edit
        return view('admin.teachers.edit',compact('teacher', 'education_levels_id', 'user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            //validate form
            $request->validate([
                'name'                      => 'required|min:4',
                'address'                   => 'required|min:10',
                'gender'                    => 'required',
                'dateOfBirth'               => 'required',
                'status'                    => 'required',
                'education_levels_id'       => 'required|exists:education_levels,id',

                // table users
                'username'                  => 'required|min:4',
                'email'                     => 'required|min:5|email',
                'password'                  => 'required|min:6',

                // table roles
                'level.*'                   => 'exists:roles,id',

                'path'                      => 'image|mimes:jpeg,jpg,png|max:2048',
                // table files_uploads
            ]);

            // Get data by ID
            $teacher = Teachers::with('user', 'files_uploads')->findOrFail($id);

            // Update or create user data
            $user = User::updateOrCreate(
                ['id' => $teacher->users_id], // Add id here
                [
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => $request->password
                ]
            );
            $user->save();

            // Tangani array nilai level
            if ($request->has('level')) {
                $user->roles()->sync($request->input('level'));
            }
            // Update or create files_uploads data
            if ($request->hasFile('path')) {

                // Upload new image
                $path = $request->file('path');
                $path->getClientOriginalName();
                $imagePath = $path->storeAs('public/images', $path->getClientOriginalName());

                // Delete old image if exists
                if ($teacher->files_uploads && $teacher->files_uploads->path) {
                    Storage::delete('public/images/' . $teacher->files_uploads->path);
                }

                $filesUpload = FilesUploads::updateOrCreate(
                    ['id' => $teacher->files_uploads_id],
                    ['path' => basename($imagePath)]
                );

                $teacher->files_uploads_id = $filesUpload->id;
            }

            // Update teacher data
            $teacher->update([
                'name' => $request->name,
                'address' => $request->address,
                'gender' => $request->gender,
                'dateOfBirth' => $request->dateOfBirth,
                'status' => $request->status,
                'education_levels_id' => $request->education_levels_id,
                'users_id' => $user->id,
            ]);

            // Save teacher
            $teacher->save();

            // redirect to index
            return redirect()->route('admin.teacher.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengubah data teacher {$id}: " . $th->getMessage());
            return redirect()->back()->with(['error' => 'Tidak dapat mengupdate data'])->withInput();
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
