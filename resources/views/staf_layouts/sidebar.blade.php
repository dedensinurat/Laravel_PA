<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
        <div class="sidebar-brand-icon">
            <img class="img-profile rounded-circle" src="{{ asset('storage/img/logoTutWuri_1712843779.png ') }}"
                style="width: 100px; height: 70px; margin-right:;">
        </div>
        <div class="sidebar-brand-text mx-3">Staf Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Menu Utama
    </div>

    <li class="nav-item {{ isRouteActive('staf.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('staf.index') }}">
            <i class="fas fa-home fa-fw"></i>
            <span>Beranda</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Fitur
    </div>

    <li class="nav-item {{ isRouteActive('staf_jadwal_guru') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('staf_jadwal_guru') }}">
            <i class="fas fa-calendar-alt fa-fw"></i>
            <span>Jadwal</span>
        </a>
    </li>

    <li class="nav-item {{ isRouteActive('staf.absensi') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('staf.absensi') }}">
            <i class="fas fa-user-check fa-fw"></i>
            <span>Absensi</span>
        </a>
    </li>

    <li class="nav-item {{ isRouteActive('staf.siswa') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('staf.siswa') }}">
            <i class="fas fa-user-graduate fa-fw"></i>
            <span>Siswa</span>
        </a>
    </li>

    <li class="nav-item {{ isRouteActive('staf.guru') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('staf.guru') }}">
            <i class="fas fa-chalkboard-teacher fa-fw"></i>
            <span>guru</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
