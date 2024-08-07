<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Guru - Management Siswa - SIAKAMIL</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="{{ asset('backend/assets/img/logopkbm.jpeg') }}" rel="icon" />
    <link href="{{ asset('backend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="/guru" class="logo d-flex align-items-center">
                <img src="{{ asset('backend/assets/img/logopkbm.jpeg') }}" alt="IMAGELOGO" />
                <span class="d-none d-lg-block">SIAKAMIL</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item pe-3">
                    <div class="nav-item mb-0">
                        <span class="d-lg-block d-none" id="dateTime"></span>
                    </div>
                </li>

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        @if (in_array(session('current_role'),['admin','guru']))
                            <img src="{{ asset('storage/images/'. Auth::user()->teacher->files_uploads->path) }}" alt="Guru" class="rounded-circle" />
                        @elseif (in_array(session('current_role'),['siswa']))
                            <img src="{{ asset('storage/images/'. Auth::user()->student->files_uploads->path) }}" alt="Guru" class="rounded-circle" />
                        @endif
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->username }}</span>
                    </a><!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->username }}</h6>
                            <span>{{ session('current_role') }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li class="dropdown-header">
                            <h6>Pindah Akun</h6>
                        </li>
                        @foreach (Auth::user()->roles as $role)
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="" onclick="event.preventDefault(); document.getElementById('switch-role-{{ $role->level }}').submit();">
                                    <i class="bi bi-people"></i>
                                    <span>{{ ucfirst($role->level) }}</span>
                                    @if ($role->level == 'guru')
                                        <span class="badge bg-primary rounded-pill ms-auto">{{ ucfirst($role->level) }}</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill ms-auto">{{ ucfirst($role->level) }}</span>
                                    @endif
                                </a>
                                <form id="switch-role-{{ $role->level }}" action="{{ route('switch-role') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="role" value="{{ $role->level }}">
                                </form>
                            </li>
                        @endforeach

                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul><!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->
            </ul>
        </nav>
        <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <!-- Start Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="/guru">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

                <!-- Start Management Presences Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#Presences-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Presences</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="Presences-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/guru/presences" >
                            <i class="bi bi-circle"></i><span>Presences Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/guru/presences/create" >
                            <i class="bi bi-circle"></i><span>Insert Presences Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management Presences Nav -->

            <!-- Start Management Students Nav -->
            <li class="nav-item">
                <a class="nav-link " data-bs-target="#students-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Management Students</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="students-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/guru/students" class="active">
                            <i class="bi bi-circle"></i><span>Students Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="/guru/students/create">
                            <i class="bi bi-circle"></i><span>Insert Student Data</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Management Students Nav -->

            <!-- Start Management Tasks Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#task-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Management Tasks</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="task-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/guru/tasks">
                            <i class="bi bi-circle"></i><span>Tasks Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="/guru/tasks/create">
                            <i class="bi bi-circle"></i><span>Insert Task Data</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Management Tasks Nav -->

            <li class="nav-heading">Pages</li>

            <!-- Start Profile Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="/profile">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->
        </ul>
    </aside>
    <!-- End Sidebar-->

    <main id="main" class="main">
        <!-- Start Page Title -->
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/guru">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/guru/students">Students Data</a></li>
                    <li class="breadcrumb-item active">Show Student Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @if ($student->files_uploads->path != '')
                                <img src="{{ asset('/storage/images/' . $student->files_uploads->path) }}" class="rounded-circle" style="width: 70%" alt="image">
                                <h2>{{ $student->name }}</h2>
                                <div class="social-links mt-2">
                                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                </div>
                            @else
                                @if ($student->gender == 'Laki-Laki')
                                    <img src="{{ asset('imgDefault/man.png') }}" class="rounded-circle" style="width: 70%" alt="image">
                                    <h2>{{ $student->name }}</h2>
                                    <div class="social-links mt-2">
                                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                    </div>
                                @elseif ($student->gender == 'Perempuan')
                                    <img src="{{ asset('imgDefault/muslimah.png') }}" class="rounded-circle" style="width: 70%" alt="image">
                                    <h2>{{ $student->name }}</h2>
                                    <div class="social-links mt-2">
                                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h4 class="card-title">Profile Details</h4>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label ">Nomor Induk Kependudukan</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->nik }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label ">Nomor Akte Lahir</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->noAkteLahir }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label ">Nomor Induk Siswa</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->nis }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label ">Nomor Induk Siswa Nasional</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->nisn }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label ">Nomor HP</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->noHP }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label ">Agama</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->agama }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label">Jenis Kelamin</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->gender }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label">Tanggal Lahir</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->dateOfBirth }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label ">Alamat</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->address }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label">Status</div>
                                        <div class="col-lg-6 col-md-8">
                                            @if ($student->status == 'active')
                                                <span class="badge rounded-pill bg-success">Active</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">Non-Active</span>
                                            @endif
                                        </div>
                                    </div>

                                    <h6 class="card-title">Akun Profile Details</h6>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label">Username Akun</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->user->username }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label">Email Akun</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->user->email }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label">Level</div>
                                        <div class="col-lg-6 col-md-8">
                                            @foreach ($student->user->roles as $role)
                                                @if ($role->level == 'admin')
                                                    <span class="badge rounded-pill bg-success">Admin</span>
                                                @elseif ($role->level == 'guru')
                                                    <span class="badge rounded-pill bg-primary">Guru</span>
                                                @elseif ($role->level == 'siswa')
                                                    <span class="badge rounded-pill bg-info">Siswa</span>
                                                @elseif ($role->level == 'calonSiswa')
                                                    <span class="badge rounded-pill bg-secondary">Calon Siswa</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <h6 class="card-title">Jenjang Pendidikan Yang Diambil</h6>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label">Jenjang Pendidikan</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->education_levels->name }}</div>
                                    </div>

                                    <h6 class="card-title">Kelas Yang Diambil</h6>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label">Kelas</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->classrooms->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-4 label">Semester</div>
                                        <div class="col-lg-6 col-md-8">{{ $student->classrooms->semesters->name }}</div>
                                    </div>
                                </div>

                                <!-- Start Profile Edit Form -->
                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <form action="{{ route('guru.students.update', $student->id) }}" method="POST" enctype="multipart/form-data" id="updateForm">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                @if ($student->files_uploads_id)
                                                    <img src="{{ asset('/storage/images/' . $student->files_uploads->path) }}" class="rounded" style="width: 30%" alt="Profile Image"><br>
                                                @else
                                                    <p>No profile image available</p>
                                                @endif
                                                <span class="badge bg-danger mb-1 mt-1"><i class="bi bi-exclamation-octagon pe-2"></i>Maximum Size 2 MB</span>
                                                <div class="pt-1">
                                                    <label for="file_upload_id" class="btn btn-primary btn-sm" title="Upload new profile image">
                                                        <input type="file" id="file_upload_id" style="display:none" name='path'>
                                                        <i class="bi bi-upload" onclick="_upload()"></i> Upload
                                                    </label>
                                                    {{-- <a href="" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $student->name) }}" placeholder="Masukkan Nama Anda!">
                                            </div>
                                            <!-- error message untuk nama -->
                                            @error('name')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Nomor Induk Kependudukan</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nik" type="number" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $student->nik) }}" placeholder="Masukkan Nomor Induk Kependudukan Anda!">
                                            </div>
                                            <!-- error message untuk nama -->
                                            @error('nik')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Nomor Akte Lahir</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="number" class="form-control @error('noAkteLahir') is-invalid @enderror" name="noAkteLahir" value="{{ old('noAkteLahir', $student->noAkteLahir) }}" placeholder="Masukkan Nomor Akte Lahir Anda!">
                                            </div>

                                            <!-- error message untuk noAkteLahir -->
                                            @error('noAkteLahir')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Nomor Induk Siswa</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="number" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{ old('nis', $student->nis) }}" placeholder="Masukkan Nomor Induk Siswa Anda!">
                                            </div>

                                            <!-- error message untuk nik -->
                                            @error('nis')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Nomor Induk Siswa Nasional</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="number" class="form-control @error('nisn') is-invalid @enderror" name="nisn" value="{{ old('nisn', $student->nisn) }}" placeholder="Masukkan Nomor Induk Siswa Nasional Anda!">
                                            </div>

                                            <!-- error message untuk nik -->
                                            @error('nisn')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Nomor HP</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" class="form-control" id="noHP" name="noHP" value="{{ old('noHP', $student->noHP) }}" placeholder="Masukkan Nomor HP Anda!" aria-describedby="noHPHelpBlock">
                                                <div id="noHPHelpBlock" class="form-text text-muted">
                                                    Nomor HP harus berupa angka, bisa diawali dengan tanda plus (+) dan terdiri dari 10 hingga 15 digit.
                                                </div>
                                            </div>
                                            <!-- error message untuk nik -->
                                            @error('noHP')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Agama</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select class="form-select @error('agama') is-invalid @enderror" name="agama" aria-label="Pilih Agama">
                                                    <option selected>Pilih Agama</option>
                                                    <option value="islam" {{ $student->agama == 'islam' ? 'selected' : '' }}>Islam</option>
                                                    <option value="kristen" {{ $student->agama == 'kristen' ? 'selected' : '' }}>Kristen</option>
                                                    <option value="katolik" {{ $student->agama == 'katolik' ? 'selected' : '' }}>Katolik</option>
                                                    <option value="buddha" {{ $student->agama == 'buddha' ? 'selected' : '' }}>Buddha</option>
                                                    <option value="hindu" {{ $student->agama == 'hindu' ? 'selected' : '' }}>Kristen</option>
                                                    <option value="khonghucu" {{ $student->agama == 'khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                                                </select>
                                            </div>
                                            <!-- error message untuk agama -->
                                            @error('agama')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="address" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Masukkan Alamat Anda!">{{ old('address', $student->address) }}</textarea>
                                            </div>

                                            <!-- error message untuk alamat -->
                                            @error('address')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select class="form-select @error('gender') is-invalid @enderror" name="gender" aria-label="Default select example">
                                                    <option selected>Pilih Jenis kelamin</option>
                                                    <option value="Laki-Laki" {{ $student->gender == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                                    <option value="Perempuan" {{ $student->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                            </div>
                                            <!-- error message untuk jenis kelamin -->
                                            @error('gender')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Tanggal Lahir</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="date" class="form-control @error('dateOfBirth') is-invalid @enderror" name="dateOfBirth" value="{{ old('dateOfBirth', $student->dateOfBirth) }}" placeholder="Masukkan Tanggal Lahir Anda!">
                                            </div>
                                            <!-- error message untuk Tanggal Lahir -->
                                            @error('dateOfBirth')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Status Keaktifan
                                            </label>
                                            <div class="col-md-8 col-lg-9">
                                                <span class="badge bg-success mb-1"><i class="bi bi-exclamation-octagon"></i>Default Active</span>
                                                <select class="form-select @error('status') is-invalid @enderror" name="status" aria-label="Default select example">
                                                    <option>Status Keaktifan</option>
                                                    <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="non-active" {{ $student->status == 'non-active' ? 'selected' : '' }}>Non-Active</option>
                                                </select>
                                            </div>
                                            <!-- error message untuk jenis kelamin -->
                                            @error('status')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- form input to users tabel --}}
                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Username</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $student->user->username) }}" placeholder="Masukkan Username Anda!">
                                            </div>
                                            <!-- error message untuk name -->
                                            @error('username')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $student->user->email) }}" placeholder="Masukkan Email Anda!">
                                            </div>
                                            <!-- error message untuk name -->
                                            @error('email')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <span class="badge bg-danger mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Minimal 6 Karakter</span>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', $student->user->password) }}" placeholder="Masukkan Password Anda!">
                                            </div>
                                            <!-- error message untuk name -->
                                            @error('password')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold">Role Levels</label>
                                            @foreach ($roles as $role)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="level[]" value="{{ $role->id }}" id="role{{ $role->id }}" @if ($student->user->roles->contains($role->id)) checked @endif>
                                                    <label class="form-check-label" for="role{{ $role->id }}">{{ $role->level }}</label>
                                                </div>
                                            @endforeach
                                            <!-- error message untuk roles -->
                                            @error('roles')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Jenjang Pendidikan</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select class="form-select @error('education_levels_id') is-invalid @enderror" name="education_levels_id" aria-label="Default select example">
                                                    <option value="{{ $student->education_levels->id }}">{{ $student->education_levels->name }}</option>
                                                    @foreach ($education_levels as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- error message untuk jenis kelamin -->
                                            @error('education_levels_id')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="classrooms_id">Pilih Kelas</label>
                                            <select name="classrooms_id" id="classrooms_id" class="form-select">
                                                <option value="{{ $student->classrooms->id }}">{{ $student->classrooms->name }} / {{ $student->classrooms->semesters->name }}</option>
                                                @foreach ($classrooms as $classroom)
                                                    <option value="{{ $classroom->id }}">{{ $classroom->name }} / {{ $classroom->semesters->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3 custom-checkbox">
                                            <label class="font-weight-bold">Pilih Master Kategori Pelajaran</label>
                                            <div class="row">
                                                @php $count = 0; @endphp
                                                @foreach ($master_category_courses_id as $master_category)
                                                    <div class="col-md-6">
                                                        <p class="font-weight-bold">{{ $master_category->name }}</p>
                                                        @foreach ($master_category->masterCourses as $master_course)
                                                            <div class="form-check">
                                                                <input class="form-check-input course-checkbox" type="checkbox" value="{{ $master_course->id }}" name="master_courses_id[]" id="master_course_{{ $master_course->id }}" {{ $student->courses->pluck('id')->intersect($master_course->courses->pluck('id'))->isNotEmpty() ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label" for="master_course_{{ $master_course->id }}">
                                                                    {{ $master_course->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    @php $count++; @endphp
                                                    @if ($count % 2 == 0)
                                            </div>
                                            <div class="row">
                                                @endif
                                                @endforeach
                                            </div>
                                            <!-- error message untuk Pilih Master Kategori Pelajaran -->
                                            @error('master_courses_id')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- <div class="row mb-3">
                                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="email" type="email" class="form-control" id="Email" value="k.anderson@example.com">
                                                </div>
                                            </div> --}}

                                        {{-- <div class="row mb-3">
                                                <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
                                                </div>
                                            </div> --}}

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->
                                </div><!-- End Profile Edit Form -->
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pt-3">
                            <div class="tab-content pt-2">
                                <style>
                                    .card {
                                        margin-top: 20px;
                                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                    }

                                    .card-header {
                                        background-color: #007bff;
                                        color: #fff;
                                        border-bottom: none;
                                    }

                                    .card-body {
                                        padding: 1.25rem;
                                    }

                                    .label {
                                        font-weight: bold;
                                    }

                                    .table {
                                        width: 100%;
                                        margin-bottom: 1rem;
                                        color: #212529;
                                    }

                                    .table th,
                                    .table td {
                                        padding: 0.75rem;
                                        vertical-align: top;
                                        border-top: 1px solid #dee2e6;
                                    }

                                    .table thead th {
                                        vertical-align: bottom;
                                        border-bottom: 2px solid #dee2e6;
                                    }

                                    .table tbody+tbody {
                                        border-top: 2px solid #dee2e6;
                                    }

                                    .table-striped tbody tr:nth-of-type(odd) {
                                        background-color: rgba(0, 0, 0, 0.05);
                                    }

                                    .table-bordered {
                                        border: 1px solid #dee2e6;
                                    }

                                    .table-bordered th,
                                    .table-bordered td {
                                        border: 1px solid #dee2e6;
                                    }
                                </style>
                                <h6 class="card-title">Detail</h6>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered datatable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Kategori Mata Pelajaran</th>
                                                <th class="text-center">Nama Mata Pelajaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1; // Inisialisasi nomor urut
                                            @endphp
                                            @forelse ($student->courses as $course)
                                                @foreach ($course->masterCourses as $masterCourse)
                                                    <tr>
                                                        <td class="text-center">{{ $no++ }}</td> <!-- Gunakan variabel $no untuk nomor urut -->
                                                        <td class="text-center">
                                                            @if ($masterCourse->master_category_course)
                                                                {{ $masterCourse->master_category_course->name }}
                                                            @else
                                                                Kategori tidak tersedia
                                                            @endif
                                                        </td>
                                                        <td class="text-center">{{ $masterCourse->name }}</td>
                                                    </tr>
                                                @endforeach
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">
                                                        <div class="alert alert-danger">
                                                            Data belum Tersedia.
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>SIAKAMIL</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('backend/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>

    {{-- Library Sweatalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });

        document.getElementById('classrooms_id').addEventListener('change', function() {
            var appUrl = '{{ env('APP_URL') }}';
            var classroomId = this.value;
            if (classroomId) {
                const url = `${appUrl}/guru/classrooms/${classroomId}/courses`;
                console.log('Fetching URL:', url);
                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Data received:', data);
                        // Uncheck all checkboxes first
                        document.querySelectorAll('.course-checkbox').forEach(checkbox => {
                            checkbox.checked = false;
                        });
                        // Check the checkboxes that are in the data
                        data.forEach(course => {
                            course.master_courses.forEach(masterCourse => {
                                document.getElementById(`master_course_${masterCourse.id}`).checked = true;
                            });
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else {
                document.querySelectorAll('.course-checkbox').forEach(checkbox => {
                    checkbox.checked = false;
                });
            }
        });

        document.getElementById('updateForm').addEventListener('submit', function(event) {
            let noHPInput = document.getElementById('noHP');
            let noHPValue = noHPInput.value.trim();

            // Validasi menggunakan regex untuk memastikan hanya angka yang diterima
            if (!/^\+?\d{10,15}$/.test(noHPValue)) {
                event.preventDefault(); // Mencegah pengiriman form

                // Tampilkan pesan SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nomor HP harus berupa angka, bisa diawali dengan tanda plus (+) dan terdiri dari 10 hingga 15 digit.',
                });

                noHPInput.focus();
            }
        });

        // get image in local
        function _upload() {
            document.getElementById('file_upload_id').click();
        }

        // get datetime to view in header
        document.addEventListener("DOMContentLoaded", function() {
            getDateTime();
            // getSelamat();
        });

        function getDateTime() {
            const hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
            const bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                "Oktober", "November", "Desember"
            ];
            const today = new Date();
            let D = today.getDay();
            let M = today.getMonth();
            let Y = today.getFullYear();
            let d = today.getDate();
            let h = ('0' + today.getHours()).substr(-2);
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = m < 10 ? m = "0" + m : m;
            s = s < 10 ? s = "0" + s : s;
            document.getElementById('dateTime').innerHTML = hari[D] + ", " + d + " " + bulan[M] + " " + Y + " • " + h +
                ":" + m + ":" + s + " WIB";
            setTimeout(getDateTime, 1000);
        }

        // function getSelamat() {
        //     var dt = new Date().getHours();
        //     if (dt >= 5 && dt <= 9) {
        //         document.getElementById("selamat").innerHTML =
        //             "Pagi";
        //     } else if (dt >= 10 && dt <= 14) {
        //         document.getElementById("selamat").innerHTML =
        //             "Siang";
        //     } else if (dt >= 15 && dt <= 17) {
        //         document.getElementById("selamat").innerHTML =
        //             "Sore";
        //     } else {
        //         document.getElementById("selamat").innerHTML =
        //             "Malam";
        //     }
        //     setTimeout(getSelamat, 1000);
        // }

        // Message with SweetAlert if user tries to access unauthorized route
        @if (session('unauthorized'))
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak!',
                text: '{{ session('unauthorized') }}',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            });
        @endif

        //message with sweetalert
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
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
