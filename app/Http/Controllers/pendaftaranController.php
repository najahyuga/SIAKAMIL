<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EducationLevels;
use App\Models\FilesUploads;
use App\Models\FormOrtuWali;
use App\Models\FormSiswa;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class pendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educationLevels = EducationLevels::all();
        return view('calonSiswa.formDaftar', compact('educationLevels'));
    }

    /**
     * Menampilkan formulir pendaftaran siswa sesuai dengan formulir kejar paket yang dipilih.
     */
    public function create($education_level)
    {
        // Temukan id education_levels berdasarkan kode paket (paketA, paketB, paketC)
        $educationLevel = EducationLevels::where('name', $education_level)->firstOrFail();

        // Inisialisasi model FormSiswa tanpa menyimpan ke database
        $formSiswa = new FormSiswa();

        return view('calonSiswa.formDaftar', compact('educationLevel', 'formSiswa'));
    }

    public function store(Request $request)
    {
        try {
            // Validasi data untuk FormSiswa
            $validatedData = $request->validate([
                'name'                      => 'required|string|max:255',
                'nis'                       => 'required|string|max:50',
                'nisn'                      => 'required|string|max:50',
                'nik'                       => 'required|string|max:50',
                'noAkteLahir'               => 'required|string|max:50',
                'gender'                    => 'required',
                'tempatLahir'               => 'required|string|max:255',
                'dateOfBirth'               => 'required|date',
                'agama'                     => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
                'anakKe'                    => 'required|integer',
                'jumlahSaudara'             => 'required|integer',
                'address'                   => 'required|string',
                'rt'                        => 'required|string|max:10',
                'rw'                        => 'required|string|max:10',
                'kelurahan'                 => 'required|string|max:255',
                'kecamatan'                 => 'required|string|max:255',
                'kab_kota'                  => 'required|string|max:255',
                'kode_pos'                  => 'required|string|max:10',
                'tempat_tinggal_bersama'    => 'required|in:Orang Tua,Keluarga Asuh,Panti Asuhan,Lainnya',
                'moda_tranportasi'         => 'required|string|max:255',
                'jarak_tempuh'              => 'required|numeric',
                'tb_cm'                     => 'required|numeric',
                'bb_kg'                     => 'required|numeric',
                'noHP'                      => 'required|string|max:20',
                'email'                     => 'required|email|max:255',
                'pekerjaan'                 => 'nullable|string|max:255',
                'tgl_daftar'                => 'required|date',
                'status'                    => 'nullable|in:data-terkirim,diterima,data-checking,daftar-ulang',
                'users_id'                  => 'nullable|exists:users,id',
                'files_uploads_id'          => 'nullable|exists:files_uploads,id',
                'education_levels_id'       => 'required|exists:education_levels,id',

                // table files_uploads
                'path'                      => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ]);

            // Upload new image
            $path = $request->file('path');
            $imagePath = $path->storeAs('public/images', $path->getClientOriginalName());

            // Simpan data ke tabel files_uploads
            $fileUpload = FilesUploads::create(['path' => basename($imagePath)]);

            // Tambahkan files_uploads_id ke data FormSiswa
            $validatedData['files_uploads_id'] = $fileUpload->id;

            // dapatkan users_id dari table users
            $user_id = User::findOrFail(Auth::user()->id);
            $validatedData['users_id'] = $user_id->id;

            // Simpan data FormSiswa
            $formSiswa = FormSiswa::create($validatedData);

            // Validasi data untuk FormOrtuWali
            $validatedOrtuWaliData = $request->validate([
                'name_bapak_wali'       => 'required|string|max:255',
                'nik_bapak_wali'        => 'required|string|max:50',
                'name_ibu_wali'         => 'required|string|max:255',
                'nik_ibu_wali'          => 'required|string|max:50',
                'noHP'                  => 'required|string|max:20',
                'address'               => 'required|string',
                'pekerjaan_bapak_wali'  => 'required|string|max:255',
                'pekerjaan_ibu_wali'    => 'required|string|max:255',
            ]);

            // Tambahkan form_siswa_id ke data FormOrtuWali
            $validatedOrtuWaliData['form_siswa_id'] = $formSiswa->id;

            // Simpan data FormOrtuWali
            FormOrtuWali::create($validatedOrtuWaliData);

            return redirect()->route('calonSiswa.index')->with(['success' => 'Data siswa dan orang tua/wali berhasil disimpan!']);
        } catch (\Exception $th) {
            Log::error("Tidak dapat menyimpan data: " . $th->getMessage());
            return redirect()->back()->with(['error' => 'Tidak dapat menyimpan data'])->withInput();
        }
    }

    public function indexPSB()
    {
        try {
            // Ambil data calon siswa yang belum diterima
            $calonSiswa = FormSiswa::all();
            return view('admin.daftar-siswa-baru', compact('calonSiswa'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data calon siswa: ' . $e->getMessage());
        }
    }

    public function storePSB(Request $request)
    {
        try {
            // Validasi data yang diterima
            $request->validate([
                'form_siswa_id' => 'required|exists:form_siswa,id',
                'status'        => 'required|in:data-terkirim,diterima,data-checking,daftar-ulang',
            ]);

            // Temukan data calon siswa
            $formSiswa = FormSiswa::find($request->form_siswa_id);

            if (!$formSiswa) {
                return redirect()->route('admin.daftar-siswa-baru')->with('error', 'Data calon siswa tidak ditemukan.');
            }

            // Update status siswa
            $formSiswa->status = $request->status;
            $formSiswa->save();

            // Jika status diubah menjadi 'diterima', lakukan proses pendaftaran
            if ($request->status === 'diterima') {
                $siswa = $formSiswa->replicate(); // Duplikat data calon siswa
                $siswa->status = 'diterima'; // Update status siswa
                $siswa->save();

                // Hapus data dari form_ortu_wali jika perlu
                FormOrtuWali::where('form_siswa_id', $formSiswa->id)->delete();

                // Hapus data dari form_siswa
                $formSiswa->delete();
            }

            return redirect()->route('admin.daftar-siswa-baru')->with('success', 'Status siswa berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->route('admin.daftar-siswa-baru')->with('error', 'Terjadi kesalahan saat memperbarui status: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
