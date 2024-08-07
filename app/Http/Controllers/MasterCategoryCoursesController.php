<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MasterCategoryCourses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MasterCategoryCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // get data to dispaly in index page
            $masterCategoryCourses = MasterCategoryCourses::all();

            // mengembalikan ke halaman index
            return view('admin.masterCategoryCourses.index', compact('masterCategoryCourses'));
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
            return view('admin.masterCategoryCourses.create');
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

            MasterCategoryCourses::create([
                'name' => $request->name
            ]);

            // mengembalikan ke halaman index
            return redirect()->route('admin.masterCategoryCourses.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
            $masterCategoryCourses = MasterCategoryCourses::with('masterCourses')->findOrfail($id);

            // mengembalikan ke halaman show
            return view('admin.masterCategoryCourses.show', ['masterCategoryCourses' => $masterCategoryCourses]);
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
            $masterCategoryCourses = MasterCategoryCourses::findOrfail($id);

            // mengembalikan ke halaman show
            return view('admin.masterCategoryCourses.edit', compact('masterCategoryCourses'));
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
            $masterCategoryCourses = MasterCategoryCourses::findOrfail($id);
            $masterCategoryCourses->update([
                'name' => $request->name
            ]);

            // mengembalikan ke halaman index
            return redirect()->route('admin.masterCategoryCourses.index')->with(['success' => 'Data Berhasil Diubah!']);
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
