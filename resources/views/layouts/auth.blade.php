<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Police App</title>

    <!-- Favicon aplikasi -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/fav.png') }}" />

    <!-- CSS utama aplikasi (gabungan dari berbagai komponen UI) -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />

    <!-- Plugin SweetAlert2 untuk menampilkan notifikasi pop-up interaktif -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Axios untuk AJAX request berbasis Promise -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body>

    @include('components.alert')

    @yield('content')

    <!-- jQuery library (dibutuhkan untuk banyak plugin JS) -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap JS (untuk interaksi UI seperti modal, dropdown, dll) -->
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Iconify (untuk menampilkan icon dari berbagai library dalam satu tempat) -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

    <script src="{{ asset('js/auth.js') }}"></script>
    <script src="{{ asset('js/register.js') }}"></script>
</body>

</html>
