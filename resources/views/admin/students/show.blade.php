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
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <img src="{{asset('backend/assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle"/>
                            <span class="d-none d-md-block dropdown-toggle ps-2">
                                {{ Auth::user()->username}}
                            </span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6>{{ Auth::user()->username}}</h6>
                                <span>{{ Auth::user()->level}}</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider"/>
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

                <!-- Start Management Students Nav -->
                <li class="nav-item">
                    <a class="nav-link " data-bs-target="#students-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Students</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="students-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/admin/students" class="active">
                            <i class="bi bi-circle"></i><span>Students Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/students/create" >
                            <i class="bi bi-circle"></i><span>Insert Student Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management Students Nav -->

                <!-- Start Management Category Courses Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#categoryCourses-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Category Courses</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="categoryCourses-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/admin/categoryCourses" >
                            <i class="bi bi-circle"></i><span>Category Courses Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/categoryCourses/create">
                            <i class="bi bi-circle"></i><span>Insert Category Course Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management Category Courses Nav -->

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
                        <li class="breadcrumb-item active">Show Student Data</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <img src="{{ asset('/storage/images/'.$student->image) }}" class="rounded-circle" style="width: 70%" alt="image">
                                <h2>{{ $student->name }}</h2>
                                <div class="social-links mt-2">
                                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                </div>
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
                                            <div class="col-lg-6 col-md-8">{{ ($student->gender) }}</div>
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
                                            <div class="col-lg-6 col-md-4 label">Role Level</div>
                                            <div class="col-lg-6 col-md-8">{{ $student->user->level }}</div>
                                        </div>

                                        <h6 class="card-title">Teaching at the Educational Level</h6>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-4 label">Education Level</div>
                                            <div class="col-lg-6 col-md-8">{{ $student->education_levels->name }}</div>
                                        </div>
                                    </div>

                                    <!-- Start Profile Edit Form -->
                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                        <form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <img src="{{ asset('/storage/images/'.$student->image) }}" class="rounded" style="width: 30%" alt="image"><br>
                                                    <span class="badge bg-danger mb-1 mt-1"><i class="bi bi-exclamation-octagon pe-2"></i>Maksimum Size 2 MB</span>
                                                    <div class="pt-1">
                                                        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image">
                                                            <input type="file" id="file_upload_id" style="display:none">
                                                            <i class="bi bi-upload" onclick="_upload()"></i>
                                                        </a>
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
                                                    <input type="number" class="form-control @error('noHP') is-invalid @enderror" name="noHP" value="{{ old('noHP', $student->noHP) }}" placeholder="Masukkan Nomor HP Anda!">
                                                </div>

                                                <!-- error message untuk nik -->
                                                @error('noHP')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="row mb-3">
                                                <label class="font-weight-bold">Agama</label>
                                                <select class="form-select @error('agama') is-invalid @enderror" name="agama" aria-label="Pilih Agama">
                                                    <option selected>Pilih Agama</option>
                                                    <option value="islam" {{ ($student->agama=='islam') ? 'selected' : '' }}>Islam</option>
                                                    <option value="kristen" {{ ($student->agama=='kristen') ? 'selected' : '' }}>Kristen</option>
                                                    <option value="katolik" {{ ($student->agama=='katolik') ? 'selected' : '' }}>Katolik</option>
                                                    <option value="buddha" {{ ($student->agama=='buddha') ? 'selected' : '' }}>Buddha</option>
                                                    <option value="hindu" {{ ($student->agama=='hindu') ? 'selected' : '' }}>Kristen</option>
                                                    <option value="khonghucu" {{ ($student->agama=='khonghucu') ? 'selected' : '' }}>Khonghucu</option>
                                                </select>
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

                                            <div class="form-group mb-3">
                                                <label class="font-weight-bold">Jenis Kelamin</label>
                                                <select class="form-select @error('gender') is-invalid @enderror" name="gender" aria-label="Default select example">
                                                    <option selected>Pilih Jenis kelamin</option>
                                                    <option value="Laki-Laki" {{ ($student->gender=='Laki-Laki') ? 'selected' : '' }}>Laki-Laki</option>
                                                    <option value="Perempuan" {{ ($student->gender=='Perempuan') ? 'selected' : '' }}>Perempuan</option>
                                                </select>
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

                                            <div class="form-group mb-3">
                                                <label class="font-weight-bold">Status Keaktifan
                                                    <span class="badge bg-success mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Default Active</span>
                                                </label>
                                                <select class="form-select @error('status') is-invalid @enderror" name="status" aria-label="Default select example">
                                                    <option>Status Keaktifan</option>
                                                    <option value="active" {{ ($student->status=='active') ? 'selected' : '' }}>Active</option>
                                                    <option value="non-active" {{ ($student->status=='non-active') ? 'selected' : '' }}>Non-Active</option>
                                                </select>
                                                <!-- error message untuk jenis kelamin -->
                                                @error('status')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            {{-- form input to users tabel --}}
                                            <div class="form-group mb-3">
                                                <label class="font-weight-bold">Nama</label>
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $student->user->username) }}" placeholder="Masukkan Username Anda!">

                                                <!-- error message untuk name -->
                                                @error('username')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="font-weight-bold">Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $student->user->email) }}" placeholder="Masukkan Email Anda!">

                                                <!-- error message untuk name -->
                                                @error('email')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="font-weight-bold">Password
                                                    <span class="badge bg-danger mb-1"><i class="bi bi-exclamation-octagon pe-2"></i>Minimal 6 Karakter</span>
                                                </label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', $student->user->password) }}" placeholder="Masukkan Password Anda!">

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
                                                    <option value="{{ $student->user->id }}">{{ $student->user->id }}. {{ $student->user->level }}</option>
                                                    {{-- @foreach ($user as $data)
                                                        <option value="{{ $data->id }}">{{ $data->level }}</option>
                                                    @endforeach --}}
                                                    <option value="admin" {{ (old('level')=='admin') ? 'selected' : '' }}>Admin</option>
                                                    <option value="guru" {{ (old('level')=='guru') ? 'selected' : '' }}>Guru</option>
                                                    <option value="siswa" {{ (old('level')=='siswa') ? 'selected' : '' }}>Siswa</option>
                                                    <option value="calonSiswa" {{ (old('level')=='calonSiswa') ? 'selected' : '' }}>Calon Siswa</option>
                                                </select>
                                                <!-- error message untuk Role Level -->
                                                @error('level')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="font-weight-bold">Pilih Kategori Jenjang Pendidikan</label>
                                                <select class="form-select @error('education_levels_id') is-invalid @enderror" name="education_levels_id" aria-label="Default select example">
                                                    <option value="{{ $student->education_levels->id }}">{{ $student->education_levels->id }}. {{ $student->education_levels->name }}</option>
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
                                                    <option value="{{ $student->classrooms->id }}">{{ $student->classrooms->id }}. {{ $student->classrooms->name }}</option>
                                                    @foreach ($classrooms_id as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                                <!-- error message untuk jenis kelamin -->
                                                @error('classrooms_id')
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
            // get image in local
            function _upload(){
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
