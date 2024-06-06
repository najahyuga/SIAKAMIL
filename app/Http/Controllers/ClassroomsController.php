<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classrooms;
use App\Models\Courses;
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
            'semesters_id'   => 'required|exists:semesters,id'
        ]);

        //create data classrooms
        Classrooms::create([
            'name'          => $request->name,
            'semesters_id'  => $request->semesters_id
        ]);

        //redirect to index
        return redirect()->route('admin.classrooms.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Dapatkan data kelas berdasarkan ID
            $classroom = Classrooms::with('semesters', 'courses.masterCourses.master_category_course')->findOrFail($id);

            // Jika kelas tidak ditemukan, lemparkan exception
            if (!$classroom) {
                throw new \Exception('Kelas tidak ditemukan.');
            }

            // Dapatkan data semester selain semester kelas tersebut
            $semesters_id = Semesters::where('id', '!=', $classroom->semesters_id)->get();

            // Kembalikan ke halaman tampilan kelas dengan data yang diperlukan
            return view('admin.classrooms.show', ['semesters_id' => $semesters_id], compact('classroom'));
        } catch (\Exception $e) {
            // Tangani exception jika kelas tidak ditemukan
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // displays data based on ID
        // menampilkan data berdasarkan id
        $classroom = Classrooms::with('semesters')->findOrFail($id);

        // get data
        // mendapatkan data
        $semesters = Semesters::where('id', '!=', $classroom->semesters)->get();

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
            'semesters_id'   => 'required|exists:semesters,id'
        ]);

        //create data classrooms
        Classrooms::findOrFail($id)->update([
            'name'          => $request->name,
            'semesters_id'  => $request->semesters_id
        ]);

        //redirect to index
        return redirect()->route('admin.classrooms.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
