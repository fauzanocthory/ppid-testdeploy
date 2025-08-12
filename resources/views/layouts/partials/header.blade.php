<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

        {{-- <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0"> --}}
            <!-- Uncomment the line below if you also wish to use an image logo -->
            {{-- <img src="assets/img/logo.webp" alt="">
            <h4 class="sitename">PELAYANAN TERPADU SATU PINTU</h4>
            <h1 class="sitename">KANWIL KEMENAG RIAU</h1>
        </a> --}}

        <a href="#" class="d-flex align-items-center">
            <img src="{{ asset('assets/img/kemenag-logo.png') }}" alt="Logo" class="me-3" style="width: 50px;">
            <div class="logo-text mt-1">
                <h3 class="mb-0">PPID UNIT</h3>
                <p class="mb-0 text-white">KANWIL KEMENAG RIAU</p>
            </div>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active header-menu-text">Beranda</a></li>
                <li class="dropdown">
                    <a href="#"><span class="header-menu-text">Profil</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a class="submenu-font-style header-menu-text" href="/profilPPID.html">Profil Kantor Wilayah
                                Kementerian
                                Agama
                                Provinsi Riau</a></li>
                        <li><a class="submenu-font-style header-menu-text" href="/profilPejabat.html">Profil Kepala
                                Kantor Kemenag
                                Kab/Kota</a></li>
                        <li><a class="submenu-font-style header-menu-text" href="/visiMisiMotoPPID.html">Profil Kantor
                                Urusan Agama</a>
                        </li>
                        <li><a class="submenu-font-style header-menu-text" href="/tugasFungsiWewenangPPID.html">Profil
                                Madrasah</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#"><span class="header-menu-text">Informasi Publik</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a class="submenu-font-style header-menu-text" href="/profilPPID.html">Alamat Kantor</a>
                        </li>
                        <li><a class="submenu-font-style header-menu-text" href="/profilPejabat.html">Visi & Misi</a>
                        </li>
                        <li><a class="submenu-font-style header-menu-text" href="/visiMisiMotoPPID.html">Struktur
                                Organisasi</a></li>
                        <li><a class="submenu-font-style header-menu-text" href="/tugasFungsiWewenangPPID.html">Lima
                                Nilai Budaya Kerja
                                Kemenag</a></li>
                        <li><a class="submenu-font-style header-menu-text"
                                href="/tugasFungsiWewenangPPID.html">Regulasi</a></li>
                        <li><a class="submenu-font-style header-menu-text"
                                href="/tugasFungsiWewenangPPID.html">Lainnya</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#"><span class="header-menu-text">Layanan Informasi</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a class="submenu-font-style header-menu-text" href="#">Tata Cara Permohonan Informasi</a>
                        </li>
                        <li><a class="submenu-font-style header-menu-text" href="#">Tata Cara Pengajuan Keberatan</a>
                        </li>
                        <li><a class="submenu-font-style header-menu-text" href="#">Tata Cara Pengajuan Penyelesaian
                                Sengketa
                                Informasi</a>
                        </li>
                        <li><a class="submenu-font-style header-menu-text" href="#">Standar Pengumuman Informasi</a>
                        </li>
                        <li><a class="submenu-font-style header-menu-text" href="#">Tata Cara Pengaduan Masyarakat</a>
                        </li>
                        <li><a class="submenu-font-style header-menu-text" href="#">Alasan Pengajuan Keberatan</a></li>
                        <li><a class="submenu-font-style header-menu-text" href="#">Formulir Permintaan Informasi
                                Publik</a></li>
                        <li><a class="submenu-font-style header-menu-text" href="#">Formulir Keberatan Informasi
                                Publik</a></li>
                        <li><a class="submenu-font-style header-menu-text" href="#">Tanda Bukti Penyerahan Informasi
                                Publik</a></li>
                        <li><a class="submenu-font-style header-menu-text" href="#">SOP Layanan Informasi</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#"><span class="header-menu-text">Standar Layanan</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a class="submenu-font-style header-menu-text" href="#">Maklumat Pelayanan</a></li>
                        <li><a class="submenu-font-style header-menu-text" href="#">Jadwal Pelayanan</a></li>
                        <li><a class="submenu-font-style header-menu-text" href="#">Biaya/Tarif Layanan</a></li>
                        <li><a class="submenu-font-style header-menu-text" href="#">Arah Kebijakan Layanan</a></li>
                        <li><a class="submenu-font-style header-menu-text" href="#">Standar Pelayanan</a></li>
                    </ul>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted header-menu-text" href="#consultation">LOGIN</a>

    </div>
</header>