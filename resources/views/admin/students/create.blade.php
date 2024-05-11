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
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet"
        />

        <!-- Vendor CSS Files -->
        <link
            href="{{asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css')}}"
            rel="stylesheet"
        />
        <link
            href="{{asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}"
            rel="stylesheet"
        />
        <link
            href="{{asset('backend/assets/vendor/boxicons/css/boxicons.min.css')}}"
            rel="stylesheet"
        />
        <link href="{{asset('backend/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet" />
        <link href="{{asset('backend/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet" />
        <link href="{{asset('backend/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet" />
        <link
            href="{{asset('backend/assets/vendor/simple-datatables/style.css')}}"
            rel="stylesheet"
        />


        <!--Get your own code at fontawesome.com-->
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

        <!-- Template Main CSS File -->
        <link href="{{asset('backend/assets/css/style.css')}}" rel="stylesheet" />
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
                        <a
                            class="nav-link nav-profile d-flex align-items-center pe-0"
                            href="#"
                            data-bs-toggle="dropdown"
                        >
                            <img
                                src="{{asset('backend/assets/img/profile-img.jpg')}}"
                                alt="Profile"
                                class="rounded-circle"
                            />
                            <span class="d-none d-md-block dropdown-toggle ps-2"
                                >K. Anderson</span
                            > </a
                        ><!-- End Profile Iamge Icon -->

                        <ul
                            class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                        >
                            <li class="dropdown-header">
                                <h6>Kevin Anderson</h6>
                                <span>Web Designer</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-center"
                                    href="users-profile.html"
                                >
                                    <i class="bi bi-person"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-center"
                                    href="users-profile.html"
                                >
                                    <i class="bi bi-gear"></i>
                                    <span>Account Settings</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-center"
                                    href="pages-faq.html"
                                >
                                    <i class="bi bi-question-circle"></i>
                                    <span>Need Help?</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-center"
                                    href="#"
                                >
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </a>
                            </li>
                        </ul>
                        <!-- End Profile Dropdown Items -->
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

                <!-- Start Management educationLevels Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#educationLevels-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Education Levels</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="educationLevels-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/educationLevels" >
                            <i class="bi bi-circle"></i><span>Education Levels Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/educationLevels/create" >
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
                            <a href="/teacher">
                            <i class="bi bi-circle"></i><span>Teacher Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/teacher/create">
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
                            <a href="/semesters" >
                            <i class="bi bi-circle"></i><span>Semesters Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/semesters/create">
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
                            <a href="/classrooms" >
                            <i class="bi bi-circle"></i><span>Classrooms Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/classrooms/create">
                            <i class="bi bi-circle"></i><span>Insert Classroom Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management Classrooms Nav -->

                <!-- Start Management Students Nav -->
                <li class="nav-item">
                    <a class="nav-link " data-bs-target="#students-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Students</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="students-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/students" >
                            <i class="bi bi-circle"></i><span>Students Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/students/create" class="active">
                            <i class="bi bi-circle"></i><span>Insert Student Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management Students Nav -->

                <!-- Start Management Users Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-layout-text-window-reverse"></i><span>Management Users</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/user">
                                <i class="bi bi-circle"></i><span>User Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/user/create">
                                <i class="bi bi-circle"></i><span>Insert User Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management Users Nav -->

                <!-- Start Management Courses Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#course-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Courses</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="course-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/course" >
                            <i class="bi bi-circle"></i><span>Courses Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/course/create">
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
                            <a href="/task" >
                            <i class="bi bi-circle"></i><span>Tasks Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/task/create" >
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
                        <li class="breadcrumb-item"><a href="/students">Students Data</a></li>
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
                                <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <span class="badge bg-danger mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Minimal Inputan 15 Angka</span>
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
                                            <option selected>Pilih Jenis kelamin</option>
                                            <option value="Laki-Laki" {{ (old('gender'=='Laki-Laki')) ? 'selected' : '' }}>Laki-Laki</option>
                                            <option value="Perempuan" {{ (old('gender'=='Perempuan')) ? 'selected' : '' }}>Perempuan</option>
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
                                            <span class="badge bg-danger mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Maksimum Size 2 MB</span>
                                        </label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                                        <!-- error message untuk image -->
                                        @error('image')
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

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Nama</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Masukkan Username Anda!">

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
                                            <span class="badge bg-danger mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Minimal Inputan 6 Karakter</span>
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
                                        <label class="font-weight-bold">Role Level
                                            <span class="badge bg-danger mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Default Calon Siswa</span>
                                        </label>
                                        <select class="form-select @error('level') is-invalid @enderror" name="level" aria-label="Pilih Role Level Sesuai Kebutuhan">
                                            <option selected>Pilih Role Level</option>
                                            <option value="admin" {{ (old('level')=='admin') ? 'selected' : '' }}>Admin</option>
                                            <option value="guru" {{ (old('level')=='guru') ? 'selected' : '' }}>Guru</option>
                                            <option value="siswa" {{ (old('level')=='siswa') ? 'selected' : '' }}>Siswa</option>
                                            <option selected value="calonSiswa" {{ (old('level')=='calonSiswa') ? 'selected' : '' }}>Calon Siswa</option>
                                        </select>
                                        <!-- error message untuk jenis kelamin -->
                                        @error('level')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Pilih Kategori Jenjang Pendidikan</label>
                                        <select class="form-select @error('education_levels_id') is-invalid @enderror" name="education_levels_id" aria-label="Default select example">
                                            <option selected>Pilih Kategori Jenjang Pendidikan yang Sesuai</option>
                                            <option value="">=================</option>
                                            @foreach ($education_levels_id as $data)
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

                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Pilih Kelas yang Sesuai</label>
                                        <select class="form-select @error('classrooms_id') is-invalid @enderror" name="classrooms_id" aria-label="Default select example">
                                            <option selected>Pilih Kelas yang Sesuai Data Siswa</option>
                                            <option value="">=================</option>
                                            @foreach ($classrooms_id as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        <!-- error message untuk Pilih Kelas yang Sesuai -->
                                        @error('classrooms_id')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
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


        <a
            href="#"
            class="back-to-top d-flex align-items-center justify-content-center"
            ><i class="bi bi-arrow-up-short"></i
        ></a>

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

        <script>
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