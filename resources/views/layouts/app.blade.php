<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard Admin - SIAKAMIL</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('backend/assets/img/logopkbm.jpeg')}}" rel="icon">
    <link href="{{asset('backend/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"/>

    <!-- Vendor CSS Files -->
    <link href="{{ asset('backend') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="{{ asset('backend') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"/>
    <link href="{{ asset('backend') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('backend') }}/assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/vendor/simple-datatables/style.css" rel="stylesheet"/>

    <!-- Template Main CSS File -->
    <link href="{{ asset('backend') }}/assets/css/style.css" rel="stylesheet" />
    @yield('style')
</head>

<body>
    @include('layouts.header')
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar" data-role="">
        <ul class="sidebar-nav" id="sidebar-nav">
            <!-- Start Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link " href="/admin">
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
                <ul id="educationLevels-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
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
    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        @yield('content')
    </main><!-- End #main -->
    @include('layouts.footer')
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('backend') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('backend') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="{{ asset('backend') }}/assets/vendor/echarts/echarts.min.js"></script>
    <script src="{{ asset('backend') }}/assets/vendor/quill/quill.min.js"></script>
    <script src="{{ asset('backend') }}/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="{{ asset('backend') }}/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="{{ asset('backend') }}/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('backend') }}/assets/js/main.js"></script>

    <!-- library sweetalert -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- session success &  error -->
    <script>
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
    @stack('script')
</body>
</html>
