<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EducationLevels;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EducationLevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // retrieve data and display on the index page
        // mengambil data dan menampilkan data pada halaman index
        $educationLevels = EducationLevels::all();
        return view('admin.educationLevels.index', compact('educationLevels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.educationLevels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required'
        ]);

        EducationLevels::create([
            'name' => $request->name
        ]);

        // mengembalikan ke halaman index
        return redirect()->route('admin.educationLevels.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // displays data based on ID
        // menampilkan data berdasarkan id
        $educationLevel = EducationLevels::findOrFail($id);

        // mengembalikan ke halaman show
        return view('admin.educationLevels.show', compact('educationLevel'));
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
