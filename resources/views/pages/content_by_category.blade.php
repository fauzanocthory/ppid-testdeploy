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
            <section id="about" class="about section py-0">
                <div class="container p-1">
                    {{-- Search Bar --}}
                    <form action="" method="get">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search"
                                placeholder="Cari {{ $category->name }}..." aria-label="Cari {{ $category->name }}..."
                                aria-describedby="button-addon2">
                            <button class="btn btn-success" type="submit" id="button-addon2"><i
                                    class="fas fa-search"></i></button>

                        </div>
                    </form>

                    @forelse($contents as $content)
                        <div class="col-12 mb-3">
                            <div class="card flex-column flex-md-row"
                                style="overflow:hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border: none; border-radius: 8px;"
                                onmouseover="this.style.boxShadow='0 8px 16px rgba(0,0,0,0.2)';"
                                onmouseout="this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';">
                                {{-- Gambar --}}
                                <div>
                                    @if($content->thumbnail)
                                        <img src="{{ asset('storage/' . $content->thumbnail) }}" alt="{{ $content->title }}"
                                            style="max-width:300px; height:200px; object-fit:cover; object-position:center;">
                                    @else
                                        <img src="{{ asset('assets/img/hero-img.jpg') }}" alt="No Image"
                                            style="width:300px; height:200px; object-fit:cover; object-position:center;">
                                    @endif
                                </div>

                                {{-- Teks --}}
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $content->title }}</h5>
                                    <p class="card-text flex-grow-1">
                                        {{ $content->description ?: Str::limit(strip_tags($content->body), 100) }}
                                    </p>
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <span class="text-muted pt-2"> {{ $content->created_at->locale('id')->diffForHumans() }}
                                        </span>
                                        <a href="{{ route('contents.show', [$category->slug, $content->slug]) }}"
                                            class="btn btn-success">
                                            Selengkapnya...
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted">Tidak ada konten tersedia.</p>
                        </div>
                    @endforelse
                    <div class="d-flex justify-content-center gap-3 mt-3">
                        <a href="?page={{ $page - 1 }}"
                            class=" btn btn-success {{ $page <= 1 ? 'disabled' : '' }}">Sebelumnya</a>
                        <a href="?page={{ $page + 1 }}"
                            class="btn btn-success {{ !$hasNext ? 'disabled' : '' }}">Selanjutnya</a>
                    </div>

                </div>
            </section>
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
                            <a href="{{ route('contents.content_by_category', 'informasi-serta-merta') }}"
                                class="btn btn-success btn-more align-self-start d-flex align-items-center">
                                Lihat Semua Informasi</i>
                            </a>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection