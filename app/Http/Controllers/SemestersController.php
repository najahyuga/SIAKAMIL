<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EducationLevels;
use App\Models\Semesters;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SemestersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // get data to display on index page
            $semesters = Semesters::with('classrooms')->get();
            return view('admin.semesters.index', ['semesters' => $semesters]);
        } catch (\Throwable $th) {
            Log::error("Failed Get Data Semesters" . $th->getMessage());
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
        // get data educationLevels to display on semesters.create page
        $education_levels_id = EducationLevels::select('id', 'name')->get();
        return view('admin.semesters.create', ['education_levels_id' => $education_levels_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validate form
        $request->validate([
            'name'                      => 'required|min:6',
            'startDate'                 => 'required|date',
            'endDate'                   => 'required|date',
            'education_levels_id'       => 'required|exists:education_levels,id'
        ]);

        // create data semester
        Semesters::create([
            'name'                      => $request->name,
            'startDate'                 => $request->startDate,
            'endDate'                   => $request->endDate,
            'education_levels_id'       => $request->education_levels_id
        ]);

        // redirect to index
        return redirect()->route('admin.semesters.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // get data based on id and name
        // mendapatkan data berdasarkan id dan name
        $education_levels_id = EducationLevels::select('id', 'name')->get();

        // display data based on ID
        // menampilkan data berdasarkan ID
        $semester = Semesters::findOrFail($id);

        // mengembalikan ke halaman show
        return view('admin.semesters.show', ['education_levels_id' => $education_levels_id], compact('semester'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // get data based on id and name
        // mendapatkan data berdasarkan id dan name
        $education_levels_id = EducationLevels::select('id', 'name')->get();

        // display data based on ID
        // menampilkan data berdasarkan ID
        $semester = Semesters::findOrFail($id);

        // mengembalikan ke halaman index
        return view('admin.semesters.edit', ['education_levels_id' => $education_levels_id], compact('semester'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // validate form
            $validatedData = $request->validate([
                'name'                      => 'required|min:6',
                'startDate'                 => 'required|date',
                'endDate'                   => 'required|date',
                'education_levels_id'       => 'required|exists:education_levels,id'
            ]);

            $semester = Semesters::findOrfail($id);

            // Update the semester data
            $semester->update($validatedData);

            // redirect to index
            return redirect()->route('admin.semesters.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengubah data semester dengan id : {$id}: " . $th->getMessage());
            return redirect()->back()->with(['error' => 'Terjadi kesalahan saat mengubah data'])->withInput();
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
