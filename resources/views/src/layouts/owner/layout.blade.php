<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/tasqira.webp">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/tasqira.webp') }}">
    <title>
        @yield('title')
    </title>
    @yield('chartjs')
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('argon') }}/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('argon') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('argon') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('argon') }}/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <!-- Tautkan file CSS DataTables -->
    @yield('css')


</head>

<body class="g-sidenav-show bg-gray-100">
    @if (Request::is('owner/profile*'))
        <div class="position-absolute w-100 min-height-300 top-0">
            <span class="mask bg-danger opacity-10"></span>
        </div>
    @else
        <div class="min-height-300 bg-danger position-absolute w-100"></div>
    @endif
    @include('src.component.owner.sidebar.sidebar')
    @if (Request::is('owner/profile*'))
        <div class="main-content position-relative max-height-vh-100 h-100">
            {{-- @include('dashboard.component.navbar.navbar') --}}

            @yield('content')
            @include('sweetalert::alert')

        </div>
    @else
        <main class="main-content position-relative border-radius-lg ">
            <!-- Navbar -->
            @include('src.component.owner.navbar.navbar')
            <!-- End Navbar -->
            <!-- Content -->
            @yield('content')
            <!-- End Content -->
            @include('sweetalert::alert')
        </main>
    @endif


    @include('src.component.owner.plugins.plugin')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

    <!--   Core JS Files   -->
    <script src="{{ asset('argon') }}/assets/js/core/popper.min.js"></script>
    <script src="{{ asset('argon') }}/assets/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('argon') }}/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('argon') }}/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="{{ asset('argon') }}/assets/js/plugins/chartjs.min.js"></script>
    @stack('chart')
    @stack('chartjs')
    @stack('chartLine')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('argon') }}/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
    @stack('script')
</body>

</html>
