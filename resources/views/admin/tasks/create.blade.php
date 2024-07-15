<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Management Tasks - SIAKAMIL</title>
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
            <a href="/admin" class="logo d-flex align-items-center">
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
                        <img src="{{ asset('backend/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle" />
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->username }}</span>
                    </a><!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->username }}</h6>
                            <span>{{ Auth::user()->roles->first()->level }}</span>
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
                                    @if ($role->level == 'admin')
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
                        <a href="/admin/educationLevels">
                            <i class="bi bi-circle"></i><span>Education Levels Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/educationLevels/create">
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
                        <a href="/admin/semesters">
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
                        <a href="/admin/classrooms">
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
                        <a href="/admin/masterCategoryCourses">
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
                        <a href="/admin/masterCourses">
                            <i class="bi bi-circle"></i><span>Master Courses Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/masterCourses/create">
                            <i class="bi bi-circle"></i><span>Insert Master Course Data</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Management Master Courses Nav -->

            <!-- Start Management Students Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#students-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Management Students</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="students-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/admin/students">
                            <i class="bi bi-circle"></i><span>Students Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/students/create">
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
                        <a href="/admin/courses">
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
                <a class="nav-link " data-bs-target="#task-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Management Tasks</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="task-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/admin/tasks">
                            <i class="bi bi-circle"></i><span>Tasks Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/tasks/create" class="active">
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
                    <li class="breadcrumb-item"><a href="/admin/tasks">Tasks Data</a></li>
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
                        <form action="{{ route('admin.tasks.store') }}" method="POST" enctype="multipart/form-data">

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
                    uploadUrl: "{{ route('admin.ckeditor.upload') . '?_token=' . csrf_token() }}"
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
                const classroomsUrl = `${appUrl}/admin/courses/${courseId}/classrooms`;
                console.log('Fetching URL:', classroomsUrl);
                fetch(classroomsUrl)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(classroomsData => {
                        console.log('Classrooms Data received:', classroomsData);
                        // Proses data classrooms jika diperlukan
                        // Misalnya, bisa update UI dengan data classrooms di sini

                        // Fetch master courses berdasarkan course ID
                        const masterCoursesUrl = `${appUrl}/admin/courses/${courseId}/master-courses`;
                        console.log('Fetching URL:', masterCoursesUrl);
                        return fetch(masterCoursesUrl)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok ' + response.statusText);
                                }
                                return response.json();
                            })
                            .then(masterCoursesData => {
                                console.log('Master Courses Data received:', masterCoursesData);
                                // Update UI dengan data master courses
                                const taskCourseSelect = document.getElementById('task_course_id');
                                taskCourseSelect.innerHTML = '<option selected disabled>Pilih Pelajaran yang Akan Diberikan Tugas</option>';
                                masterCoursesData.forEach(masterCourse => {
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
