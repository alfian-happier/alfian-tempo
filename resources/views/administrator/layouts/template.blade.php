<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Alfian - Tempo Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/dashboard/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/dashboard/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/css/services.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/css/team.css') }}" rel="stylesheet">

    <!-- Custom CSS For Trix -->
    <link href="{{ asset('assets/dashboard/css/trix.css') }}" rel="stylesheet">

    <!-- trix -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block ">Alfian Tempo</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <!-- Home Icon -->
                <a class="nav-link nav-icon" href="" target="_blank">
                    <i class="bi bi-house-door"></i>
                </a>
                <!-- End Home Icon -->

                <!-- Profil user -->
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->nama }}</span>
                    </a><!-- End Profile Iamge Icon -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header d-flex align-items-center">
                            <div>
                                <h6>{{ Auth::user()->nama }}</h6>
                                <span>{{ Auth::user()->role }}</span>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{ route('administrator.pengguna.account-setting') }}">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <!-- Hidden logout form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <!-- Logout link -->
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->
            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    @include('administrator.layouts.sidebar')

    <main id="main" class="main">

        @yield('content')

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Alfian Salafin</span></strong>. All Rights Reserved
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/dashboard/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/dashboard/js/main.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/sweet-alert.js') }}"></script>

    <!-- Custom Javascript -->
    <script src="{{ asset('assets/dashboard/js/custom.js') }}"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>