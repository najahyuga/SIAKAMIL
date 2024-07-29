<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>Siswa - Management Tasks - SIAKAMIL</title>
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

        <!-- Template Main CSS File -->
        <link href="{{asset('backend/assets/css/style.css')}}" rel="stylesheet" />
    </head>

    <body>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-between">
                <a href="/siswa" class="logo d-flex align-items-center">
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
                                        @if($role->level == 'siswa')
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
                    <a class="nav-link collapsed" href="/siswa">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <!-- Start Management Tasks Nav -->
                <li class="nav-item">
                    <a class="nav-link " href="/siswa/tasks" >
                        <i class="bi bi-menu-button-wide"></i>
                        <span>Menu Tugas</span>
                    </a>
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
                        <li class="breadcrumb-item"><a href="/siswa">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/siswa/tasks">Tasks Data</a></li>
                        <li class="breadcrumb-item active">Show Task Data</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview Tugas</button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2">
                                    {{-- Start List --}}
                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                        <h6 class="card-title">Tugas Details</h6>
                                        <div class="row mb-3">
                                            <div class="col-lg-3 col-md-4 label mb-2">Nama Pelajaran</div>
                                            <div class="col-lg-9 col-md-8 mb-2">{{ $task->masterCourses->name }}</div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3 col-md-4 label mb-2">Nama Tugas</div>
                                            <div class="col-lg-9 col-md-8 mb-2">{{ $task->name }}</div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3 col-md-4 label mb-2">Deskripsi Tugas</div>
                                            <div class="col-lg-9 col-md-8 mb-2">{!! $task->description !!}</div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3 col-md-4 label mb-2">Deadline Tugas</div>
                                            <div class="col-lg-9 col-md-8 mb-2">{{ $task->deadline }}</div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3 col-md-4 label">File Tugas</div>
                                            <div class="col-lg-9 col-md-8">
                                                @if(isset($task->file))
                                                    <a href="{{ asset('storage/file/' . $task->file) }}" target="_blank">{{ $task->file }}</a>
                                                @else
                                                    <p>Tidak ada file yang tersedia untuk tugas ini.</p>
                                                @endif
                                            </div>
                                        </div>

                                        @if(Auth::user()->student && isset($submittedTask))
                                            <div class="row mb-3">
                                                <div class="col-lg-3 col-md-4 font-weight-bold">File yang Disubmit</div>
                                                <div class="col-lg-9 col-md-8">
                                                    <a href="{{ asset('storage/file/' . $submittedTask->file) }}" target="_blank" class="text-decoration-none">{{ $submittedTask->file }}</a>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-lg-3 col-md-4 font-weight-bold">Deskripsi</div>
                                                <div class="col-lg-9 col-md-8">{!! $submittedTask->description !!}</div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-lg-3 col-md-4 font-weight-bold">Nilai</div>
                                                <div class="col-lg-9 col-md-8">
                                                    @if(isset($submittedTask->result))
                                                        {{ $submittedTask->result }}
                                                    @else
                                                        <p class="text-muted">Belum dinilai.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        <div class="text-center">
                                            @if(Auth::user()->student)
                                                @if(isset($submittedTask))
                                                    <a href="{{ route('siswa.taskDetails.index', ['studentsId' => Auth::user()->student->id, 'taskId' => $task->id]) }}" class="btn btn-warning btn-sm">Update Tugas</a>
                                                @else
                                                    <a href="{{ route('siswa.taskDetails.index', ['studentsId' => Auth::user()->student->id, 'taskId' => $task->id]) }}" class="btn btn-success btn-sm">Kumpulkan Tugas</a>
                                                @endif
                                            @else
                                                <p class="text-muted">Tidak bisa mengumpulkan tugas</p>
                                            @endif
                                        </div>
                                    </div>{{-- End List --}}
                                </div>
                                <!-- End Bordered Tabs -->
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

        {{-- ckeditor --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "{{ route('guru.ckeditor.upload').'?_token='.csrf_token() }}"
                }
            })
            .catch(error => {
                console.error(error);
            });
        </script>

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
