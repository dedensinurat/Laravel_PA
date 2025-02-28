<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Nunito font -->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Source Sans Pro font -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Bootstrap CSS -->
    <link href="{{ asset('user_assets/css/custom_bootstrap.css') }}" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logoTutWuri.png') }}" type="image/x-icon">
    <!-- SweetAlert2 CSS -->
    <link href="{{ asset('admin_assets/css/sweetalert2.min.css') }}" rel="stylesheet">
    <style>
        body {
            background: #D9E1EF;
            font-family: 'Source Sans Pro', sans-serif;
            /* Set Source Sans Pro as the default font */
        }
    </style>
</head>

<body>
    {{-- Helper untuk active nav --}}
    @include('_helpers')

    @include('message')

    <!-- Navbar -->
    <div id="navbar">
        @include('user_layouts.navbar')
    </div>

    <!-- Content -->
    <div class="content" id="contents">
        @yield('contents')
    </div>

    <!-- Footer -->
    <div id="footer">
        @include('user_layouts.footer')
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JavaScript -->
    <script src="{{ asset('admin_assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/script_sweetalert2.all.min.js') }}"></script>
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script src="{{ asset('admin_assets/js/script_ckeditor.js') }}"></script>
    <!-- Custom scripts for all pages -->
    <script src="{{ asset('user_assets/js/custom.js') }}"></script>
</body>

</html>
