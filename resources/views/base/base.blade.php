<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title', 'Energy Usage Dashboard')</title>

    <link rel="shortcut icon" href="{{ asset('template/img/panasonic.jpg') }}" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .btn-circle {
            width: 40px;
            height: 40px;
            padding: 6px 0;
            border-radius: 50%;
            text-align: center;
            font-size: 18px;
            line-height: 1.42857;
        }

        .row {
            display: flex;
            justify-content: center;
            margin-bottom: 8px;
        }

        .flex {
            margin-right: 8px;
        }

        .button-style {
            border: 1px solid #5aa2ff;
            background-color: #5aa2ff;
            color: rgb(255, 255, 255);
            font-weight: bold;
            padding: 8px 16px;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .button-style:hover {
            background-color: #7fc8ff;
        }

        .button-style a {
            color: rgb(255, 255, 255);
            text-decoration: none;
        }

        .bg-gradient-orange {
            background: linear-gradient(180deg, #f6c23e 10%, #e69a20 100%);
            background-size: cover;
        }

        .dropdown-menu {
            z-index: 1050;
        }
    </style>
</head>

<body>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion {{ Route::is('dashboardcarbon') ? 'bg-gradient-orange' : 'bg-gradient-primary' }}" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-text mx-3">PANASONIC</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @if (!Route::is('turn'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @endif

            <!-- Nav Item - Laporan -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseLaporan" class="collapse" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
                    <div class="bg-dark py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Laporan</h6>
                        <a class="collapse-item" href="{{ route('laporan.gedung', ['gedung' => 1]) }}" style="color:white;">Gedung 1</a>
                        <a class="collapse-item" href="{{ route('laporan.gedung', ['gedung' => 2]) }}" style="color:white;">Gedung 2</a>
                        <a class="collapse-item" href="{{ route('laporan.gedung', ['gedung' => 3]) }}" style="color:white;">Gedung 3</a>

                    </div>
                </div>
            </li>

            <!-- Nav Item - Back Button -->
            @if (!Route::is('dashboard') && !Route::is('laporan'))
            <li class="nav-item">
                <a class="nav-link" href="javascript:history.back()">
                    <i class="fas fa-fw fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </li>
            @endif
            @if(Auth::check() && Auth::user()->level === 'admin' && !in_array(Route::currentRouteName(), ['laporan.gedung1', 'laporan.gedung2', 'laporan.gedung3']))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">
                    <i class="fas fa-fw fa-plus"></i>
                    <span>Tambah Staff</span>
                </a>
            </li>
            @endif
            @if(in_array(Auth::user()->level, ['admin']))
            <li class="nav-item">
                <a class="nav-link" href="list">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Daftar Pengguna</span></a>
            </li>
            @endif

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <!-- Electricity Button -->
                        <li class="nav-item mx-1">
                            <a href="{{ route('dashboard') }}" class="btn btn-circle btn-info" id="electricityButton">
                                <i class="fas fa-bolt"></i>
                            </a>
                        </li>

                        <!-- CO2 Button -->
                        <li class="nav-item mx-1">
                            <a href="{{ route('dashboardcarbon') }}" class="btn btn-circle btn-warning" id="carbonButton">
                                <i class="fas fa-cloud"></i>
                            </a>
                        </li>
                    </ul>

                    <!-- Topbar Navbar Right -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Topbar Dropdown (Informasi Pengguna) -->
                        <li class="nav-item dropdown no-arrow">
                            @if(Auth::check())
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf

                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline navbar-text text-dark">{{ Auth::user()->nama }} ({{ Auth::user()->level }})</span>
                                    <img class="img-profile rounded-circle" src="{{ asset('storage/foto/' . Auth::user()->foto) }}" alt="User Profile Picture">
                                </a>
                                <!-- Dropdown - Informasi Pengguna -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="profil">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </form>
                            @else
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                            @endif
                        </li>
                    </ul>

                </nav>
                @yield('content')
                <!-- End of Topbar -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Handle sidebar toggler
            $('#sidebarToggleTop').on('click', function() {
                $('#accordionSidebar').toggleClass('toggled');
            });

            // Close the dropdown if user clicks outside of it
            $(document).click(function(event) {
                var clickover = $(event.target);
                var $navbar = $(".navbar-collapse");
                var _opened = $navbar.hasClass("show");
                if (_opened === true && !clickover.hasClass("navbar-toggler")) {
                    $navbar.collapse('hide');
                }
            });

            // Activate Bootstrap dropdowns
            $('.dropdown-toggle').dropdown();

            // Handle user dropdown specifically
            $('#userDropdown').on('click', function(event) {
                event.preventDefault();
                $(this).next('.dropdown-menu').toggle();
            });

            // Handle sidebar dropdowns
            $('[data-toggle="collapse"]').on('click', function(event) {
                event.preventDefault();
                var $target = $($(this).data('target'));
                $target.collapse('toggle');
            });
        });
    </script>

</body>

</html>