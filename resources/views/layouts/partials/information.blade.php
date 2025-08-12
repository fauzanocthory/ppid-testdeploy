<!-- Faq Section -->
<section id="faq" class="faq section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    {{-- <h2>LAYANAN INFORMASI</h2> --}}
    <div><span>Informasi</span> <span class="description-title">Berkala</span></div>
    <p>Update informasi terbaru seputar Kementerian Agama Provinsi Riau</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4 justify-content-between">
      <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
          <div class="card custom-shadow pt-1">
            <div class="card-body">
              {{-- News Card 1 --}}
              <div class="mb-3 news-card bg-white rounded-3 overflow-hidden shadow-md d-flex flex-column flex-md-row">
                <div class="col-12 col-md-6 overflow-hidden p-0">
                  <img
                    src="https://plus.unsplash.com/premium_photo-1661877737564-3dfd7282efcb?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Berita Teknologi" class="news-image w-100 h-100 object-fit-cover">
                </div>
                <div class="col-md-6 p-4 d-flex flex-column justify-content-between">
                  <div>
                    <div class="d-flex align-items-center mb-2">
                      <span class="badge bg-primary me-2">Teknologi</span>
                      <span class="text-muted small"><i class="far fa-clock me-1"></i> 2 jam yang lalu</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-3">Inovasi Terbaru di Dunia AI Mengubah Cara Kerja Perusahaan</h5>
                    <p class="text-muted mb-2">Perusahaan teknologi terkemuka meluncurkan platform AI baru yang diklaim
                      dapat meningkatkan produktivitas hingga.....</p>
                  </div>
                  <button class="btn btn-success btn-more align-self-start d-flex align-items-center" type="button">
                    Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                  </button>
                </div>
              </div>
              {{-- News Card 2 --}}
              <div class="mb-3 news-card bg-white rounded-3 overflow-hidden shadow-md d-flex flex-column flex-md-row">
                <div class="col-12 col-md-6 overflow-hidden p-0">
                  <img
                    src="https://plus.unsplash.com/premium_photo-1661877737564-3dfd7282efcb?q=80&w=1200&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Berita Teknologi" class="news-image w-100 h-100 object-fit-cover">
                </div>
                <div class="col-md-6 p-4 d-flex flex-column justify-content-between">
                  <div>
                    <div class="d-flex align-items-center mb-2">
                      <span class="badge bg-primary me-2">Teknologi</span>
                      <span class="text-muted small"><i class="far fa-clock me-1"></i> 2 jam yang lalu</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-3">Inovasi Terbaru di Dunia AI Mengubah Cara Kerja Perusahaan</h5>
                    <p class="text-muted mb-2">Perusahaan teknologi terkemuka meluncurkan platform AI baru yang diklaim
                      dapat meningkatkan produktivitas hingga.....</p>
                  </div>
                  <button class="btn btn-success btn-more align-self-start d-flex align-items-center" type="button">
                    Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
          <div class="card custom-shadow mb-2  px-4">
            <div class="card-body">
              <div class="sidebar-item">
                <div class="sidebar-title my-3">
                  <h2 class="text-uppercase">Informasi Serta Merta Berkala</h2>
                </div>
                <div class="sidebar-body">
                  <ul class="list-group list-group-flush">

                    @forelse ($informasiSertaMertaContents as $informasiSertaMertaContent)
            <li class="list-group-item px-1 py-3">
              <a
              href="{{ route('contents.show', [$informasiSertaMertaCategory->slug, $informasiSertaMertaContent->slug]) }}"><strong>{{ $informasiSertaMertaContent->title }}</strong></a>
            </li>
          @empty
            <h6 class="text-center">Informasi Serta Merta Berkala Kosong</h6>
          @endforelse
                  </ul>
                </div>
                <div class="sidebar-footer d-flex justify-content-center mb-2 mt-2">
                  <a href="{{ route('contents.content_by_category', 'informasi-serta-merta') }}"
                    class="btn btn-success btn-more align-self-start d-flex align-items-center">
                    Lihat Semua Informasi</i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</section><!-- /Faq Section -->