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
            <li class="nav-item dropdown">

            <li class="nav-item dropdown pe-3">
                <div class="nav-item mb-0">
                    <span class="d-lg-block d-none" id="dateTime"></span>
                </div>
            </li>
            <a class="nav-link nav-profile d-flex align-items-center pe-0"
                    href="#"
                    data-bs-toggle="dropdown"
                >
                    <img
                        src="{{ asset('backend') }}/assets/img/profile-img.jpg"
                        alt="Profile"
                        class="rounded-circle"
                    />
                    <span class="d-none d-md-block dropdown-toggle ps-2 pe-2"
                        >{{ Auth::user()->username}}</span
                    > </a
                ><!-- End Profile Iamge Icon -->

                <ul
                    class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                >
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->username}}</h6>
                        <span>{{ Auth::user()->level}}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>

                    <li>
                        <a
                            class="dropdown-item d-flex align-items-center"
                            href="{{ route('logout') }}"
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
