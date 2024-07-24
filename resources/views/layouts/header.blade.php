<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="/admin" class="logo d-flex align-items-center">
            <img src="{{asset('backend')}}/assets/img/logopkbm.jpeg" alt="" />
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
                        <a class="dropdown-item d-flex align-items-center" href="admin/edit-profile">
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
