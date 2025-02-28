@extends('admin_layouts.app')

@section('title', 'Dashboard')

@section('contents')
    <style>
        .card {
            position: relative;
            transition: transform 0.3s, opacity 0.3s ease-in-out;
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(128, 120, 120, 0.304);
            transition: opacity 0.3s ease-in-out;
        }

        .card:hover::before {
            opacity: 0;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <p>Selamat datang di Dashboard Admin.</p>
                <a href="{{ route('user_login.index') }}" class="btn btn-primary mb-4">Kelola Users</a>
            </div>
        </div>
        <div class="row">
            @foreach ($modelData as $model)
                @if ($model['name'] == 'ProfilSekolah')
                    <div class="col-md-4">
                        <div class="card mb-3 bg-info text-white" style="cursor: pointer;">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-school fa-3x mr-3"></i>
                                <div>
                                    <h5 class="card-title mb-0">Profil Sekolah</h5>
                                    <p>Total: {{ $model['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($model['name'] == 'Prestasi')
                    <div class="col-md-12">
                        <div class="card mb-3 bg-success text-white" style="cursor: pointer;">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-trophy fa-3x mr-3"></i>
                                <div>
                                    <h5 class="card-title mb-0">Prestasi</h5>
                                    <p>Total: {{ $model['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($model['name'] == 'Inbox')
                    <div class="col-md-12">
                        <div class="card mb-3 bg-light-subtle text-black" style="cursor: pointer;">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-envelope fa-3x mr-3"></i>
                                <div>
                                    <h5 class="card-title mb-0">Inbox</h5>
                                    <p>Total: {{ $model['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($model['name'] == 'Pengumuman')
                    <div class="col-md-6">
                        <div class="card mb-3 bg-warning text-white" style="cursor: pointer;">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-bullhorn fa-3x mr-3"></i>
                                <div>
                                    <h5 class="card-title mb-0">Pengumuman</h5>
                                    <p>Total: {{ $model['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($model['name'] == 'KegiatanSiswa')
                    <div class="col-md-6">
                        <div class="card mb-3 bg-primary text-white" style="cursor: pointer;">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-users fa-3x mr-3"></i>
                                <div>
                                    <h5 class="card-title mb-0">Kegiatan Siswa</h5>
                                    <p>Total: {{ $model['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($model['name'] == 'Sejarah')
                    <div class="col-md-4">
                        <div class="card mb-3 bg-secondary text-white" style="cursor: pointer;">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-history fa-3x mr-3"></i>
                                <div>
                                    <h5 class="card-title mb-0">Sejarah</h5>
                                    <p>Total: {{ $model['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($model['name'] == 'Fasilitas')
                    <div class="col-md-4">
                        <div class="card mb-3 bg-dark text-white" style="cursor: pointer;">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-building fa-3x mr-3"></i>
                                <div>
                                    <h5 class="card-title mb-0">Fasilitas</h5>
                                    <p>Total: {{ $model['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($model['name'] == 'JadwalPelajaran')
                    <div class="col-md-4">
                        <div class="card mb-3 bg-light text-dark" style="cursor: pointer;">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-calendar-alt fa-3x mr-3"></i>
                                <div>
                                    <h5 class="card-title mb-0">Jadwal Pelajaran</h5>
                                    <p>Total: {{ $model['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($model['name'] == 'MataPelajaran')
                    <div class="col-md-4">
                        <div class="card mb-3 bg-danger text-white" style="cursor: pointer;">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-book fa-3x mr-3"></i>
                                <div>
                                    <h5 class="card-title mb-0">Mata Pelajaran</h5>
                                    <p>Total: {{ $model['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($model['name'] == 'Absensi')
                    <div class="col-md-12">
                        <div class="card mb-3 bg-info text-white" style="cursor: pointer;">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-clipboard-check fa-3x mr-3"></i>
                                <div>
                                    <h5 class="card-title mb-0">Absensi</h5>
                                    <p>Total: {{ $model['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($model['name'] == 'Classes')
                    <div class="col-md-4">
                        <div class="card mb-3 bg-success text-white" style="cursor: pointer;">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-chalkboard fa-3x mr-3"></i>
                                <div>
                                    <h5 class="card-title mb-0">Kelas</h5>
                                    <p>Total: {{ $model['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($model['name'] == 'Hours')
                    <div class="col-md-4">
                        <div class="card mb-3 bg-warning text-white" style="cursor: pointer;">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-clock fa-3x mr-3"></i>
                                <div>
                                    <h5 class="card-title mb-0">Jam Pelajaran</h5>
                                    <p>Total: {{ $model['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($model['name'] == 'UserWeb')
                    <div class="col-md-12">
                        <div class="card mb-3 bg-secondary text-white" style="cursor: pointer;">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-user fa-3x mr-3"></i>
                                <div>
                                    <h5 class="card-title mb-0">Pengguna Web</h5>
                                    <p>Total: {{ $model['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($model['name'] == 'Teacher')
                    <div class="col-md-4">
                        <div class="card mb-3 bg-dark text-white" style="cursor: pointer;">
                            <div class="card-body d-flex align-items-center">
                                <i class="fas fa-chalkboard-teacher fa-3x mr-3"></i>
                                <div>
                                    <h5 class="card-title mb-0">Guru</h5>
                                    <p>Total: {{ $model['count'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
