@extends('user_layouts.app')

@section('contents')
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 15px;
        }
    </style>

    <section class="welcome-section row g-5"
        style="display: flex; margin: 0; padding: 170px 10% 150px 10%; background-image: url('images/bisa.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="col-lg-6 mt-0">
            <h2 style="color: white;">Selamat Datang di</h2>
            <h1 style="color: white;">Fasilitas SMPN 3 Laguboti</h1>
        </div>
    </section>
    <div class="opacity-section"
        style="height: 50px; opacity: 2; position:relative; top:-45px; background-image: linear-gradient(to bottom, rgba(0,0,0,0), #D9E1EF,#D9E1EF,#D9E1EF);">
    </div>
    <main class="container" style="position:relative; margin-bottom:10vh;">
        <div class="container-xxl pb-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <div
                            style="background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease-in-out;">
                            <p class="d-inline-block border rounded-pill py-1 px-4">Fasilitas Sekolah </p><br>
                            <p><i class="far fa-check-circle text-primary me-3"></i>Cromebook</p>
                            <p><i class="far fa-check-circle text-primary me-3"></i>Perpustakaan</p>
                            <p><i class="far fa-check-circle text-primary me-3"></i>Laboratorium Komputer</p>
                            <p><i class="far fa-check-circle text-primary me-3"></i>Laboratorium Ipa</p>
                            <p><i class="far fa-check-circle text-primary me-3"></i>Gedung Pertemuan</p>
                            <p><i class="far fa-check-circle text-primary me-3"></i>TataUsaha</p>
                            <p><i class="far fa-check-circle text-primary me-3"></i>Ruanag Kepala Sekolah</p>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <div
                            style="background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease-in-out;">
                            <p class="d-inline-block border rounded-pill py-1 px-4">Fasilitas Sekolah</p><br>
                            <p><i class="far fa-check-circle text-primary me-3"></i>Ruang Kelas </p>
                            <p><i class="far fa-check-circle text-primary me-3"></i>Toilet Siswa</p>
                            <p><i class="far fa-check-circle text-primary me-3"></i>Toilet Guru</p>
                            <p><i class="far fa-check-circle text-primary me-3"></i>Kurikulum</p>
                            <p><i class="far fa-check-circle text-primary me-3"></i>Lapangan Olaharaga </p>
                            <p><i class="far fa-check-circle text-primary me-3"></i>Gudang</p>
                            <p><i class="far fa-check-circle text-primary me-3"></i>Ruang Guru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($fasilitas as $key => $fasilitas)
                @if ($key % 3 == 0)
        </div>
        <div class="row" style="justify-content: center; align-items:center">
            @endif
            <div class="col-md-4 my-1">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @if (isset($fasilitas->img_fasilitas))
                            <img src="{{ asset('storage/app/public/' . $fasilitas->img_fasilitas) }}"
                                class="card-img-top img-fluid" alt="Foto Fasilitas"
                                style="height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('storage/default.jpg') }}" class="card-img-top img-fluid" alt="Default Image"
                                style="height: 150px; object-fit: cover;">
                        @endif
                        <h4 class="card-title">{{ $fasilitas->nama_fasilitas }}</h4>
                        <p class="card-text">
                            <i class="fas fa-info-circle text-primary"></i>
                            Jumlah: {{ $fasilitas->jumlah }}
                        </p>
                        <p class="card-text">
                            <i class="fas fa-thermometer-half text-warning"></i>
                            Kondisi: {{ $fasilitas->kondisi }}
                        </p>
                        <p class="card-text">
                            <i class="fas fa-map-marker-alt text-success"></i>
                            Lokasi: {{ $fasilitas->lokasi }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>
@endsection
