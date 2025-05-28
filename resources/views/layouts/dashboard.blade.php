<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Polisi App</title>

    <!-- Favicon aplikasi -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/fav.png') }}" />

    <!-- CSS utama -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />

    <!-- Plugin pihak ketiga -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">




</head>

<body>
    @include('components.alert')

    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- App Topstrip -->
        <div class="app-topstrip bg-dark py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center justify-content-center gap-5 mb-2 mb-lg-0">
                <!-- Konten topstrip opsional -->
            </div>
        </div>

        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Wrapper -->
        <div class="body-wrapper">

            <!-- Header -->
            @include('components.navbar')

            <!-- Konten Halaman -->
            @yield('content')

        </div> <!-- End body-wrapper -->

    </div> <!-- End page-wrapper -->

    <!-- Script Library -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>

    <!-- Script Aplikasi -->
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="{{ asset('js/utils.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/vehicles.js') }}"></script>
</body>

</html>
