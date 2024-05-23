<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EducationLevels;
use App\Models\Teachers;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get data to view index
        $teachers = Teachers::all();
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $education_levels_id = EducationLevels::select('id', 'name')->get();
        return view('admin.teachers.create', ['education_levels_id' => $education_levels_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name'                      => 'required|min:4',
            'address'                   => 'required|min:10',
            'gender'                    => 'required',
            'dateOfBirth'               => 'required',
            'image'                     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'status'                    => 'required',
            'education_levels_id'       => 'required',

            'username'                  => 'required|min:4',
            'email'                     => 'required|min:5|email',
            'password'                  => 'required|min:6',
            'level'                     => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/images', $image->hashName());

        //create data teacher
        $teachers = Teachers::create([
            'name'                      => $request->name,
            'address'                   => $request->address,
            'gender'                    => $request->gender,
            'dateOfBirth'               => $request->dateOfBirth,
            'image'                     => $image->hashName(),
            'status'                    => $request->status,
            'education_levels_id'       => $request->education_levels_id,
        ]);

        // create data user
        User::create([
            'username'      => $request->username,
            'email'         => $request->email,
            'password'      => $request->password,
            'level'         => $request->level,
            'teachers_id'   => $teachers->id
        ]);

        //redirect to index
        return redirect()->route('admin.teacher.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // get data based on id and name
        $education_levels_id = EducationLevels::select('id', 'name')->get();

        // get data based on id and level
        $user = User::select('id', 'level')->get();

        // display data based on ID
        // menampilkan data berdasarkan ID
        $teacher = Teachers::findOrFail($id);

        // mengembalikan ke halaman show
        return view('admin.teachers.show', ['education_levels_id' => $education_levels_id, 'user' => $user], compact(['teacher']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // get data based on id and name
        // menampilkan data berdasarkan ID dan nama jenjang pendidikan
        $education_levels_id = EducationLevels::select('id', 'name')->get();

        // get data based on id and level
        // menampilkan data berdasarkan ID dan level
        $user = User::select('id', 'level')->get();

        // display data based on ID
        // menampilkan data berdasarkan ID
        $teacher = Teachers::findOrFail($id);

        // mengembalikan ke halaman edit
        return view('admin.teachers.edit', ['education_levels_id' => $education_levels_id], compact(['teacher', 'user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'name'                      => 'required|min:4',
            'address'                   => 'required|min:10',
            'gender'                    => 'required',
            'dateOfBirth'               => 'required',
            'image'         => 'image|mimes:jpeg,jpg,png|max:2048',
            'status'                    => 'required',
            'education_levels_id'       => 'required',

            'username'                  => 'required|min:4',
            'email'                     => 'required|min:5|email',
            'password'                  => 'required|min:6',
            'level'                     => 'required'
        ]);

        // get data by id
        $teacher = Teachers::findOrFail($id);

        // cek image apakah diupload
        if ($request->hasFile('image')) {
            // upload image baru
            $image = $request->file('image');
            $image->storeAs('public/images', $image->hashName());

            // delete image lama
            Storage::delete('public/images/'.$teacher->image);

            // update data dengan image baru
            $teacher->update([
                'name'                      => $request->name,
                'address'                   => $request->address,
                'gender'                    => $request->gender,
                'dateOfBirth'               => $request->dateOfBirth,
                'image'                     => $image->hashName(),
                'status'                    => $request->status,
                'education_levels_id'       => $request->education_levels_id
            ]);
        } else {
            // update data tanpa image
            $teacher->update([
                'name'                      => $request->name,
                'address'                   => $request->address,
                'gender'                    => $request->gender,
                'dateOfBirth'               => $request->dateOfBirth,
                'status'                    => $request->status,
                'education_levels_id'       => $request->education_levels_id
            ]);
        }
        // update table user
        if ($teacher->save()) {
            $user = User::findOrFail($id);
            $user->update([
                'username'      => $request->username,
                'email'         => $request->email,
                'password'      => $request->password,
                'level'         => $request->level,
                'teachers_id'   => $teacher->id
            ]);
        }
        $user->save();
        // redirect to index
        return redirect()->route('admin.teacher.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
