<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classrooms;
use App\Models\EducationLevels;
use App\Models\Students;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // get data to display index page
            $students = Students::all();

            if (Auth::user()->level == 'admin') {
                // mengembalikan ke halaman index students admin
                return view('admin.students.index', compact('students'));
            } elseif (Auth::user()->level == 'guru') {
                // mengembalikan ke halaman index students guru
                return view('guru.students.index', compact('students'));
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
            // get data to display create page
            // $user_id = User::select('id', 'username')->get(); 'user_id' => $user_id,
            $education_levels_id = EducationLevels::select('id', 'name')->get();
            $classrooms_id = Classrooms::select('id', 'name')->get();

            if (Auth::user()->level == 'admin') {
                // mengembalikan ke halaman create student admin
                return view('admin.students.create', [ 'education_levels_id' => $education_levels_id, 'classrooms_id' => $classrooms_id]);
            } elseif (Auth::user()->level == 'guru') {
                // mengembalikan ke halaman create student guru
                return view('guru.students.create', ['education_levels_id' => $education_levels_id, 'classrooms_id' => $classrooms_id]);
            }
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
    public function store(Request $request) : RedirectResponse
    {
        try {
            //validate form
            $request->validate([
                'name'                  => 'required|min:4',
                'nik'                   => 'required|numeric|min:16',
                'noAkteLahir'           => 'required|numeric|min:4',
                'nis'                   => 'required|numeric|min:5',
                'nisn'                  => 'required|numeric|min:10',
                'noHP'                  => 'required|numeric|min:11',
                'agama'                 => 'required',
                'gender'                => 'required',
                'dateOfBirth'           => 'required',
                'address'               => 'required|min:10',
                'image'                 => 'required|image|mimes:jpeg,jpg,png|max:2048',
                'status'                => 'required',
                'education_levels_id'   => 'required',
                'classrooms_id'         => 'required',

                'username'                  => 'required|min:4',
                'email'                     => 'required|min:5|email',
                'password'                  => 'required|min:6',
                'level'                     => 'required'
            ]);

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/images', $image->hashName());

            //create data student
            $students = Students::create([
                'name'                  => $request->name,
                'nik'                   => $request->nik,
                'noAkteLahir'           => $request->noAkteLahir,
                'nis'                   => $request->nis,
                'nisn'                  => $request->nisn,
                'noHP'                  => $request->noHP,
                'agama'                 => $request->agama,
                'gender'                => $request->gender,
                'dateOfBirth'           => $request->dateOfBirth,
                'address'               => $request->address,
                'image'                 => $image->hashName(),
                'status'                => $request->status,
                'education_levels_id'   => $request->education_levels_id,
                'classrooms_id'         => $request->classrooms_id,
            ]);

            // create data user
            User::create([
                'username'      => $request->username,
                'email'         => $request->email,
                'password'      => $request->password,
                'level'         => $request->level,
                'students_id'   => $students->id
            ]);

            if (Auth::user()->level == 'admin') {
                // redirect to admin students index
                return redirect()->route('admin.students.index')->with(['success' => 'Data Berhasil Disimpan oleh Admin!']);
            } elseif (Auth::user()->level == 'guru') {
                // redirect to guru students index
                return redirect()->route('guru.students.index')->with(['success' => 'Data Berhasil Disimpan oleh Guru!']);
            }
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menyimpan data: " . $th->getMessage());
            return redirect()->back()->with(['error' => 'Tidak dapat menyimpan data']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // get data based on id and name
            $education_levels_id = EducationLevels::select('id', 'name')->get();
            $classrooms_id = Classrooms::select('id', 'name')->get();

            // get data based on id and level
            $user = User::select('id', 'level')->get();

            // display data based on ID
            // menampilkan data berdasarkan ID
            $student = Students::findOrFail($id);

            if (Auth::user()->level == 'admin') {
                // mengembalikan ke halaman admin students show
                return view('admin.students.show', ['education_levels_id' => $education_levels_id, 'classrooms_id' => $classrooms_id, 'user' => $user], compact('student'));
            } elseif (Auth::user()->level == 'guru') {
                // mengembalikan ke halaman guru students show
                return view('guru.students.show', ['education_levels_id' => $education_levels_id, 'classrooms_id' => $classrooms_id, 'user' => $user], compact('student'));
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            // get data based on id and name
            $education_levels_id = EducationLevels::select('id', 'name')->get();
            $classrooms_id = Classrooms::select('id', 'name')->get();

            // get data based on id and level
            $user = User::select('id', 'level')->get();

            // display data based on ID
            // menampilkan data berdasarkan ID
            $student = Students::findOrFail($id);

            if (Auth::user()->level == 'admin') {
                // mengembalikan ke halaman admin students edit
                return view('admin.students.edit', ['user' => $user, 'education_levels_id' => $education_levels_id, 'classrooms_id' => $classrooms_id], compact('student'));
            } elseif (Auth::user()->level == 'guru') {
                // mengembalikan ke halaman guru students edit
                return view('guru.students.edit', ['user' => $user, 'education_levels_id' => $education_levels_id, 'classrooms_id' => $classrooms_id], compact('student'));
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            // validate form
            $request->validate([
                'name'                      => 'required|min:4',
                'nik'                       => 'required|numeric|min:16',
                'noAkteLahir'               => 'required|numeric|min:4',
                'nis'                       => 'required|numeric|min:5',
                'nisn'                      => 'required|numeric|min:10',
                'noHP'                      => 'required|numeric|min:11',
                'agama'                     => 'required',
                'gender'                    => 'required',
                'dateOfBirth'               => 'required',
                'address'                   => 'required|min:10',
                'image'                     => 'image|mimes:jpeg,jpg,png|max:2048',
                'education_levels_id'       => 'required',
                'classrooms_id'             => 'required',

                'username'                  => 'required|min:4',
                'email'                     => 'required|min:5|email',
                'password'                  => 'required|min:6',
                'level'                     => 'required|string'
            ]);

            // get data by id
            $student = Students::findOrFail($id);

            // cek image apakah diupload
            if ($request->hasFile('image')) {
                // upload image baru
                $image = $request->file('image');
                $image->storeAs('public/images', $image->hashName());

                // delete image lama
                Storage::delete('public/images/'.$student->image);

                // update data dengan image baru
                $student->update([
                    'name'                  => $request->name,
                    'nik'                   => $request->nik,
                    'noAkteLahir'           => $request->noAkteLahir,
                    'nis'                   => $request->nis,
                    'nisn'                  => $request->nisn,
                    'noHP'                  => $request->noHP,
                    'agama'                 => $request->agama,
                    'gender'                => $request->gender,
                    'dateOfBirth'           => $request->dateOfBirth,
                    'address'               => $request->address,
                    'image'                 => $image->hashName(),
                    'status'                => $request->status,
                    'education_levels_id'   => $request->education_levels_id,
                    'classrooms_id'         => $request->classrooms_id
                ]);
            } else {
                // update data tanpa image
                $student->update([
                    'name'                  => $request->name,
                    'nik'                   => $request->nik,
                    'noAkteLahir'           => $request->noAkteLahir,
                    'nis'                   => $request->nis,
                    'nisn'                  => $request->nisn,
                    'noHP'                  => $request->noHP,
                    'agama'                 => $request->agama,
                    'gender'                => $request->gender,
                    'dateOfBirth'           => $request->dateOfBirth,
                    'address'               => $request->address,
                    'status'                => $request->status,
                    'education_levels_id'   => $request->education_levels_id,
                    'classrooms_id'         => $request->classrooms_id
                ]);
            }

            // update table user
            $user = User::where('students_id', $student->id)->firstOrFail();
            $user->update([
                'username'      => $request->username,
                'email'         => $request->email,
                'password'      => Hash::make($request->password), // Hash password
                'level'         => $request->level,
                'students_id'   => $student->id
            ]);

            // Redirect based on user level
            $authUser = Auth::user();

            if ($authUser->level == 'admin') {
                // redirect to admin students index page
                return redirect()->route('admin.students.index')->with(['success' => 'Data Berhasil Diubah oleh Admin!']);
            } elseif ($authUser->level == 'guru') {
                // redirect to guru students index page
                return redirect()->route('guru.students.index')->with(['success' => 'Data Berhasil Diubah oleh Guru!']);
            }
        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengubah data student ID {$id}: " . $th->getMessage());
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
}
