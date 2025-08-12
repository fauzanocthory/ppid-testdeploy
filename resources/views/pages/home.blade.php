@extends('layouts.app')
@section('title', 'Beranda')
@push('lower_styles')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .service {
            min-width: 180px;
            min-height: 260px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .service {
            transition: all 0.5s ease;

        }

        .service:hover {
            transform: translateY(-9px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            background-color: #f7f7f7ff;
        }

        .swiper {
            padding-bottom: 30px;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #28a745;
            /* atau warna lain sesuai tema */
        }
    </style>
@endpush()
@section('content')
    @include('layouts.partials.hero')
    @include('layouts.partials.faq')
    @include('layouts.partials.information')
    @include('layouts.partials.apps')
@endsection
@push('lower_scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000, // jeda 3 detik antar slide
                disableOnInteraction: false, // tetap autoplay meskipun user klik tombol
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                576: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                992: {
                    slidesPerView: 5,
                },
            },
        });
    </script>

@endpush