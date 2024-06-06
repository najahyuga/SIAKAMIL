<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryCourses;
use App\Models\Classrooms;
use App\Models\EducationLevels;
use App\Models\MasterCategoryCourses;
use App\Models\Roles;
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

            $activeRole = session('current_role');

            if ($activeRole === 'guru') {
                // Mengembalikan ke halaman index students guru
                return view('guru.students.index', compact('students'));
            } elseif ($activeRole === 'admin') {
                // Mengembalikan ke halaman index students admin
                return view('admin.students.index', compact('students'));
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
            $education_levels_id = EducationLevels::all();
            $classrooms_id = Classrooms::with('semesters')->get();
            $category_courses_id = MasterCategoryCourses::with('masterCourses')->get();

            $roles = Roles::all();

            // Check the role with higher priority first
            $activeRole = session('current_role');

            if ($activeRole === 'guru') {
                // Mengembalikan ke halaman create students guru
                return view('guru.students.create', compact('students'));
            } elseif ($activeRole === 'admin') {
                // Mengembalikan ke halaman create students admin
                return view('admin.students.create', compact('students'));
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
                'education_levels_id'   => 'required|exists:education_levels,id',
                'classrooms_id'         => 'required|exists:classrooms,id',

                'username'              => 'required|min:4',
                'email'                 => 'required|min:5|email',
                'password'              => 'required|min:6',
                'level'                 => 'required',

                'courses'               => 'array|required', // Input mata pelajaran sebagai array
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

            $students->courses()->attach($request->courses);

            // create data user
            User::create([
                'username'      => $request->username,
                'email'         => $request->email,
                'password'      => $request->password,
                'level'         => $request->level,
                'students_id'   => $students->id
            ]);

            // Check the role with higher priority first
            $activeRole = session('current_role');

            if ($activeRole === 'guru') {
                // redirect to guru students index
                return redirect()->route('guru.students.index')->with(['success' => 'Data Berhasil Disimpan oleh Guru!']);
            } elseif ($activeRole === 'admin') {
                // redirect to admin students index
                return redirect()->route('admin.students.index')->with(['success' => 'Data Berhasil Disimpan oleh Admin!']);
            }
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menyimpan data: " . $th->getMessage());
            if ($th instanceof \Illuminate\Validation\ValidationException) {
                $errors = $th->validator->errors()->all();
                foreach ($errors as $error) {
                    Log::error($error);
                }
            }
            return redirect()->back()->with(['error' => 'Tidak dapat menyimpan data']);
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
            $student = Students::with(['education_levels', 'classrooms', 'courses.category_courses'])->findOrFail($id);

            // get data based on id and name
            $education_levels_id = EducationLevels::where('id', '!=', $student->education_levels_id)->get(['id', 'name']);
            $classrooms_id = Classrooms::where('id', '!=', $student->classrooms_id)->get();
            $category_courses_id = MasterCategoryCourses::with('courses')->get();

            // get data based on id and level
            $user = User::select('id', 'level')->get();

            // Check the role with higher priority first
            $activeRole = session('current_role');

            if ($activeRole === 'guru') {
                // mengembalikan ke halaman guru students show
                return view('guru.students.show', ['education_levels_id' => $education_levels_id, 'classrooms_id' => $classrooms_id, 'user' => $user], compact('student'));
            } elseif ($activeRole === 'admin') {
                // mengembalikan ke halaman admin students show
                return view('admin.students.show', ['education_levels_id' => $education_levels_id, 'classrooms_id' => $classrooms_id, 'user' => $user], compact('student', 'category_courses_id'));
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
            // display data based on ID
            // menampilkan data berdasarkan ID
            $student = Students::with(['education_levels', 'classrooms'])->findOrFail($id);

            // get data based on id and name
            $education_levels_id = EducationLevels::where('id', '!=', $student->education_levels_id)->get(['id', 'name']);
            $classrooms_id = Classrooms::where('id', '!=', $student->classrooms_id)->get();
            $category_courses_id = MasterCategoryCourses::with('courses')->get();

            // get data based on id and level
            $user = User::where('id', '!=', $student->user)->get();

            // Check the role with higher priority first
            $activeRole = session('current_role');

            if ($activeRole === 'guru') {
                // mengembalikan ke halaman guru students edit
                return view('guru.students.edit', ['user' => $user, 'education_levels_id' => $education_levels_id, 'classrooms_id' => $classrooms_id], compact('student'));
            } elseif ($activeRole === 'admin') {
                // mengembalikan ke halaman admin students edit
                return view('admin.students.edit', ['user' => $user, 'education_levels_id' => $education_levels_id, 'classrooms_id' => $classrooms_id], compact('student', 'category_courses_id'));
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
                'level'                     => 'required|string',

                'courses'                   => 'nullable|array', // Field mata_pelajaran optional karena bisa tidak dipilih
                'courses.*'                   => 'exists:courses,id' // Validasi tiap mata pelajaran harus ada di database
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

            // Update relasi many-to-many mata pelajaran
            if ($request->has('courses')) {
                $student->courses()->sync($request->courses);
            } else {
                // Jika tidak ada mata pelajaran yang dipilih, kosongkan relasi
                $student->courses()->detach();
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

            // Check the role with higher priority first
            $activeRole = session('current_role');

            if ($activeRole === 'guru') {
                // redirect to guru students index page
                return redirect()->route('guru.students.index')->with(['success' => 'Data Berhasil Diubah oleh Guru!']);
            } elseif ($activeRole === 'admin') {
                // redirect to admin students index page
                return redirect()->route('admin.students.index')->with(['success' => 'Data Berhasil Diubah oleh Admin!']);
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
