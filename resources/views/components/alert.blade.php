@if (session('success'))
    <script>
        Swal.fire({
            toast: true,
            icon: 'success',
            title: '{{ session('success') }}',
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            toast: true,
            icon: 'error',
            title: '{{ session('error') }}',
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500
        });
    </script>
@endif
