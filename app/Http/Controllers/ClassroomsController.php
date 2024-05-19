<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classrooms;
use App\Models\Semesters;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // display data to index page
        $classrooms = Classrooms::all();
        return view('admin.classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semesters_id = Semesters::select()->get();
        return view('admin.classrooms.create', ['semesters_id' => $semesters_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name'          => 'required|min:4',
            'semesters_id'   => 'required'
        ]);

        //create data classrooms
        Classrooms::create([
            'name'          => $request->name,
            'semesters_id'  => $request->semesters_id
        ]);

        //redirect to index
        return redirect('classrooms')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // get data based on id and name
        // mendapatkan data berdasarkan id dan name
        $semesters = Semesters::with('education_levels')->get();

        // displays data based on ID
        // menampilkan data berdasarkan id
        $classroom = Classrooms::findOrFail($id);

        // mengembalikan ke halaman show
        return view('admin.classrooms.show', ['semesters' => $semesters], compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // get data based on id and name
        // mendapatkan data berdasarkan id dan name
        $semesters = Semesters::select('id', 'name')->get();

        // displays data based on ID
        // menampilkan data berdasarkan id
        $classroom = Classrooms::findOrFail($id);

        // mengembalikan ke halaman show
        return view('admin.classrooms.show', ['semesters' => $semesters], compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'name'          => 'required|min:4',
            'semesters_id'   => 'required'
        ]);

        //create data classrooms
        Classrooms::findOrFail($id)->update([
            'name'          => $request->name,
            'semesters_id'  => $request->semesters_id
        ]);

        //redirect to index
        return redirect('classrooms')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
