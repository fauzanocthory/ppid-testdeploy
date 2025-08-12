@extends('layouts.app')

@section('title', (isset($title) ? $title : 'Blank Page'))

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background pb-4">
        <div class="container" data-aos="fade-up">
            <div class="row align-items-center">
                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <div>
                        <span>Blank Page</span>
                    </div>
                    <p>This is a blank page. Use this page to start from scratch.</p>
                </div><!-- End Section Title -->
            </div>
        </div>
    </section><!-- /Hero Section -->
@endsection
@section('main_content')
    @include('layouts.partials.about')

@endsection
@section('sidebar_content')
    <div class="card custom-shadow mb-3 sticky-sidebar">
        <div class="card-body">
            <div class="sidebar-item">
                <div class="sidebar-title mb-2">
                    <h2 class="text-capitalize">Informasi Serta Merta</h2>
                </div>
                <div class="sidebar-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-1">
                            <a href="#"><strong>PTSP Menghadirkan Layanan Pengajuan Online</strong></a>
                        </li>
                        <li class="list-group-item px-1">
                            <a href="#"><strong>Dapibus
                                    ac
                                    facilisis
                                    in Cras
                                    justo
                                    odio</strong></a>
                        </li>
                        <li class="list-group-item px-1">
                            <a href="#"><strong>Morbi leo
                                    risus Cras
                                    justo
                                    odio</strong></a>
                        </li>
                        <li class="list-group-item px-1">
                            <a href="#"><strong>Porta ac
                                    consectetur
                                    ac Cras
                                    justo
                                    odio</strong></a>
                        </li>
                        <li class="list-group-item px-1">
                            <a href="#"><strong>Vestibulum
                                    at eros Cras
                                    justo
                                    odio</strong></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection