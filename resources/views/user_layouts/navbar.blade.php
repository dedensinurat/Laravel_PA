<style>
    .custom-toggler {
        background-color: #ffffff;
        /* ljusblå färg */
        border-color: black;
        /* ljusblå färg */
    }

    .custom-toggler:hover {
        background-color: #9abcdf;
        /* ljusblå hover-färg */
        border-color: black;
        /* ljusblå hover-färg */
    }
</style>


<nav class="navbar navbar-expand-lg navbar-light bg-primary-cus">
    <div class="container d-flex align-items-end">
        <!-- Logo dan Informasi Nama Sekolah dan Alamat -->
        <div class="navbar-nav mr-auto" style="flex-direction: row">
            @php
                $profilSekolah = \App\Models\ProfilSekolah::first(); // Mengambil data ProfilSekolah pertama
                $logo_sekolah =
                    $profilSekolah && $profilSekolah->logo_sekolah
                        ? asset('public/' . $profilSekolah->logo_sekolah)
                        : asset('images/logoTutWuri.png');
            @endphp
            <a class="navbar-brand" href="{{ route('beranda') }}">
                <img src="{{ $logo_sekolah }}" alt="Logo Sekolah" height="70" class="mr-2">
            </a>
            <div class="navbar-text text-white" style="display: block;">
                <span
                    style="display: block; font-size: 1.2rem; font-weight: bold;">{{ $profilSekolah->nama_sekolah }}</span>
                <span style="display: block; font-size: 1rem;">{{ $profilSekolah->alamat_sekolah }}</span>
            </div>
        </div>

        <!-- Informasi Nomor Telepon dan Sosial Media -->
        <div class="ml-auto">
            <ul class="d-flex justify-content-end text-white navbar-nav" style="list-style-type: none; padding: 0;">
                <li class="nav-item mx-2">
                    <a class="nav-link text-white no-hover" href="#"><i class="fas fa-phone"></i>
                        {{ $profilSekolah->no_telepon_sekolah }}</a>
                </li>
                <li class="nav-item mx-2">
                    <!-- Link to User Inbox -->
                    <a class="nav-link text-white {{ isRouteActive('inbox.pengguna') ? 'active' : '' }}"
                        href="{{ route('inbox.pengguna') }}">
                        <i class="fas fa-inbox px-1"></i> Umpan Balik
                    </a>
                </li>
            </ul>
        </div>

        <!-- Tombol Toggle untuk Mobile -->
        <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-nav-cus">
    <div class="container">
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white {{ isRouteActive('beranda') ? 'active' : '' }}"
                        href="{{ route('beranda') }}">
                        <span class="button"></span> BERANDA
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        PROFIL
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('index.sejarah_siswa') }}">SEJARAH</a>
                        <a class="dropdown-item" href="{{ route('index.Visi_Misi') }}">VISI MISI</a>
                        <a class="dropdown-item" href="{{ route('index.fasilitas_siswa') }}">FASILITAS</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ isRouteActive('index.kegiatan_siswa') ? 'active' : '' }}"
                        href="{{ route('index.kegiatan_siswa') }}">KEGIATAN SISWA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ isRouteActive('index.prestasi_siswa') ? 'active' : '' }}"
                        href="{{ route('index.prestasi_siswa') }}">PRESTASI</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ isRouteActive('index.pengumuman_siswa') ? 'active' : '' }}"
                        href="{{ route('index.pengumuman_siswa') }}">PENGUMUMAN</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        EKSTERNAL LINK
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"
                            href="https://dapo.kemdikbud.go.id/sekolah/FA2F1E07A87E3BE5FB2E">DAPODIK</a>
                        <a class="dropdown-item"
                            href="https://sekolah.data.kemdikbud.go.id/index.php/chome/profil/30ED7A2B-8AD4-E111-9043-1796E6706F02">SEKOLAH
                            DATA KITA</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ isRouteActive('form') ? 'active' : '' }}"
                        href="{{ route('form') }}">LOGIN</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
