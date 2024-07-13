<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryCourses;
use App\Models\Classrooms;
use App\Models\CourseMasterCourse;
use App\Models\Courses;
use App\Models\EducationLevels;
use App\Models\FilesUploads;
use App\Models\MasterCategoryCourses;
use App\Models\Roles;
use App\Models\Students;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            // Ambil data untuk menampilkan halaman create
            $education_levels = EducationLevels::all();
            $classrooms = Classrooms::with('courses')->get(); // Ambil kelas beserta kursusnya
            $master_categories = MasterCategoryCourses::with('masterCourses')->get();
            $roles = Roles::all();

            $roles = Roles::all();

            // Check the role with higher priority first
            $activeRole = session('current_role');

            if ($activeRole === 'guru') {
                // Mengembalikan ke halaman create students guru
                return view('guru.students.create', [
                    'education_levels' => $education_levels,
                    'classrooms' => $classrooms,
                    'master_categories' => $master_categories,
                    'roles' => $roles
                ]);
            } elseif ($activeRole === 'admin') {
                // Mengembalikan ke halaman create students admin
                return view('admin.students.create',  [
                    'education_levels' => $education_levels,
                    'classrooms' => $classrooms,
                    'master_categories' => $master_categories,
                    'roles' => $roles
                ]);
            }
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menampilkan halaman create". $th->getMessage());
            return response()->json([
                'status'    => false,
                'message'   => 'Tidak dapat menampilkan halaman create'
            ], 500);
        }
    }

    public function getCoursesByClassroom($classroom_id)
    {
        try {
            Log::info("Mengambil data kursus untuk kelas dengan ID: " . $classroom_id);
            $classroom = Classrooms::with('courses.masterCourses')->find($classroom_id);

            if (!$classroom) {
                Log::error("Kelas tidak ditemukan: " . $classroom_id);
                return response()->json(['error' => 'Kelas tidak ditemukan'], 404);
            }

            // Ambil semua kursus dari kelas yang dipilih
            $courses = $classroom->courses;

            Log::info("Kursus ditemukan: " . $courses);
            return response()->json($courses);

        } catch (\Throwable $th) {
            Log::error("Gagal mengambil data kursus: " . $th->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengambil data kursus',
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        try {
            // Debugging: log the request data
            Log::debug('Request data:', $request->all());

            // Validate form
            $validatedData = $request->validate([
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
                'status'                => 'required',
                'education_levels_id'   => 'required|exists:education_levels,id',
                'classrooms_id'         => 'required|exists:classrooms,id',
                'files_uploads_id'      => 'exists:files_uploads,id',
                'username'              => 'required|min:4',
                'email'                 => 'required|min:5|email',
                'password'              => 'required|min:6',
                'level.*'               => 'exists:roles,id',
                'master_courses_id.*'   => 'exists:master_courses,id',
            ]);

            // Debugging: log validated data
            Log::debug('Validated data:', $validatedData);

            // Upload new image
            $path = $request->file('path');
            $path->getClientOriginalName();
            $imagePath = $path->storeAs('public/images', $path->getClientOriginalName());

            // create data user
            $user = User::create([
                'username'      => $request->username,
                'email'         => $request->email,
                'password'      => $request->password,
            ]);

            // Tangani array  level
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

            // create data files_uploads record
            $file_uploads = FilesUploads::updateOrCreate(
                ['id' => $request->files_uploads_id],
                ['path' => basename($imagePath)]
            );

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
                'status'                => $request->status,
                'education_levels_id'   => $request->education_levels_id,
                'classrooms_id'         => $request->classrooms_id,
                'users_id'              => $user->id,
                'files_uploads_id'      => $file_uploads->id
            ]);

            // Attach courses yang dipilih ke siswa
            if ($request->has('master_courses_id')) {
                foreach ($request->master_courses_id as $masterCourseId) {
                    // Ambil course_id berdasarkan master_course_id dari tabel CourseMasterCourse
                    $courseId = CourseMasterCourse::where('master_course_id', $masterCourseId)->value('course_id');

                    // Attach course_id ke siswa, untuk menghindari duplikasi gunakan syncWithoutDetaching
                    if ($courseId) {
                        $students->courses()->syncWithoutDetaching($courseId);
                    }
                }
            }

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
            Log::error("Tidak dapat menyimpan data siswa: " . $th->getMessage());
            if ($th instanceof \Illuminate\Validation\ValidationException) {
                $errors = $th->validator->errors()->all();
                foreach ($errors as $error) {
                    Log::error($error);
                }
            }
            return redirect()->back()->with(['error' => 'Tidak dapat menyimpan data siswa']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Ambil siswa dengan semua data terkait
            $student = Students::with(['education_levels', 'classrooms', 'user', 'files_uploads', 'courses.masterCourses.master_category_course'])->findOrFail($id);

            // Ambil kategori master
            $master_category_courses_id = MasterCategoryCourses::with('masterCourses')->get();

            // Ambil data tambahan berdasarkan kebutuhan
            $education_levels = EducationLevels::where('id', '!=', $student->education_levels_id)->get(['id', 'name']);
            $classrooms = Classrooms::where('id', '!=', $student->classrooms_id)->get();
            $users = User::where('id', '!=', $student->users_id)->get();
            $roles = Roles::all();

            // Determine active role
            $activeRole = session('current_role');

            // Render view based on role
            if ($activeRole === 'guru') {
                return view('guru.students.show', [
                    'education_levels'              => $education_levels,
                    'classrooms'                    => $classrooms,
                    'user'                          => $users,
                    'student'                       => $student,
                    'master_category_courses_id'    => $master_category_courses_id,
                    'roles'                         => $roles,
                ]);
            } elseif ($activeRole === 'admin') {
                return view('admin.students.show', [
                    'education_levels'              => $education_levels,
                    'classrooms'                    => $classrooms,
                    'user'                          => $users,
                    'student'                       => $student,
                    'master_category_courses_id'    => $master_category_courses_id,
                    'roles'                         => $roles,
                ]);
            }

            // Jika peran tidak dikenali (idealnya, ada default case atau validasi yang lebih baik)
            return response()->json([
                'status' => false,
                'message' => 'Peran tidak sah',
            ], 403);

        } catch (\Throwable $th) {
            Log::error("Gagal mengambil data: " . $th->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengambil data',
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            // Ambil siswa dengan semua data terkait
            $student = Students::with(['education_levels', 'classrooms', 'user', 'files_uploads', 'courses.masterCourses.master_category_course'])->findOrFail($id);

            // Ambil kategori master
            $master_category_courses_id = MasterCategoryCourses::with('masterCourses')->get();

            // Ambil data tambahan berdasarkan kebutuhan
            $education_levels = EducationLevels::where('id', '!=', $student->education_levels_id)->get(['id', 'name']);
            $classrooms = Classrooms::where('id', '!=', $student->classrooms_id)->get();
            $users = User::where('id', '!=', $student->users_id)->get();
            $roles = Roles::all();

            // Determine active role
            $activeRole = session('current_role');

            // Render view based on role
            if ($activeRole === 'guru') {
                return view('guru.students.edit', [
                    'education_levels'              => $education_levels,
                    'classrooms'                    => $classrooms,
                    'user'                          => $users,
                    'student'                       => $student,
                    'master_category_courses_id'    => $master_category_courses_id,
                    'roles'                         => $roles,
                ]);
            } elseif ($activeRole === 'admin') {
                return view('admin.students.edit', [
                    'education_levels'              => $education_levels,
                    'classrooms'                    => $classrooms,
                    'user'                          => $users,
                    'student'                       => $student,
                    'master_category_courses_id'    => $master_category_courses_id,
                    'roles'                         => $roles,
                ]);
            }

            // Jika peran tidak dikenali (idealnya, ada default case atau validasi yang lebih baik)
            return response()->json([
                'status' => false,
                'message' => 'Peran tidak sah',
            ], 403);

        } catch (\Throwable $th) {
            Log::error("Gagal mengambil data: " . $th->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengambil data',
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
                'name'                  => 'required|min:4',
                'nik'                   => 'required|numeric|min:16',
                'noAkteLahir'           => 'required|numeric|min:4',
                'nis'                   => 'required|numeric|min:5',
                'nisn'                  => 'required|numeric|min:10',
                'noHP'                  => 'required|regex:/^\+?\d{10,15}$/', // hanya angka, panjang antara 10-15 digit,
                'agama'                 => 'required',
                'gender'                => 'required',
                'dateOfBirth'           => 'required',
                'address'               => 'required|min:10',
                'status'                => 'required',
                'education_levels_id'   => 'required|exists:education_levels,id',
                'classrooms_id'         => 'required|exists:classrooms,id',
                'files_uploads_id'      => 'exists:files_uploads,id',
                'username'              => 'required|min:4',
                'email'                 => 'required|min:5|email',
                'password'              => 'required|min:6',
                'level.*'               => 'exists:roles,id',
                'master_courses_id.*'   => 'exists:master_courses,id',
            ], [
                'noHP.regex' => 'Nomor HP harus berupa angka, bisa diawali dengan tanda plus (+) dan terdiri dari 10 hingga 15 digit.',
            ]);

            // get data by id
            $student = Students::with('user', 'files_uploads')->findOrFail($id);

            // Update or create user data
            $user = User::updateOrCreate(
                ['id' => $student->users_id], // Add id here
                [
                    'username'  => $request->username,
                    'email'     => $request->email,
                    'password'  => $request->password
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
                if ($student->files_uploads && $student->files_uploads->path) {
                    Storage::delete('public/images/' . $student->files_uploads->path);
                }

                $filesUpload = FilesUploads::updateOrCreate(
                    ['id' => $student->files_uploads_id],
                    ['path' => basename($imagePath)]
                );

                $student->files_uploads_id = $filesUpload->id;
            }

            // update data tanpa student
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
                'classrooms_id'         => $request->classrooms_id,
                'users_id'              => $user->id,
            ]);

            $classrooms_id = $request->classrooms_id;

            // Ambil semua course_ids yang terkait dengan classrooms_id yang dipilih
            $courseIds = Courses::where('classrooms_id', $classrooms_id)->pluck('id')->toArray();

            // Sinkronisasi relasi many-to-many dengan courses
            $student->courses()->sync($courseIds);

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
            Log::error("Tidak dapat mengubah data siswa: " . $th->getMessage());
            if ($th instanceof \Illuminate\Validation\ValidationException) {
                $errors = $th->validator->errors()->all();
                foreach ($errors as $error) {
                    Log::error($error);
                }
            } else {
                Log::error("Exception type: " . get_class($th));
                Log::error($th->getTraceAsString());
            }
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate data.']);
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
