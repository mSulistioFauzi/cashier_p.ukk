<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, bootstrap 5 admin">
    <meta name="description" content="Flexy Admin Lite - Bootstrap 5 Admin Dashboard Template">
    <meta name="robots" content="noindex,nofollow">
    <title>@yield('title') - IndoApril</title>
    
    <link rel="canonical" href="https://www.wrappixel.com/templates/Flexy-admin-lite/" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    
    <!-- Custom CSS -->
    <link href="{{ asset('assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">

    @stack('styles') <!-- Untuk custom CSS di halaman lain -->
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        @include('layouts.navbar')  <!-- Navbar -->
        @include('layouts.sidebar') <!-- Sidebar -->

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item">
                                  <a href="javascript:history.back()" class="link"><i class="mdi mdi-home-outline fs-4"></i></a>
                              </li>
                              <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                            </ol>
                        </nav>
                        <h1 class="mb-0 fw-bold">@yield('title')</h1> 
                    </div>
                </div>
            </div>

            <!-- Konten Halaman -->
            <div class="container-fluid">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="footer text-center">
                All Rights Reserved by Flexy Admin. Designed and Developed by 
                <a href="https://www.wrappixel.com">WrapPixel</a>.
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/waves.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dist/js/custom.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboards/dashboard1.js') }}"></script>

    @stack('scripts') <!-- Untuk custom script di halaman lain -->
</body>
</html>
