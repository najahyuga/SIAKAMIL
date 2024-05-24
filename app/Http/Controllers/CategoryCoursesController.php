<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryCourses;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // get data to dispaly in index page
            $categoryCourses = CategoryCourses::all();

            // mengembalikan ke halaman index
            return view('admin.categoryCourse.index', compact('categoryCourses'));
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
            // mengembalikan ke halaman index
            return view('admin.categoryCourse.create');
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
                'name' => 'required|min: 8'
            ]);

            CategoryCourses::create([
                'name' => $request->name
            ]);

            // mengembalikan ke halaman index
            return redirect()->route('admin.categoryCourses.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
            // get data based on id
            // menampilkan data berdasarkan ID
            $categoryCourse = CategoryCourses::with('courses')->findOrfail($id);

            // mengembalikan ke halaman show
            return view('admin.categoryCourse.show', ['categoryCourse' => $categoryCourse]);
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
            // get data based on id
            // menampilkan data berdasarkan ID
            $categoryCourse = CategoryCourses::findOrfail($id);

            // mengembalikan ke halaman show
            return view('admin.categoryCourse.edit', compact('categoryCourse'));
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
                'name' => 'required|min: 8'
            ]);

            // update data category course
            $categoryCourse = CategoryCourses::findOrfail($id);
            $categoryCourse->update([
                'name' => $request->name
            ]);

            // mengembalikan ke halaman index
            return redirect()->route('admin.categoryCourses.index')->with(['success' => 'Data Berhasil Diubah!']);
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
