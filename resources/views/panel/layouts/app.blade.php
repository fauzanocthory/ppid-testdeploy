<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('meta')
    <title>@yield('title', 'Selamat Datang di PTSP')</title>

    @stack('upper_styles')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset("assets/panel/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("assets/panel/css/adminlte.min.css")}}">
    <style>
        label.required::after,
        label[required]::after {
            content: " *";
            color: red;
        }
    </style>
    @stack('lower_styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        @include('panel.layouts.partials.header')
        @include('panel.layouts.partials.sidebar')
        @yield('content')
        @include('panel.layouts.partials.footer')

    </div>
    <div class="custom-html">
        @stack('custom_html')
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    @stack('upper_scripts')
    <!-- jQuery -->
    <script src="{{ asset('assets/panel/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/panel/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/panel/js/adminlte.min.js') }}"></script>
    @stack('lower_scripts')
</body>

</html>