<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classrooms;
use App\Models\Courses;
use App\Models\HistoryStudentClassroom;
use App\Models\Semesters;
use App\Models\Students;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            $classroom = Classrooms::with('semesters', 'courses', 'courses.masterCourses.master_category_course', 'students')->findOrFail($id);

            // Jika kelas tidak ditemukan, lemparkan exception
            if (!$classroom) {
                throw new \Exception('Kelas tidak ditemukan.');
            }

            // Ambil teachers_id dan nama teacher dari courses yang memiliki classrooms_id sesuai dengan kelas yang ditemukan
            $course = Courses::where('classrooms_id', $classroom->id)->with('teachers')->first();

            // Jika tidak ada data course yang sesuai
            if (!$course) {
                $teacher_name = null; // null jika data guru tidak tersedia
            } else {
                // Ambil nama guru dari relasi teachers
                $teacher_name = optional($course->teachers)->name;
            }

            // Dapatkan data semester selain semester kelas tersebut
            $semesters_id = Semesters::where('id', '!=', $classroom->semesters_id)->get();

            // Kembalikan ke halaman tampilan kelas dengan data yang diperlukan
            return view('admin.classrooms.show', [
                'classroom'     => $classroom,
                'semesters_id'  => $semesters_id,
                'teacher_name'  => $teacher_name, // Mengambil nama teacher
            ]);
        } catch (\Throwable $th) {
            Log::error("Tidak dapat mengambil data ". $th->getMessage());
            return response()->json([
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

    public function showSelectClassroomForm()
    {
        $classrooms = Classrooms::all();
        $students = Students::with('classrooms')->get();
        return view('admin.classrooms.select-classroom', compact('classrooms', 'students'));
    }

    public function selectClassroom(Request $request)
    {
        $request->validate([
            'students_id' => 'required|exists:students,id',
            'classrooms_id' => 'required|exists:classrooms,id',
        ]);

        try {
            $student = Students::findOrFail($request->students_id);
            $newClassroom = Classrooms::findOrFail($request->classrooms_id);

            // Simpan data lama ke history
            if ($student->classrooms()->exists()) {
                foreach ($student->classrooms as $classroom) {
                    HistoryStudentClassroom::create([
                        'classrooms_id' => $classroom->id,
                        'students_id' => $student->id,
                    ]);
                }
            }

            // Assign the new classroom to the student
            $student->classrooms()->syncWithoutDetaching([$newClassroom->id]);

            return redirect()->back()->with('success', 'Classroom updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'There was an error updating the classroom: ' . $e->getMessage());
        }
    }

    public function getStudentsByClassroom($classroom_id)
    {
        $students = Students::whereHas('classrooms', function($query) use ($classroom_id) {
            $query->where('classrooms.id', $classroom_id);
        })->get();

        return response()->json($students);
    }
}
