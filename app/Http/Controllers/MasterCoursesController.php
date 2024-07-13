<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MasterCategoryCourses;
use App\Models\MasterCourses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MasterCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Display data on the index page with('masterCategoryCourse')->get()
            $masterCourses = MasterCourses::all();

            return view('admin.masterCourses.index', compact('masterCourses'));
        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengambil data ". $th->getMessage());
            return response()->json([
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
            $masterCategoryCourses = MasterCategoryCourses::all();

            // mengembalikan ke halaman create
            return view('admin.masterCourses.create', ['masterCategoryCourses' => $masterCategoryCourses]);
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
    public function store(Request $request)
    {
        try {
            //validate form
            $request->validate([
                'name'                          => 'required|min:2',
                'master_category_courses_id'    => 'required|exists:master_category_courses,id'
            ]);

            //create data courses
            MasterCourses::create([
                'name'                          => $request->name,
                'master_category_courses_id'    => $request->master_category_courses_id
            ]);

            // mengembalikan ke halaman courses index
            return redirect()->route('admin.masterCourses.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
            // display data based on ID
            // menampilkan data berdasarkan ID
            $masterCourses = MasterCourses::findOrFail($id);

            // get data based on id and name
            $master_category_course = MasterCategoryCourses::where('id', '!=', $masterCourses->master_category_course)->get();
            // mengembalikan ke halaman edit
            return view('admin.masterCourses.show', ['master_category_course' => $master_category_course], compact('masterCourses'));
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
            $masterCourses = MasterCourses::with('master_category_course')->findOrFail($id);

            // get data based on id and name
            $master_category_course = MasterCategoryCourses::where('id', '!=', $masterCourses->master_category_course)->get();
            // mengembalikan ke halaman edit
            return view('admin.masterCourses.edit', ['master_category_course' => $master_category_course], compact('masterCourses'));
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
    public function update(Request $request, string $id)
    {
        try {
            //validate form
            $request->validate([
                'name'                          => 'required|min:2',
                'master_category_courses_id'    => 'required|exists:master_category_courses,id'
            ]);

            // get data by id
            $masterCourses = MasterCourses::findOrFail($id);

            //create data courses
            $masterCourses->update([
                'name'                  => $request->name,
                'master_category_courses_id'   => $request->master_category_courses_id
            ]);

            // mengembalikan ke halaman courses index
            return redirect()->route('admin.masterCourses.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengubah data ". $th->getMessage());
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
