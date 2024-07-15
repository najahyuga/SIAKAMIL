<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - SIAKAMIL</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('frontend/assets/img/logopkbm.jpeg')}}" rel="icon">
    <link href="{{asset('frontend/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{asset('frontend/assets/css/main.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    {{-- <style>
        .mySlides {display:none;}
    </style> --}}

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">

    <link rel="stylesheet" href="{{asset('frontend/assets/css/wizard.css')}}">
</head>

<body>

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="{{ route('calonSiswa.') }}" class="logo d-flex align-items-center me-auto">
                <img src="{{asset('frontend/assets/img/logopkbm.jpeg')}}" alt="SIAKAMIL">
                <h1 class="">SIAKAMIL</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('calonSiswa.') }}" class="active">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="courses.html">Courses</a></li>
                    <li><a href="trainers.html">Tutor</a></li>
                    <li><a href="events.html">Events</a></li>
                    <li class="dropdown has-dropdown"><a href="#"><span>Pendaftaran</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('calonSiswa.pendaftaran.create', ['education_level' => 'Paket A Setara SD']) }}">Formulir Kejar Paket A</a></li>
                            <li><a href="{{ route('calonSiswa.pendaftaran.create', ['education_level' => 'Paket B Setara SMP']) }}">Formulir Kejar Paket B</a></li>
                            <li><a href="{{ route('calonSiswa.pendaftaran.create', ['education_level' => 'Paket C Setara SMA']) }}">Formulir Kejar Paket C</a></li>
                        </ul>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            @if(Auth::check())
                <a class="btn-getstarted" href="{{ route('logout') }}">LOGOUT</a>
            @else
                <a class="btn-getstarted" href="{{ route('login') }}">LOGIN</a>
            @endif
        </div>
    </header>

    <main class="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                        <h2 id="heading">Formulir Pendaftaran Siswa - {{ $educationLevel->name }}</h2>
                        <p>Isi semua kolom formulir untuk melanjutkan ke langkah berikutnya</p>

                        <form id="msform" method="POST" action="{{ route('calonSiswa.pendaftaran.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- progressbar -->
                            <ul id="progressbar" style="font-size: 12px;">
                                <li class="active" id="account"><strong>Data Siswa - 1</strong></li>
                                <li id="personal"><strong>Data Siswa - 2</strong></li>
                                <li id="payment"><strong>Data Siswa - 3</strong></li>
                                <li id="account"><strong>Ortu/Wali - 1</strong></li>
                                <li id="personal"><strong>Ortu/Wali - 2</strong></li>
                                <li id="confirm"><strong>Konfirmasi</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <br>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Informasi Data Siswa (1):</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Langkah 1 - 6</h2>
                                        </div>
                                    </div>
                                    <!-- Input fields untuk FormSiswa - Bagian 1 -->
                                    <input type="text" name="users_id" value="{{ Auth::user()->id }}" disabled>
                                    <div class="form-group">
                                        <label class="fieldlabels">Nama Lengkap: *</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('name') }}" required/>
                                        <!-- error message untuk name -->
                                        @error('name')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">NIS: *</label>
                                        <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror" placeholder="NIS" required/>
                                        <!-- error message untuk nis -->
                                        @error('nis')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">NISN: *</label>
                                        <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" placeholder="NISN" required/>
                                        <!-- error message untuk nisn -->
                                        @error('nisn')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">NIK: *</label>
                                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="NIK" required/>
                                        <!-- error message untuk nik -->
                                        @error('nik')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">No. Akte Lahir: *</label>
                                        <input type="text" name="noAkteLahir" class="form-control @error('noAkteLahir') is-invalid @enderror" placeholder="No. Akte Lahir" required/>
                                        <!-- error message untuk noAkteLahir -->
                                        @error('noAkteLahir')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Jenis Kelamin: *</label>
                                        <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-Laki" @if(old('gender') == 'Laki-Laki') selected @endif>Laki-laki</option>
                                            <option value="Perempuan" @if(old('gender') == 'Perempuan') selected @endif>Perempuan</option>
                                        </select>
                                        <!-- error message untuk gender -->
                                        @error('gender')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- Hidden input untuk education_levels_id -->
                                    <input type="hidden" name="education_levels_id" value="{{ $educationLevel->id }}"/>
                                </div>
                                <!-- Tombol next untuk melanjutkan -->
                                <input type="button" name="next" class="next action-button" value="Next"/>
                            </fieldset>

                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Informasi Data Siswa (2):</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Langkah 2 - 6</h2>
                                        </div>
                                    </div>
                                    <!-- Input fields untuk FormSiswa - Bagian 2 -->
                                    <div class="form-group">
                                        <label class="font-weight-bold">Foto: *</label>
                                        <!-- Tampilkan gambar pratinjau -->
                                        {{-- <div id="imagePreview" class="mt-0 mb-1"></div> --}}
                                        <input type="file" class="form-control @error('path') is-invalid @enderror" name="path" onchange="previewImage(this)">

                                        <!-- error message untuk image -->
                                        @error('path')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Tempat Lahir: *</label>
                                        <input type="text" name="tempatLahir" class="form-control @error('tempatLahir') is-invalid @enderror" placeholder="Tempat Lahir" required/>
                                        <!-- error message untuk tempatLahir -->
                                        @error('tempatLahir')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Tanggal Lahir: *</label>
                                        <input type="date" name="dateOfBirth" class="form-control @error('dateOfBirth') is-invalid @enderror" required/>
                                        <!-- error message untuk dateOfBirth -->
                                        @error('dateOfBirth')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Agama: *</label>
                                        <select name="agama" class="form-control @error('agama') is-invalid @enderror" required>
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam" @if(old('agama') == 'Islam') selected @endif>Islam</option>
                                            <option value="Kristen" @if(old('agama') == 'Kristen') selected @endif>Kristen</option>
                                            <option value="Katolik" @if(old('agama') == 'Katolik') selected @endif>Katolik</option>
                                            <option value="Hindu" @if(old('agama') == 'Hindu') selected @endif>Hindu</option>
                                            <option value="Buddha" @if(old('agama') == 'Buddha') selected @endif>Buddha</option>
                                            <option value="Konghucu" @if(old('agama') == 'Konghucu') selected @endif>Konghucu</option>
                                            <option value="Lainnya" @if(old('agama') == 'Lainnya') selected @endif>Lainnya</option>
                                        </select>
                                        <!-- error message untuk agama -->
                                        @error('agama')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Anak Ke: *</label>
                                        <input type="number" name="anakKe" class="form-control @error('anakKe') is-invalid @enderror" placeholder="Anak Ke" required/>
                                        <!-- error message untuk anakKe -->
                                        @error('anakKe')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Jumlah Saudara: *</label>
                                        <input type="number" name="jumlahSaudara" class="form-control @error('jumlahSaudara') is-invalid @enderror" placeholder="Jumlah Saudara" required/>
                                        <!-- error message untuk jumlahSaudara -->
                                        @error('jumlahSaudara')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Tombol next dan previous untuk melanjutkan atau kembali -->
                                <input type="button" name="next" class="next action-button" value="Next"/>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Informasi Data Siswa (3):</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Langkah 3 - 6</h2>
                                        </div>
                                    </div>
                                    <!-- Input fields untuk FormSiswa - Bagian 3 -->
                                    <div class="form-group">
                                        <label class="fieldlabels">Alamat: *</label>
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Alamat" required/>
                                        <!-- error message untuk address -->
                                        @error('address')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">RT: *</label>
                                        <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror" placeholder="RT" required/>
                                        <!-- error message untuk rt -->
                                        @error('rt')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">RW: *</label>
                                        <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror" placeholder="RW" required/>
                                        <!-- error message untuk rw -->
                                        @error('rw')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Kelurahan: *</label>
                                        <input type="text" name="kelurahan" class="form-control @error('kelurahan') is-invalid @enderror" placeholder="Kelurahan" required/>
                                        <!-- error message untuk kelurahan -->
                                        @error('kelurahan')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Kecamatan: *</label>
                                        <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" placeholder="Kecamatan" required/>
                                        <!-- error message untuk kecamatan -->
                                        @error('kecamatan')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Kabupaten/Kota: *</label>
                                        <input type="text" name="kab_kota" class="form-control @error('kab_kota') is-invalid @enderror" placeholder="Kabupaten/Kota" required/>
                                        <!-- error message untuk kab_kota -->
                                        @error('kab_kota')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Kode Pos: *</label>
                                        <input type="text" name="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror" placeholder="Kode Pos" required/>
                                        <!-- error message untuk kode_pos -->
                                        @error('kode_pos')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Tempat Tinggal Bersama: *</label>
                                        <select name="tempat_tinggal_bersama" class="form-control @error('tempat_tinggal_bersama') is-invalid @enderror" required>
                                            <option value="Orang Tua" @if(old('tempat_tinggal_bersama') == 'Orang Tua') selected @endif>Orang Tua</option>
                                            <option value="Wali" @if(old('tempat_tinggal_bersama') == 'Wali') selected @endif>Wali</option>
                                            <option value="Kost" @if(old('tempat_tinggal_bersama') == 'Kost') selected @endif>Kost</option>
                                            <option value="Panti Asuhan" @if(old('tempat_tinggal_bersama') == 'Panti Asuhan') selected @endif>Panti Asuhan</option>
                                            <option value="Lainnya" @if(old('tempat_tinggal_bersama') == 'Lainnya') selected @endif>Lainnya</option>
                                        </select>
                                        <!-- error message untuk tempat_tinggal_bersama -->
                                        @error('tempat_tinggal_bersama')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Moda Transportasi: *</label>
                                        <select name="moda_tranportasi" class="form-control @error('moda_tranportasi') is-invalid @enderror" required>
                                            <option value="Jalan Kaki" @if(old('moda_tranportasi') == 'Jalan Kaki') selected @endif>Jalan Kaki</option>
                                            <option value="Kendaraan Pribadi" @if(old('moda_tranportasi') == 'Kendaraan Pribadi') selected @endif>Kendaraan Pribadi</option>
                                            <option value="Kendaraan Umum" @if(old('moda_tranportasi') == 'Kendaraan Umum') selected @endif>Kendaraan Umum</option>
                                            <option value="Antar Jemput Sekolah" @if(old('moda_tranportasi') == 'Antar Jemput Sekolah') selected @endif>Antar Jemput Sekolah</option>
                                            <option value="Lainnya" @if(old('moda_tranportasi') == 'Lainnya') selected @endif>Lainnya</option>
                                        </select>
                                        <!-- error message untuk moda_tranportasi -->
                                        @error('moda_tranportasi')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Jarak Tempuh: *</label>
                                        <input type="number" step="0.01" name="jarak_tempuh" class="form-control @error('jarak_tempuh') is-invalid @enderror" placeholder="Jarak Tempuh" required/>
                                        <!-- error message untuk jarak_tempuh -->
                                        @error('jarak_tempuh')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Tinggi Badan (cm): *</label>
                                        <input type="number" step="0.01" name="tb_cm" class="form-control @error('tb_cm') is-invalid @enderror" placeholder="Tinggi Badan" required/>
                                        <!-- error message untuk tb_cm -->
                                        @error('tb_cm')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Berat Badan (kg): *</label>
                                        <input type="number" step="0.01" name="bb_kg" class="form-control @error('bb_kg') is-invalid @enderror" placeholder="Berat Badan" required/>
                                        <!-- error message untuk bb_kg -->
                                        @error('bb_kg')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Nomor HP: *</label>
                                        <input type="text" class="form-control @error('noHP') is-invalid @enderror" name="noHP" placeholder="Masukkan Nomor HP Anda!">

                                        <!-- error message untuk noHP -->
                                        @error('noHP')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Email: *</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan Email Anda!">

                                        <!-- error message untuk email -->
                                        @error('email')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Pekerjaan:</label>
                                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" name="pekerjaan" placeholder="Pekerjaan!">

                                        <!-- error message untuk pekerjaan -->
                                        @error('pekerjaan')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Tanggal Daftar: *</label>
                                        <input type="date" name="tgl_daftar" class="form-control @error('tgl_daftar') is-invalid @enderror" required readonly/>
                                        <!-- error message untuk tgl_daftar -->
                                        @error('tgl_daftar')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Status Data Formulir: </label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror" required disabled>
                                            <option value="data-terkirim" @if(old('status') == 'data-terkirim') selected @endif>Data Terkirim</option>
                                            <option value="diterima" @if(old('status') == 'diterima') selected @endif>Data Formulir Di Terima</option>
                                            <option value="data-checking" @if(old('status') == 'data-checking') selected @endif>Pengecekan Data</option>
                                            <option value="daftar-ulang" @if(old('status') == 'daftar-ulang') selected @endif>Silahkan Daftar Ulang Ke Sekolah</option>
                                        </select>
                                        <!-- error message untuk status -->
                                        @error('status')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Tombol next dan previous untuk melanjutkan atau kembali -->
                                <input type="button" name="next" class="next action-button" value="Next"/>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Informasi Orang Tua/Wali (1):</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Langkah 4 - 6</h2>
                                        </div>
                                    </div>
                                    <!-- Input fields untuk FormOrtuWali -->
                                    <div class="form-group">
                                        <label class="fieldlabels">Nama Bapak/Wali: *</label>
                                        <input type="text" name="name_bapak_wali" class="form-control @error('name_bapak_wali') is-invalid @enderror" placeholder="Nama Bapak/Wali" required/>
                                        <!-- error message untuk name_bapak_wali -->
                                        @error('name_bapak_wali')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">NIK Bapak/Wali: *</label>
                                        <input type="text" name="nik_bapak_wali" class="form-control @error('nik_bapak_wali') is-invalid @enderror" placeholder="NIK Bapak/Wali" required/>
                                        <!-- error message untuk nik_bapak_wali -->
                                        @error('nik_bapak_wali')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Nama Ibu/Wali:</label>
                                        <input type="text" name="name_ibu_wali" class="form-control @error('name_ibu_wali') is-invalid @enderror" placeholder="Nama Ibu/Wali" required/>
                                        <!-- error message untuk name_ibu_wali -->
                                        @error('name_ibu_wali')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">NIK Ibu/Wali:</label>
                                        <input type="text" name="nik_ibu_wali" class="form-control @error('nik_ibu_wali') is-invalid @enderror" placeholder="NIK Ibu/Wali" required/>
                                        <!-- error message untuk nik_ibu_wali -->
                                        @error('nik_ibu_wali')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Tombol next dan previous untuk melanjutkan atau kembali -->
                                <input type="button" name="next" class="next action-button" value="Next"/>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                            </fieldset>

                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Informasi Orang Tua/Wali (2):</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Langkah 5 - 6</h2>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">No. HP Orang Tua/Wali: *</label>
                                        <input type="text" class="form-control @error('noHP_ortu_wali') is-invalid @enderror" name="noHP_ortu_wali" placeholder="Masukkan Nomor HP Orang Tua/Wali!">

                                        <!-- error message untuk noHP_ortu_wali -->
                                        @error('noHP_ortu_wali')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Alamat Orang Tua/Wali: *</label>
                                        <input type="text" class="form-control @error('address_ortu_wali') is-invalid @enderror" name="address_ortu_wali" placeholder="Alamat Orang Tua/Wali!">

                                        <!-- error message untuk address_ortu_wali-->
                                        @error('address_ortu_wali')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Pekerjaan Bapak/Wali: *</label>
                                        <input type="text" class="form-control @error('pekerjaan_bapak_wali') is-invalid @enderror" name="pekerjaan_bapak_wali" placeholder="Pekerjaan Bapak/Wali!">

                                        <!-- error message untuk pekerjaan_bapak_wali-->
                                        @error('pekerjaan_bapak_wali')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels">Pekerjaan Ibu/Wali: *</label>
                                        <input type="text" class="form-control @error('pekerjaan_ibu_wali') is-invalid @enderror" name="pekerjaan_ibu_wali" placeholder="Pekerjaan Ibu/Wali!">

                                        <!-- error message untuk pekerjaan_ibu_wali-->
                                        @error('pekerjaan_ibu_wali')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Hidden input untuk form_siswa_id -->
                                    {{-- <input type="hidden" name="form_siswa_id" value="{{ $formSiswa->id }}"/> --}}
                                </div>
                                <input type="button" name="next" class="next action-button" value="Next"/>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                            </fieldset>

                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Konfirmasi:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Langkah 6 - 6</h2>
                                        </div>
                                    </div>
                                    <br><br>
                                    <h2 class="purple-text text-center"><strong>Data Telah Anda Lengkapi !</strong></h2>
                                    <br>
                                    <div class="row justify-content-center">
                                        <div class="col-3">
                                            <img src="https://i.imgur.com/GwStPmg.png" class="fit-image">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5 class="purple-text text-center">Silahkan Tekan Tombol Submit dan Data Akan Di Proses Oleh Admin</h5>
                                            {{-- <h5 class="purple-text text-center">Anda Berhasil Mengisi Formulir dan Data Akan Di Proses Oleh Admin</h5> --}}
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                const today = new Date().toISOString().split('T')[0];
                document.querySelector('input[name="tgl_daftar"]').value = today;
            });
        </script>
    </main>

    <footer id="footer" class="footer position-relative">
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1">SiteName</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{asset('frontend/assets/js/main.js')}}"></script>

    <!-- library sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    {{-- <script>
        $(document).ready(function(){

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;

        $(".next").click(function(){

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({'opacity': opacity});
                },
                duration: 600
            });
        });

        $(".previous").click(function(){

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({'opacity': opacity});
                },
                duration: 600
            });
        });

        $('.radio-group .radio').click(function(){
            $(this).parent().find('.radio').removeClass('selected');
            $(this).addClass('selected');
        });

        $(".submit").click(function(){
            return false;
        })

        });
    </script> --}}
    <script>
        $(document).ready(function(){

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function(){

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({'opacity': opacity});
                },
                duration: 500
            });
            setProgressBar(++current);
        });

        $(".previous").click(function(){

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({'opacity': opacity});
                },
                duration: 500
            });
            setProgressBar(--current);
        });

        function setProgressBar(curStep){
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
            .css("width",percent+"%")
        }

        $(".submit").click(function(){
            return false;
        })

        });
    </script>

    <!-- session success &  error -->
    <script>
        $(document).ready(function () {
            var currentStep = 0;
            var steps = $(".wizard-step");

            function showStep(step) {
                steps.removeClass("active");
                $(steps[step]).addClass("active");
            }

            $(".next-step").click(function () {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            $(".prev-step").click(function () {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            $(".submit-wizard").click(function () {
                alert("Wizard Submitted!");
                // You can add form submission logic here
            });

            showStep(currentStep);
        });

        var myIndex = 0;
        carousel();

        function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}
        x[myIndex-1].style.display = "block";
        setTimeout(carousel, 2000); // Change image every 2 seconds
        }

        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>
