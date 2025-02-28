<link href="{{ asset('admin_assets/css/sweetalert2.min.css') }}" rel="stylesheet">
<script src="{{ asset('admin_assets/js/sweetalert2.all.min.js') }}"></script>

@if (session('success'))
    <script>
        Swal.fire({
            title: 'Sukses!',
            text: '{{ session('success') }}',
            icon: 'success',
            showConfirmButton: false,
            timer: 2000 // Durasi tampilan pesan dalam milidetik (opsional)
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            showConfirmButton: false,
            
        });
    </script>
@endif
