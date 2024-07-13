<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classrooms;
use App\Models\Courses;
use App\Models\MasterCategoryCourses;
use App\Models\MasterCourses;
use App\Models\Teachers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // display data to index page
            $courses = Courses::with('masterCourses', 'classrooms')->get();

            // Debugging data
            foreach ($courses as $course) {
                Log::info('Course:', ['course' => $course]);
                Log::info('Master Courses:', ['masterCourses' => $course->masterCourses]);
            }

            return view('admin.courses.index', compact('courses'));
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menampilkan halaman index ". $th->getMessage());
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
            // get data to display create page
            $teachers_id = Teachers::all();
            $classrooms_id = Classrooms::all();
            $master_category_courses_id = MasterCategoryCourses::with('masterCourses')->get();
            // $master_courses_id = MasterCourses::all();

            // mengembalikan ke halaman create
            return view('admin.courses.create', ['teachers_id' => $teachers_id, 'classrooms_id' => $classrooms_id, 'master_category_courses_id' => $master_category_courses_id]);
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menampilkan halaman create ". $th->getMessage());
            response()->json([
                'status'    => false,
                'message'   => 'Tidak dapat menampilkan halaman create'
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
                'teachers_id'           => 'required|exists:teachers,id',
                'classrooms_id'         => 'required|exists:classrooms,id',
                'master_courses_id'     => 'nullable|array',
                'master_courses_id.*'   => 'exists:master_courses,id'
            ]);

            Log::info('Request Data:', $request->all());

            //create data courses
            $course = Courses::create([
                'teachers_id'           => $request->teachers_id,
                'classrooms_id'         => $request->classrooms_id
            ]);

            // Attach master courses
            // untuk disimpan pada pivot table
            if ($request->has('master_courses_id')) {
                $course->masterCourses()->attach($request->master_courses_id);
            }

            // mengembalikan ke halaman courses index
            return redirect()->route('admin.courses.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menyimpan data ". $th->getMessage());
            return redirect()->back()->with(['error' => 'Tidak dapat menyimpan data']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Menampilkan data berdasarkan ID
            $course = Courses::with('teachers', 'classrooms', 'masterCourses', 'students')->findOrFail($id);

            // Mengambil data berdasarkan id dan nama
            $teachers_id = Teachers::where('id', '!=', $course->teachers_id)->get();
            $classrooms_id = Classrooms::where('id', '!=', $course->classrooms_id)->get();
            $master_courses_id = MasterCourses::where('id', '!=', $course->master_courses_id)->get();
            $master_category_courses_id = MasterCategoryCourses::with('masterCourses')->get();

            // Mengembalikan ke halaman show
            return view('admin.courses.show', [
                'teachers_id'       => $teachers_id,
                'classrooms_id'     => $classrooms_id,
                'master_courses_id' => $master_courses_id,
                'master_category_courses_id' => $master_category_courses_id,
                'course'            => $course
            ]);
        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengambil data ". $th->getMessage());
            return response()->json([
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
            $course = Courses::with('teachers', 'classrooms', 'masterCourses', 'students')->findOrFail($id);

            // get data based on id and name
            $teachers_id = Teachers::where('id', '!=', $course->teachers_id)->get();
            $classrooms_id = Classrooms::where('id', '!=', $course->classrooms_id)->get();
            // $master_courses_id = MasterCourses::where('id', '!=', $course->master_courses_id)->get();
            $master_category_courses_id = MasterCategoryCourses::with('masterCourses')->get();

            // mengembalikan ke halaman show
            return view('admin.courses.edit', [
                'teachers_id' => $teachers_id,
                'classrooms_id' => $classrooms_id,
                // 'master_courses_id' => $master_courses_id,
                'master_category_courses_id' => $master_category_courses_id
            ],
                compact('course'));
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
            // Validate form
            $request->validate([
                'teachers_id'           => 'required|exists:teachers,id',
                'classrooms_id'         => 'required|exists:classrooms,id',
                'masterCourses'         => 'required|array',
                'masterCourses.*'       => 'exists:master_courses,id'
            ]);

            // Get data by ID
            $course = Courses::findOrFail($id);

            // Update course data
            $course->update([
                'teachers_id'           => $request->teachers_id,
                'classrooms_id'         => $request->classrooms_id,
            ]);

            // Sync master courses with the course
            $course->masterCourses()->sync($request->masterCourses);

            // Redirect to the courses index page with success message
            return redirect()->route('admin.courses.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengubah data: " . $th->getMessage());
            return redirect()->back()->with(['error' => 'Tidak dapat menyimpan data']);
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
