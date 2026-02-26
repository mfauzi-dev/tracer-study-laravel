<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Tracer Study</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">TS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Alumni</li>

            <li class="{{ Request::is('alumni/biodata*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('alumni.biodata') }}">
                    <i class="fas fa-user-graduate"></i>
                    <span>Biodata</span>
                </a>
            </li>

            <li class="{{ Request::is('alumni/kuesioner*') ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="fas fa-list"></i>
                    <span>Kuesioner</span>
                </a>
            </li>

            <li class="{{ Request::is('alumni/location*') ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>Lokasi Tempat Kerja</span>
                </a>
            </li>

            {{-- SETTING --}}
            <li class="menu-header">Setting</li>

            <li>
                <a class="nav-link" href="#">
                    <i class="fas fa-unlock-alt"></i>
                    <span>Update Password</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
