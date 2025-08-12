@extends('layouts.app')

@section('title', (isset($category->name) ? $category->name : ''))
@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background pb-4">
        <div class="container" data-aos="fade-up">
            <div class="row align-items-center">
                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <div>
                        <span>{{ (isset($category->name) ? $category->name : '') }}</span>
                    </div>
                    <p>{{ (isset($category->description) ? $category->description : '') }}</p>
                </div><!-- End Section Title -->
            </div>
        </div>
    </section><!-- /Hero Section -->
@endsection
@section('main_content')
    <div class="card custom-shadow mb-3">
        <div class="card-body">
            <!-- About Section -->
            <section id="about" class="about section pt-3">
                <div class="container">
                    <div class="row align-items-center px-2">
                        @isset($content->title)
                            <div class="page-heading">
                                <h2 style="font-size: 2rem !important;">{{ $content->title }}
                                </h2>
                            </div>
                        @endisset
                        @isset($content->description)
                            <div class="page-description mb-3">
                                <span style="font-size: 1.1rem !important; font-style: italic;">{{ $content->description }}
                                </span>
                            </div>
                        @endisset
                        @isset($content->thumbnail)
                            <div class="col-lg-12 col-md-12">
                                <div class="about-image">
                                    <img src="{{ asset('storage/' . $content->thumbnail)}}" alt="Tentang PTSP"
                                        class="img-fluid main-image"
                                        style="height: 500px !important; width: 100% !important; object-fit: cover; border-radius: 7px;">
                                </div>
                            </div>
                        @endisset
                        @isset($content->body)
                                <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="300">
                                    {!! $content->body !!}
                                </div>
                            </div>
                        @endisset
                    @if($content->embeds->isNotEmpty())
                        @foreach ($content->embeds as $embed)
                            <div class="col-12">
                                <h5 class="mt-4 mb-2">{{ $embed->title }}</h5>
                                <iframe src="{{ $embed->url }}" width="100%" height="600"></iframe>
                            </div>
                        @endforeach
                    @endif
                    @if($content->hyperlinks->isNotEmpty())
                        <div class="hyperlink px-2">
                            <h5 class="mt-4 mb-2">Tautan Keluar</h5>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col" width="65%">Tautan</th>
                                        <th scope="col" width="30%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($content->hyperlinks as $hyperlink)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{$hyperlink->label}}</td>
                                            <td><a href="{{ format_url($hyperlink->url) }}" class="btn btn-primary btn-sm"
                                                    target="_blank"><i class="fa fa-link"></i>
                                                    &nbsp;Kunjungi</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if($content->attachments->isNotEmpty())
                        <div class="attachment px-2">
                            <h5 class="mt-4 mb-2">Lampiran</h5>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col" width="65%">Lampiran</th>
                                        <th scope="col" width="30%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($content->attachments as $attachment)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{$attachment->filename}}</td>
                                            <td><a href="{{ asset('storage/' . $attachment->filepath) }}"
                                                    class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i>
                                                    &nbsp;Download</a></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </section><!-- /About Section -->
        </div>
    </div>

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
                        @forelse ($informasiSertaMertaContents as $informasiSertaMertaContent)
                            <li class="list-group-item px-1 py-3">
                                <a
                                    href="{{ route('contents.show', [$informasiSertaMertaCategory->slug, $informasiSertaMertaContent->slug]) }}"><strong>{{ $informasiSertaMertaContent->title }}</strong></a>
                            </li>
                        @empty
                            <h6 class="text-center mt-3">Informasi Serta Merta Berkala Kosong</h6>
                        @endforelse
                        <div class="sidebar-footer d-flex justify-content-center mt-3">
                            <a class="btn btn-success btn-more align-self-start d-flex align-items-center">
                                Lihat Semua Informasi</i>
                            </a>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection