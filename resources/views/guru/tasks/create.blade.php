<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Guru - Management Tasks - SIAKAMIL</title>
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
    <link href="{{ asset('backend/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet" />

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
                <a class="nav-link collapsed" data-bs-target="#students-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Management Students</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="students-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/students">
                            <i class="bi bi-circle"></i><span>Students Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="/students/create">
                            <i class="bi bi-circle"></i><span>Insert Students Data</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Management Students Nav -->

            <!-- Start Management Tasks Nav -->
            <li class="nav-item">
                <a class="nav-link " data-bs-target="#task-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Management Tasks</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="task-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/guru/tasks">
                            <i class="bi bi-circle"></i><span>Tasks Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="/guru/tasks/create" class="active">
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
                    <li class="breadcrumb-item"><a href="/guru/tasks">Tasks Data</a></li>
                    <li class="breadcrumb-item active">Insert Task Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="card col-lg">
                    <div class="card-body">
                        <h5 class="card-title">Forms Add Task Data</h5>

                        <!-- Custom Styled Validation with Tooltips novalidate -->
                        <form action="{{ route('guru.tasks.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Pilih Kelas</label>
                                <select class="form-select @error('courses_id') is-invalid @enderror" name="courses_id" id="courses_id" aria-label="Pilih Kelas">
                                    <option selected disabled>Pilih Kelas</option>
                                    @foreach ($courses_id as $course)
                                        <option value="{{ $course->id }}">{{ $course->classrooms->name }} / {{ $course->classrooms->semesters->name }}</option>
                                    @endforeach
                                </select>
                                @error('courses_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Tugas Dari Pelajaran</label>
                                <select class="form-select @error('master_courses_id') is-invalid @enderror" name="master_courses_id" id="task_course_id" aria-label="Pilih Pelajaran yang Akan Diberikan Tugas">
                                    <option selected disabled>Pilih Pelajaran yang Akan Diberikan Tugas</option>
                                </select>
                                @error('master_courses_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Nama Tugas</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Tugas!">

                                <!-- error message untuk name -->
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Deskripsi Tugas</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="editor" name="description" placeholder="Masukkan Deskripsi dari Tugas yang Akan Diberikan!">{{ old('description') }}</textarea>
                                <!-- error message untuk alamat tinymce-editor -->
                                @error('description')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Batas Waktu Pengumpulan Tugas</label>
                                <input type="datetime-local" class="form-control @error('deadline') is-invalid @enderror" name="deadline" value="{{ old('deadline') }}" placeholder="Masukkan Batas Waktu Pengumpulan Tugas!">

                                <!-- error message untuk Tanggal Lahir -->
                                @error('deadline')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">File Tugas</label>
                                <input type="file" class="form-control @error('file') is-invalid @enderror" name="file">

                                <!-- error message untuk image -->
                                @error('file')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                        <!-- End Custom Styled Validation with Tooltips -->
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
    <script src="{{ asset('backend/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>

    {{-- Library Sweatalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "{{ route('guru.ckeditor.upload') . '?_token=' . csrf_token() }}"
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        document.getElementById('courses_id').addEventListener('change', function() {
            var appUrl = '{{ env('APP_URL') }}';
            var courseId = this.value;
            if (courseId) {
                const url = `${appUrl}/guru/classrooms/${courseId}/courses`;
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
                        const taskCourseSelect = document.getElementById('task_course_id');
                        taskCourseSelect.innerHTML = '<option selected disabled>Pilih Pelajaran yang Akan Diberikan Tugas</option>';
                        data.forEach(course => {
                            course.master_courses.forEach(masterCourse => {
                                const option = document.createElement('option');
                                option.value = masterCourse.id;
                                option.textContent = masterCourse.name;
                                taskCourseSelect.appendChild(option);
                            });
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else {
                const taskCourseSelect = document.getElementById('task_course_id');
                taskCourseSelect.innerHTML = '<option selected disabled>Pilih Pelajaran yang Akan Diberikan Tugas</option>';
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
