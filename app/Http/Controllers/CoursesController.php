<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryCourses;
use App\Models\Classrooms;
use App\Models\Courses;
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
            $courses = Courses::all();
            return view('admin.courses.index', compact('courses'));
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
            // get data to display create page
            $teachers_id = Teachers::select('id', 'name')->get();
            $classrooms_id = Classrooms::select('id', 'name')->get();
            $category_courses_id = CategoryCourses::select('id', 'name')->get();

            // mengembalikan ke halaman create
            return view('admin.courses.create', ['teachers_id' => $teachers_id, 'classrooms_id' => $classrooms_id, 'category_courses_id' => $category_courses_id]);
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
                'name'                  => 'required|min:2',
                'teachers_id'           => 'required',
                'classrooms_id'         => 'required',
                'category_courses_id'   => 'required'
            ]);

            //create data courses
            Courses::create([
                'name'                  => $request->name,
                'teachers_id'           => $request->teachers_id,
                'classrooms_id'         => $request->classrooms_id,
                'category_courses_id'   => $request->category_courses_id
            ]);

            // mengembalikan ke halaman courses index
            return redirect()->route('admin.courses.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menyimpan data ". $th->getMessage());
            response()->json([
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
            // display data based on ID
            // menampilkan data berdasarkan ID
            $course = Courses::with('teachers', 'classrooms', 'category_courses')->findOrFail($id);

            // get data based on id and name
            $teachers_id = Teachers::where('id', '!=', $course->teachers_id)->get(['id', 'name']);
            $classrooms_id = Classrooms::where('id', '!=', $course->classrooms_id)->get();
            $category_courses_id = CategoryCourses::where('id', '!=', $course->category_courses_id)->get(['id', 'name']);

            // mengembalikan ke halaman show
            return view('admin.courses.show', ['teachers_id' => $teachers_id, 'classrooms_id' => $classrooms_id, 'category_courses_id' => $category_courses_id], compact('course'));
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
            $course = Courses::with('teachers', 'classrooms', 'category_courses')->findOrFail($id);

            // get data based on id and name
            $teachers_id = Teachers::where('id', '!=', $course->teachers_id)->get(['id', 'name']);
            $classrooms_id = Classrooms::where('id', '!=', $course->classrooms_id)->get();
            $category_courses_id = CategoryCourses::where('id', '!=', $course->category_courses_id)->get(['id', 'name']);
            // mengembalikan ke halaman edit
            return view('admin.courses.edit', ['teachers_id' => $teachers_id, 'classrooms_id' => $classrooms_id, 'category_courses_id' => $category_courses_id], compact('course'));
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
            //validate form
            $request->validate([
                'name'                  => 'required|min:2',
                'teachers_id'           => 'required',
                'classrooms_id'         => 'required',
                'category_courses_id'   => 'required'
            ]);

            // get data by id
            $course = Courses::findOrFail($id);

            //create data courses
            $course->update([
                'name'                  => $request->name,
                'teachers_id'           => $request->teachers_id,
                'classrooms_id'         => $request->classrooms_id,
                'category_courses_id'   => $request->category_courses_id
            ]);

            // mengembalikan ke halaman courses index
            return redirect()->route('admin.courses.index')->with(['success' => 'Data Berhasil Diubah!']);
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
