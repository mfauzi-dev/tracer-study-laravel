<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Tracer Study</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">TS</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-school"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">User</li>

            <li>
                <a class="nav-link" href="#">
                    <i class="fas fa-user-lock"></i>
                    <span>Data Admin</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/user/alumni*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.alumni') }}">
                    <i class="fas fa-user-graduate"></i>
                    <span>Data Alumni</span>
                </a>
            </li>

            <li class="menu-header">Fakultas</li>

            <li class="{{ Request::is('admin/tahun-akademik*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.tahun_akademik') }}">
                    <i class="fas fa-layer-group"></i>
                    <span>Data Tahun Akademik</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/fakultas*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.fakultas') }}">
                    <i class="fas fa-layer-group"></i>
                    <span>Data Fakultas</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/program-studi*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.program-studi') }}">
                    <i class="fas fa-layer-group"></i>
                    <span>Data Program Studi</span>
                </a>
            </li>

            <li class="menu-header">Kuesioner</li>

            <li class="{{ Request::is('admin/pertanyaan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.pertanyaan') }}">
                    <i class="fab fa-acquisitions-incorporated"></i>
                    <span>Data Pertanyaan</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/pilihan-jawaban*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.pilihan') }}">
                    <i class="fas fa-check-square"></i>
                    <span>Data Pilihan</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="#">
                    <i class="fas fa-table"></i>
                    <span>Data Jawaban</span>
                </a>
            </li>


            <li class="menu-header">Alumni</li>

            <li>
                <a class="nav-link" href="#">
                    <i class="fas fa-address-card"></i>
                    <span>Data Biodata</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="#">
                    <i class="fas fa-search-location"></i>
                    <span>Data Lokasi</span>
                </a>
            </li>

        </ul>
    </aside>
</div>
