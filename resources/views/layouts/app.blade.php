<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PPID - @yield('title', '')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    @stack('upper_styles')
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.0/css/all.min.css"
        integrity="sha512-UJqci0ZyYcQ0AOJkcIkUCxLS2L6eNcOr7ZiypuInvEhO9uqIDi349MEFrqBzoy1QlfcjfURHl+WTMjEdWcv67A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('lower_styles')
    <style>
        .custom-shadow {
            /* box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15); */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            /* Lebih tebal & merata */
            border: none;
            border-radius: 0.5rem;
        }

        .submenu-font-style {
            color: black !important;
        }

        .submenu-font-style:hover {
            color: #018856 !important;
        }

        .sticky-sidebar {
            position: sticky;
            top: 100px;
            /* sesuaikan jarak dari atas (misal navbar tingginya 80px) */
            z-index: 10;
        }
    </style>
    </style>

</head>

<body class="@yield('body_class', 'index-page')"
    style="background-color: color-mix(in srgb, #018856, transparent 90%);">
    @include('layouts.partials.header')
    <main>
        @yield('content')
        <div class="container-fluid px-xl-5 px-0 mt-2">
            <div class="row g-3 m-0 px-1">
                <!-- Main Content -->
                <div class="col-xl-8 col-lg-8 col-md-12">
                    {{-- <div class="card custom-shadow">
                        <div class="card-body"> --}}
                            @yield('main_content')
                            {{-- </div>
                    </div> --}}
                </div>

                <!-- Sidebar -->
                <div class="col-xl-4 col-lg-4 col-md-12">
                    {{-- <div class="card custom-shadow">
                        <div class="card-body"> --}}
                            @yield('sidebar_content')
                            {{-- </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </main>
    @include('layouts.partials.footer')


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    {{-- <div id="preloader"></div> --}}

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    @stack('upper_scripts')
    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script
        src="https://cdn.jsdelivr.net/gh/PrabothCharith/accessibility-plugin@main/accessibility-menu.min.js"></script>

    {{--
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=K2f5ft1f"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const textElements = document.querySelectorAll('.header-menu-text'); // Dapatkan semua elemen
            let fontSizeClickCount = 0;

            // Simpan ukuran asli dari elemen pertama (asumsi semua elemen memiliki ukuran awal yang sama)
            const originalSize = textElements.length > 0
                ? window.getComputedStyle(textElements[0]).fontSize
                : '16px'; // Fallback default

            document.getElementById('font-size').addEventListener('click', function () {
                fontSizeClickCount++;
                let newSize;

                switch (fontSizeClickCount) {
                    case 1:
                        newSize = '20px';
                        break;
                    case 2:
                        newSize = '23px';
                        break;
                    case 3:
                        newSize = '26px';
                        break;
                    case 4:
                        newSize = originalSize;
                        fontSizeClickCount = 0;
                        break;
                }

                // Loop melalui semua elemen dan ubah ukuran font
                textElements.forEach(element => {
                    element.style.fontSize = newSize;
                });
            });
        });
    </script>
    @stack('lower_scripts')
</body>

</html>