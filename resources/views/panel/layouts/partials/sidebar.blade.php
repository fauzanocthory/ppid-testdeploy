<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('panel.dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/img/kemenag-logo.png') }}" alt="AdminLTE Logo" class="brand-image"
            style="opacity: .8">
        <span class="brand-text font-weight-bold">PPID Web Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/panel/img/admin.svg') }}" class="" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('panel.dashboard') }}"
                        class="nav-link {{ request()->is('panel') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('panel.categories.index') }}"
                        class="nav-link {{ request()->is('panel/kategori*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Kategori
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('panel.contents.index') }}"
                        class="nav-link {{ request()->is('panel/konten*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Konten
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-logout" data-backdrop="false">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="modal-logout">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="logoutModalLabel"><i class="fas fa-sign-out-alt"></i> Konfirmasi Logout
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center mt-3">
                    <p>Apakah Anda yakin ingin keluar?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <form id="logout-form" action="{{ route('panel.auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Ya, Logout</button>
                    </form>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>


</aside>