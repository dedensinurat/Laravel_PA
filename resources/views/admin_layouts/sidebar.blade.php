<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
        <div class="sidebar-brand-icon">
            <img class="img-profile rounded-circle" src="{{ asset('storage/img/logoTutWuri_1712843779.png ') }}"
                style="width: 100px; height: 70px; margin-right:;">
        </div>
        <div class="sidebar-brand-text mx-2">Admin Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Menu Utama
    </div>

    <li class="nav-item {{ isRouteActive('admin.home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="fas fa-home fa-fw"></i>
            <span>Beranda</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Tampilan Satu
    </div>

    <li class="nav-item {{ isRouteActive('admin.profile.sekolah') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.profile.sekolah') }}">
            <i class="fas fa-school fa-fw"></i>
            <span>Profil Sekolah</span>
        </a>
    </li>


    <li class="nav-item {{ isRouteActive('prestasis.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('prestasis.index') }}">
            <i class="fas fa-award fa-fw"></i>
            <span>Prestasi</span>
        </a>

    <li class="nav-item {{ isRouteActive('pengumumans.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pengumumans.index') }}">
            <i class="fas fa-school fa-fw"></i>
            <span>Pengumuman</span>
        </a>
    </li>

    <li class="nav-item {{ isRouteActive('kegiatan-siswa.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kegiatan-siswa.index') }}">
            <i class="fas fa-running fa-fw"></i>
            <span>Kegiatan Siswa</span>
        </a>
    </li>

    <li class="nav-item {{ isRouteActive('sejarah.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('sejarah.index') }}">
            <i class="fas fa-history fa-fw"></i>
            <span>Sejarah</span>
        </a>
    </li>

    <li class="nav-item {{ isRouteActive('fasilitas.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('fasilitas.index') }}">
            <i class="fas fa-building fa-fw"></i>
            <span>Fasilitas</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Tampilan Dua
    </div>

    <li class="nav-item {{ isRouteActive('schedule.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('schedule.index') }}">
            <i class="fas fa-calendar-alt fa-fw"></i>
            <span>Jadwal Pelajaran</span>
        </a>
    </li>
    <li class="nav-item {{ isRouteActive('course.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('course.index') }}">
            <i class="fas fa-book-open fa-fw"></i>
            <span>Mata Pelajaran</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Tampilan Tiga
    </div>

    <li class="nav-item {{ isRouteActive('teachers.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('teachers.index') }}">
            <i class="fas fa-chalkboard-teacher fa-fw"></i>
            <span>Guru</span>
        </a>
    </li>


    <li class="nav-item {{ isRouteActive('students.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('students.index') }}">
            <i class="fas fa-user-graduate fa-fw"></i>
            <span>Siswa</span>
        </a>
    </li>

    <li class="nav-item {{ isRouteActive('classes.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('classes.index') }}">
            <i class="fas fa-school fa-fw"></i>
            <span>Kelas</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Tampilan Empat
    </div>

    <li class="nav-item {{ isRouteActive('inbox.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('inbox.index') }}">
            <i class="fas fa-inbox fa-fw"></i>
            <span>Inbox</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
