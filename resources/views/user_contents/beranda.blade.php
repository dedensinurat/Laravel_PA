@extends('user_layouts.app')

@section('contents')
    <title>SMP</title>
    <section class="welcome-section row g-5"
        style="display: flex; margin: 0; padding: 170px 10% 150px 10%; background-image: url('public/images/bisa.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="col-lg-6 mt-0">
            <h2 style="color: white;">Selamat Datang di</h2>
            <h1 style="color: white;">SMPN 3 LAGUBOTI</h1>
            <h2 style="color: white;">Sumatra Utara</h2>
            <button
                style="background-color: transparent; padding: 10px 20px; font-size: 16px; cursor: pointer; transition: background-color 0.1s ease; border-radius: 50px; margin-top: 30px; color: white; border: 1px solid white;">
                <a style="color: white; text-decoration: none;" href="#sejarah">Pelajari Lebih Lanjut <i
                        class="bi bi-arrow-right-circle"></i></a>
            </button>
        </div>
    </section>
    <div class="opacity-section"
        style="height: 50px; opacity: 2; position:relative; top:-45px; background-image: linear-gradient(to bottom, rgba(0,0,0,0), #D9E1EF,#D9E1EF,#D9E1EF);">
    </div>
    <div class="container-xxl pb-5">
        <div class="container" id="sejarah">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <img class="img-fluid rounded w-100 bg-white pt-3 pe-3" src="public/images/oke.png" alt="">
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h2 class="mb-4">Sejarah Sekolah</h2>
                    @foreach ($sejarah as $item)
                        <p class="">{!! htmlspecialchars_decode($item->deskripsi) !!}</p>
                    @endforeach
                    <p><i class="far fa-check-circle text-primary me-3"></i>Kurikulum</p>
                    <p><i class="far fa-check-circle text-primary me-3"></i>Fasilitas</p>
                    <p><i class="far fa-check-circle text-primary me-3"></i>Pengajaran oleh Guru Berpengalaman:</p>
                </div>
            </div>
        </div>
    </div>


    <section class="statistics-section mb-5" style="background-color: #1D24CA; text-align:center; padding: 5px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div style="color: white;">
                        <div>
                            <h1 style="color: white; font-size: 80px;">6</h1>
                            <h6 style="color: white; ">Kelas Aktif</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="color: white;">
                        <div>
                            <h1 style="color: white; font-size: 80px;">12+</h1>
                            <h6 style="color: white;">Guru Pengajar</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="color: white;">
                        <div>
                            <h1 style="color: white; font-size: 80px;">100+</h1>
                            <h6 style="color: white;">Alumni Sekolah</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <h1>
        <center><b>Kata sambutan Kepala sekolah</b></center>
    </h1>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card bg-light text-dark border-0" style="border-radius: 50px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                <!-- Gambar disini -->
                                <div class="img-wrapper">
                                    <img src="/public/images/keplasekolah.jpg" class="img-fluid rounded-circle"
                                        style="width: 300px; height: 300px;" alt="...">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <!-- Keterangan disini -->
                                <h6 class="card-text" style="margin-top: 20px; text-align: justify;">
                                    
                                        {!! htmlspecialchars_decode($profilSekolah->sambutan_kepsek) !!}
                                    
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1>Fasilitas</h1>
            </div>

            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="row" style="justify-content: center">
                    @foreach ($fasilitas as $fasilitases)
                        <div class="col-md-6">
                            <div class="testimonial-item text-center">
                                <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4"
                                    src="{{ url('public/' . $fasilitases->img_fasilitas) }}"
                                    style="width: 200px; height: 200px;">
                                <div class="testimonial-text rounded text-center p-4">
                                    <p>{{ $fasilitases->kondisi }}</p>
                                    <h5 class="mb-1">{{ $fasilitases->nama_fasilitas }}</h5>
                                    <span class="fst-italic">{{ $fasilitases->lokasi }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="container-xxl py-5" style="background-image: linear-gradient(to bottom, #f7f7f7, #e7e7e7);">
                <div class="container">
                    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                        <h1 class="display-4 fw-bold">Ekstrakurikuler</h1>
                    </div>
                    <div class="row g-4" style="justify-content:space-evenly;">
                        @foreach ($kegiatanSiswa as $kegiatan)
                            @if ($loop->last)
                                <div class="col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                                @else
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            @endif
                            <div class="service-item bg-white rounded h-100 p-5 shadow-sm">
                                <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
                                    style="width: 65px; height: 65px; border: 1px solid #ddd;">
                                    @if ($kegiatan->foto_kegiatan)
                                        <img src="{{ asset('public/' . $kegiatan->foto_kegiatan) }}" alt="Guru Logo"
                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                    @else
                                        <img src="{{ asset('images/default-avatar.png') }}" alt="Guru Logo"
                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                    @endif
                                </div>
                                <h4 class="mb-3">{{ ucwords($kegiatan->judul_kegiatan) }}</h4>
                                <p class="mb-4 text-muted">{!! htmlspecialchars_decode($kegiatan->isi_kegiatan) !!}</p>
                                <center><i class="far fa-check-circle text-primary me-3"></i></center>
                            </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Feature End -->
@endsection
