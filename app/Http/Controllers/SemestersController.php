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
            $semesters = Semesters::all();
            return view('admin.semesters.index', compact('semesters'));
        } catch (\Throwable $th) {
            Log::error("Failed Get Data Semesters" . $th->getMessage());
            return response()->statuss(500)->json([
                'status'    => false,
                'message'   => 'failed'
            ]);
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
            'education_levels_id'       => 'required'
        ]);

        // create data semester
        Semesters::create([
            'name'                      => $request->name,
            'startDate'                 => $request->startDate,
            'endDate'                   => $request->endDate,
            'education_levels_id'       => $request->education_levels_id
        ]);

        // redirect to index
        return redirect('semesters')->with(['success' => 'Data Berhasil Disimpan!']);
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
        return view('admin.semesters.index', ['education_levels_id' => $education_levels_id], compact('semester'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate form
        $request->validate([
            'name'                      => 'required|min:6',
            'startDate'                 => 'required|date',
            'endDate'                   => 'required|date',
            'education_levels_id'       => 'required'
        ]);


        // create data semester
        Semesters::findOrfail($id)->update([
            'name'                      => $request->name,
            'startDate'                 => $request->startDate,
            'endDate'                   => $request->endDate,
            'education_levels_id'       => $request->education_levels_id
        ]);

        // redirect to index
        return redirect('semesters')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
