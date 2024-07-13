<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EducationLevels;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EducationLevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // retrieve data and display on the index page
            // mengambil data dan menampilkan data pada halaman index
            $educationLevels = EducationLevels::all();
            return view('admin.educationLevels.index', compact('educationLevels'));
        } catch (\Throwable $th) {
            Log::error("Failed Get Data EducationLevels" . $th->getMessage());
            return response()->json([
                'status'    => false,
                'message'   => 'failed'
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.educationLevels.create');
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
                'name' => 'required'
            ]);

            EducationLevels::create([
                'name' => $request->name
            ]);

            // mengembalikan ke halaman index
            return redirect()->route('admin.educationLevels.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
            // displays data based on ID
            // menampilkan data berdasarkan id
            $educationLevel = EducationLevels::findOrFail($id);

            // mengembalikan ke halaman show
            return view('admin.educationLevels.show', compact('educationLevel'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
