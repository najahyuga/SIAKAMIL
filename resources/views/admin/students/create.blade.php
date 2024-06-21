<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>Management Siswa - SIAKAMIL</title>
        <meta content="" name="description" />
        <meta content="" name="keywords" />

        <!-- Favicons -->
        <link href="{{asset('backend/assets/img/logopkbm.jpeg')}}" rel="icon" />
        <link href="{{asset('backend/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon" />

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

        <!-- Vendor CSS Files -->
        <link href="{{asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet" />
        <link href="{{asset('backend/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet" />
        <link href="{{asset('backend/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet" />
        <link href="{{asset('backend/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet" />
        <link href="{{asset('backend/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet" />
        <link href="{{asset('backend/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet" />

        <!--Get your own code at fontawesome.com-->
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

        <!-- Template Main CSS File -->
        <link href="{{asset('backend/assets/css/style.css')}}" rel="stylesheet" />

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    </head>

    <body>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-between">
                <a href="/admin" class="logo d-flex align-items-center">
                    <img src="{{asset('backend/assets/img/logopkbm.jpeg')}}" alt="IMAGELOGO" />
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
                            <img src="{{ asset('backend/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle" />
                            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->username }}</span>
                        </a><!-- End Profile Image Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6>{{ Auth::user()->username }}</h6>
                                <span>{{ session('current_role') }}</span>
                            </li>
                            <li><hr class="dropdown-divider" /></li>

                            <li class="dropdown-header">
                                <h6>Pindah Akun</h6>
                            </li>
                            @foreach (Auth::user()->roles as $role)
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href=""
                                        onclick="event.preventDefault(); document.getElementById('switch-role-{{ $role->level }}').submit();">
                                        <i class="bi bi-people"></i>
                                        <span>{{ ucfirst($role->level) }}</span>
                                        @if($role->level == 'admin')
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
                                <hr class="dropdown-divider"/>
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                    <i class="bi bi-gear"></i>
                                    <span>Account Settings</span>
                                </a>
                            </li>

                            <li><hr class="dropdown-divider" /></li>

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
                    <a class="nav-link collapsed" href="/admin">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <!-- Start Management Users Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/admin/users">
                        <i class="ri ri-folder-user-line"></i>
                        <span>Management Users</span>
                    </a>
                </li><!-- End Management Users Nav -->

                <!-- Start Management educationLevels Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#educationLevels-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Education Levels</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="educationLevels-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/admin/educationLevels" >
                            <i class="bi bi-circle"></i><span>Education Levels Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/educationLevels/create" >
                            <i class="bi bi-circle"></i><span>Insert Education Levels Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management educationLevels Nav -->

                <!-- Start Management Teachers Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#teachers-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-layout-text-window-reverse"></i><span>Management Teachers</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="teachers-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/admin/teacher">
                            <i class="bi bi-circle"></i><span>Teacher Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/teacher/create">
                            <i class="bi bi-circle"></i><span>Insert Teacher Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management Teachers Nav -->

                <!-- Start Management semesters Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#semesters-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Semesters</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="semesters-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/admin/semesters" >
                            <i class="bi bi-circle"></i><span>Semesters Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/semesters/create">
                            <i class="bi bi-circle"></i><span>Insert Semesters Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management semester Nav -->

                <!-- Start Management Classrooms Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#Classrooms-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Classrooms</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="Classrooms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/admin/classrooms" >
                            <i class="bi bi-circle"></i><span>Classrooms Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/classrooms/create">
                            <i class="bi bi-circle"></i><span>Insert Classroom Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management Classrooms Nav -->

                <!-- Start Management Master Category Courses Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#masterCategoryCourses-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Master Category Courses</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="masterCategoryCourses-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/admin/masterCategoryCourses" >
                            <i class="bi bi-circle"></i><span>Master Category Courses Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/masterCategoryCourses/create">
                            <i class="bi bi-circle"></i><span>Insert Master Category Course Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management Master Category Courses Nav -->

                <!-- Start Management Master Courses Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#masterCourses-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Master Courses</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="masterCourses-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/admin/masterCourses" >
                            <i class="bi bi-circle"></i><span>Master Courses Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/masterCourses/create" >
                            <i class="bi bi-circle"></i><span>Insert Master Course Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management Master Courses Nav -->

                <!-- Start Management Students Nav -->
                <li class="nav-item">
                    <a class="nav-link " data-bs-target="#students-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Students</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="students-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/admin/students">
                            <i class="bi bi-circle"></i><span>Students Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/students/create" class="active">
                            <i class="bi bi-circle"></i><span>Insert Students Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management Students Nav -->

                <!-- Start Management Courses Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#course-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Courses</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="course-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/admin/courses" >
                            <i class="bi bi-circle"></i><span>Courses Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/courses/create">
                            <i class="bi bi-circle"></i><span>Insert Course Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management Courses Nav -->

                <!-- Start Management Tasks Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#task-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Tasks</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="task-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/admin/tasks" >
                            <i class="bi bi-circle"></i><span>Tasks Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/tasks/create" >
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
                        <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/students">Students Data</a></li>
                        <li class="breadcrumb-item active">Insert Student Data</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Forms Add Student Data</h5>

                                <!-- Custom Styled Validation with Tooltips novalidate -->
                                <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Anda!">

                                        <!-- error message untuk name -->
                                        @error('name')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Nomor Induk Kependudukan
                                            <span class="badge bg-danger mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Minimal Inputan 16 Angka</span>
                                        </label>
                                        <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" placeholder="Masukkan Nomor Induk Kependudukan Anda!">

                                        <!-- error message untuk nik -->
                                        @error('nik')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Nomor Akte Lahir
                                            <span class="badge bg-danger mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Minimal Inputan 10 Angka</span>
                                        </label>
                                        <input type="number" class="form-control @error('noAkteLahir') is-invalid @enderror" name="noAkteLahir" value="{{ old('noAkteLahir') }}" placeholder="Masukkan Nomor Akte Lahir Anda!">

                                        <!-- error message untuk noAkteLahir -->
                                        @error('noAkteLahir')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Nomor Induk Siswa
                                            <span class="badge bg-danger mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Minimal Inputan 5 Angka</span>
                                        </label>
                                        <input type="number" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{ old('nis') }}" placeholder="Masukkan Nomor Induk Siswa Anda!">

                                        <!-- error message untuk nik -->
                                        @error('nis')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Nomor Induk Siswa Nasional
                                            <span class="badge bg-danger mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Minimal Inputan 10 Angka</span>
                                        </label>
                                        <input type="number" class="form-control @error('nisn') is-invalid @enderror" name="nisn" value="{{ old('nisn') }}" placeholder="Masukkan Nomor Induk Siswa Nasional Anda!">

                                        <!-- error message untuk nik -->
                                        @error('nisn')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Nomor HP
                                            <span class="badge bg-danger mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Maksimal Inputan 15 Angka</span>
                                        </label>
                                        <input type="number" class="form-control @error('noHP') is-invalid @enderror" name="noHP" value="{{ old('noHP') }}" placeholder="Masukkan Nomor HP Anda!">

                                        <!-- error message untuk nik -->
                                        @error('noHP')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Agama</label>
                                        <select class="form-select @error('agama') is-invalid @enderror" name="agama" aria-label="Pilih Agama">
                                            <option selected>Pilih Agama</option>
                                            <option value="islam" {{ (old('agama')=='islam') ? 'selected' : '' }}>Islam</option>
                                            <option value="kristen" {{ (old('agama')=='kristen') ? 'selected' : '' }}>Kristen</option>
                                            <option value="katolik" {{ (old('agama')=='katolik') ? 'selected' : '' }}>Katolik</option>
                                            <option value="buddha" {{ (old('agama')=='buddha') ? 'selected' : '' }}>Buddha</option>
                                            <option value="hindu" {{ (old('agama')=='hindu') ? 'selected' : '' }}>Kristen</option>
                                            <option value="khonghucu" {{ (old('agama')=='khonghucu') ? 'selected' : '' }}>Khonghucu</option>
                                        </select>
                                        <!-- error message untuk agama -->
                                        @error('agama')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Jenis Kelamin</label>
                                        <select class="form-select @error('gender') is-invalid @enderror" name="gender" aria-label="Default select example">
                                            <option selected>Pilih Jenis Kelamin</option>
                                            <option value="Laki-Laki" {{ (old('gender')=='Laki-Laki') ? 'selected' : '' }}>Laki-Laki</option>
                                            <option value="Perempuan" {{ (old('gender')=='Perempuan') ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        <!-- error message untuk jenis kelamin -->
                                        @error('gender')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('dateOfBirth') is-invalid @enderror" name="dateOfBirth" value="{{ old('dateOfBirth') }}" placeholder="Masukkan Tanggal Lahir Anda!">

                                        <!-- error message untuk Tanggal Lahir -->
                                        @error('dateOfBirth')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Alamat</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Masukkan Alamat Anda!">{{ old('address') }}</textarea>

                                        <!-- error message untuk alamat -->
                                        @error('address')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Foto
                                            <span class="badge bg-danger mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Maksimum Size 2 MB</span><br>
                                        </label>
                                        <!-- Tampilkan gambar pratinjau -->
                                        <div id="imagePreview" class="mt-0 mb-1"></div>
                                        <input type="file" class="form-control @error('path') is-invalid @enderror" name="path" onchange="previewImage(this)">

                                        <!-- error message untuk image -->
                                        @error('path')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Status Keaktifan
                                            <span class="badge bg-success mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Default Active</span>
                                        </label>
                                        <select class="form-select @error('status') is-invalid @enderror" name="status" aria-label="Default select example">
                                            <option >Status Keaktifan</option>
                                            <option selected value="active" {{ (old('status')=='active') ? 'selected' : '' }}>active</option>
                                            <option value="non-active" {{ (old('status')=='non-active') ? 'selected' : '' }}>non-active</option>
                                        </select>
                                        <!-- error message untuk jenis kelamin -->
                                        @error('gender')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- form input to users tabel --}}
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Username Akun</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Masukkan Username Akun Anda!">

                                        <!-- error message untuk name -->
                                        @error('username')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukkan Email Anda!">

                                        <!-- error message untuk name -->
                                        @error('email')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Password
                                            <span class="badge bg-danger mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Minimal 6 Karakter</span><br>
                                        </label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Masukkan Password Anda!">

                                        <!-- error message untuk name -->
                                        @error('password')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Role Level</label>
                                        @foreach ($roles as $role)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="level[]" value="{{ $role->id }}" id="role{{ $role->id }}"
                                                @if($roles->contains($role->id)) @endif>
                                                <label class="form-check-label" for="role{{ $role->id }}">{{ $role->level }}</label>
                                            </div>
                                        @endforeach
                                        <!-- error message untuk jenis kelamin -->
                                        @error('level')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Jenjang Pendidikan</label>
                                        <select class="form-select @error('education_levels_id') is-invalid @enderror" name="education_levels_id" aria-label="Default select example">
                                            <option selected>Pilih Jenjang Pendidikan Id</option>
                                            @foreach ($education_levels as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        <!-- error message untuk jenis kelamin -->
                                        @error('education_levels_id')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Kelas -->
                                    <div class="form-group">
                                        <label for="classrooms_id" class="font-weight-bold">Pilih Kelas</label>
                                        <select name="classrooms_id" id="classrooms_id" class="form-control">
                                            <option value="">Pilih Kelas</option>
                                            @foreach($classrooms as $classroom)
                                                <option value="{{ $classroom->id }}">{{ $classroom->name }} / {{ $classroom->semesters->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Mata Pelajaran -->
                                    <div class="form-group mb-3 custom-checkbox">
                                        <label class="font-weight-bold">Mata Pelajaran</label>
                                        <div class="row" id="course-container">
                                            @foreach ($master_categories as $master_category)
                                                <div class="col-md-6">
                                                    <p class="font-weight-bold">{{ $master_category->name }}</p>
                                                    @foreach ($master_category->masterCourses as $master_course)
                                                        <div class="form-check">
                                                            <input class="form-check-input course-checkbox" type="checkbox" value="{{ $master_course->id }}" name="master_courses_id[]" id="master_course_{{ $master_course->id }}" {{ in_array($master_course->id, old('master_courses_id', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="master_course_{{ $master_course->id }}">
                                                                {{ $master_course->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('master_courses_id')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                                    <button type="reset" class="btn btn-md btn-warning">RESET</button>
                                </form>
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
        <script src="{{asset('backend/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
        <script src="{{asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('backend/assets/vendor/chart.js/chart.umd.js')}}"></script>
        <script src="{{asset('backend/assets/vendor/echarts/echarts.min.js')}}"></script>
        <script src="{{asset('backend/assets/vendor/quill/quill.min.js')}}"></script>
        <script src="{{asset('backend/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
        <script src="{{asset('backend/assets/vendor/tinymce/tinymce.min.js')}}"></script>
        <script src="{{asset('backend/assets/vendor/php-email-form/validate.js')}}"></script>

        <!-- Template Main JS File -->
        <script src="{{asset('backend/assets/js/main.js')}}"></script>

        {{-- Library Sweatalert --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            document.getElementById('classrooms_id').addEventListener('change', function() {
                var classroomId = this.value;
                if (classroomId) {
                    const url = `http://siakamil_beta.test/admin/classrooms/${classroomId}/courses`;
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
            @if(session('unauthorized'))
                Swal.fire({
                    icon: 'error',
                    title: 'Akses Ditolak!',
                    text: '{{ session('unauthorized') }}',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                });
            @endif

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
