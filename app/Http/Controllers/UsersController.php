<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teachers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // get all data to display to index page
            $users = User::all();

            // mengembalikan ke halaman index
            return view('admin.users.index', compact('users'));
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
            // get data to display in create page
            $user = User::all();

            // mengembalikan ke halaman create
            return view('admin.users.create');
        } catch (\Throwable $th) {
            Log::error("Tidak dapat menyimpan data ". $th->getMessage());
            response()->json([
                'status'    => false,
                'message'   => 'Tidak dapat menyimpan data'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // validate form
            $request->validate([
                'username'                  => 'required|min:4',
                'email'                     => 'required|min:5|email',
                'password'                  => 'required|min:6',
                'level'                     => 'required'
            ]);

            // create data user
            User::create([
                'username'      => $request->username,
                'email'         => $request->email,
                'password'      => $request->password,
                'level'         => $request->level
            ]);

            // mengembalikan ke halaman index
            return redirect('users')->with(['success' => 'Data Berhasil Disimpan!']);
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
            // get data to display in show page
            $user = User::findOrFail($id);

            $teacher = Teachers::select('id', 'name');

            // mengembalikan ke halaman show
            return view('admin.users.show', ['teacher' => $teacher], compact('user'));
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
            // get data to display in edit page
            $user = User::findOrFail($id);

            // mengembalikan ke halaman edit
            return view('admin.users.edit', compact(['user']));
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
            // validate form
            $request->validate([
                'username'                  => 'required|min:4',
                'email'                     => 'required|min:5|email',
                'password'                  => 'required|min:6',
                'level'                     => 'required'
            ]);

            // update data user
            $user = User::findOrFail($id);
            $user->update([
                'username'      => $request->username,
                'email'         => $request->email,
                'password'      => $request->password,
                'level'         => $request->level
            ]);

            // mengembalikan ke halaman index
            return redirect('users')->with(['success' => 'Data Berhasil Diubah!']);
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
