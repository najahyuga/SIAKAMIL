<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>Management Kelas - SIAKAMIL</title>
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

                <!-- Start Management Users Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/users">
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
                            <a href="/semesters/create" >
                            <i class="bi bi-circle"></i><span>Insert Semesters Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management semester Nav -->

                <!-- Start Management Classrooms Nav -->
                <li class="nav-item">
                    <a class="nav-link " data-bs-target="#Classrooms-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Classrooms</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="Classrooms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/classrooms" >
                            <i class="bi bi-circle"></i><span>Classrooms Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/classrooms/create" class="active">
                            <i class="bi bi-circle"></i><span>Insert Classroom Data</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Management Classrooms Nav -->

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

                <!-- Start Management Category Courses Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#categoryCourses-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Management Category Courses</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="categoryCourses-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/categoryCourses" >
                            <i class="bi bi-circle"></i><span>Category Courses Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/categoryCourses/create">
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
                            <a href="/courses" >
                            <i class="bi bi-circle"></i><span>Courses Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/courses/create">
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
                            <a href="/tasks" >
                            <i class="bi bi-circle"></i><span>Tasks Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="/tasks/create" >
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
                        <li class="breadcrumb-item"><a href="/classrooms">Classrooms Data</a></li>
                        <li class="breadcrumb-item active">Insert Classroom Data</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section">
                <div class="row">
                    <div class="card col-lg">
                        <div class="card-body">
                            <h5 class="card-title">Forms Add Classrooms Data</h5>
                            <!-- Custom Styled Validation with Tooltips novalidate -->
                            <form action="{{ route('classrooms.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Nama Kelas
                                            <span class="badge bg-danger ms-2 mb-1"><i class="bi bi-exclamation-octagon me-1"></i>Contoh: Kelas 1 Paket A Setara SD/Kelas 1 Paket B Setara SMP/Kelas 1 Paket C Setara SMA</span>
                                        </label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan Nama Kelas!">

                                        <!-- error message untuk name -->
                                        @error('name')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <label class="font-weight-bold">Pilih Semester</label>
                                    <select class="form-select @error('semesters_id') is-invalid @enderror" name="semesters_id" aria-label="Pilih Semesters Yang Akan Di Buatkan Kelas">
                                        <option selected>Pilih Semesters Yang Akan Di Buatkan Kelas</option>
                                        @foreach ($semesters_id as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }} {{ date('Y', strtotime($data->startDate)) }}/{{ date('Y', strtotime($data->endDate)) }}</option>
                                        @endforeach
                                    </select>
                                    <!-- error message untuk name -->
                                    @error('semesters_id')
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
