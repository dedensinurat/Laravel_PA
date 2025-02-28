@extends('user_layouts.app')

@section('contents')
    <section class="welcome-section row g-5"
        style="display: flex; margin: 0; padding: 10% 15% 10% 5%; background-image: url('images/bisa.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="col-lg-6 mt-0">
            <h2 style="color: white;">Selamat Datang di</h2>
            <h1 style="color: white;">Kegiatan Siswa</h1>
        </div>
    </section>
    <div class="opacity-section"
        style="height: 50px; opacity: 2; position:relative; top:-45px; background-image: linear-gradient(to bottom, rgba(0,0,0,0), #D9E1EF,#D9E1EF,#D9E1EF);">
    </div>
    <div class="container-xxl mb-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div
                        style="background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease-in-out;">
                        <p><i class="far fa-check-circle text-primary me-3"></i>Kegiatan siswa adalah serangkaian program
                            atau acara yang dirancang khusus untuk melibatkan siswa dalam aktivitas yang melampaui lingkup
                            pembelajaran di dalam kelas. Kegiatan ini biasanya mencakup berbagai aspek, seperti pendidikan,
                            sosial, budaya, dan ekstrakurikuler, yang bertujuan untuk meningkatkan pengalaman belajar siswa
                            di luar ruang kelas.Melalui berbagai kegiatan ekstrakurikuler, siswa memiliki kesempatan untuk
                            mengeksplorasi minat mereka di luar kurikulum akademis, sehingga membantu mereka menemukan bakat
                            dan minat yang mungkin belum mereka sadari sebelumnya.</p>

                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div
                        style="background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease-in-out;">
                        <p><i class="far fa-check-circle text-primary me-3"></i>Tujuannya yaitu menegembangakan keterampilan
                            Pengembangan Keterampilan: Melalui berbagai kegiatan, siswa dapat mengembangkan keterampilan
                            akademik, sosial, keterampilan kepemimpinan, kreativitas, dan banyak lagi. Pembentukan Karakter:
                            Kegiatan siswa dapat membantu dalam membentuk karakter siswa, seperti rasa tanggung jawab,
                            disiplin, kerjasama, dan empati. Peningkatan Kepuasan Belajar: Melalui partisipasi aktif dalam
                            berbagai kegiatan, siswa dapat merasa lebih termotivasi dan bersemangat dalam belajar, yang pada
                            gilirannya dapat meningkatkan kepuasan mereka terhadap pendidikan. Penemuan Bakat dan Minat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <section id="daftar-kegiatan" class="row" style="justify-content: center">
            @foreach ($kegiatan as $item)
                <div class="col-md-6 my-3">
                    <div class="card hover-shadow">
                        <div class="row g-0">
                            <div class="col-md-6">
                                @if (isset($item->foto_kegiatan))
                                    <img src="{{ asset('storage/app/public' . $item->foto_kegiatan) }}"
                                        class="card-img-top img-fluid" alt="Foto Kegiatan">
                                @else
                                    <img src="{{ asset('storage/default.jpg') }}" class="card-img-top img-fluid"
                                        alt="Default Image">
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="card-body p-4 d-flex flex-column justify-content-center"
                                    style="background: linear-gradient(to bottom, #00C2FF, #007bff); color: white; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                    <h5 class="card-title">{{ ucwords($item->judul_kegiatan) }}</h5>
                                    <p class="card-text">{!! htmlspecialchars_decode($item->isi_kegiatan) !!}</p>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar-alt"></i> Tanggal:
                                            {{ ucwords($item->tanggal_kegiatan) }} <br>
                                            <i class="fas fa-clock"></i> Waktu: {{ ucwords($item->waktu_kegiatan) }} <br>
                                            <i class="fas fa-map-marker-alt"></i> Tempat:
                                            {{ ucwords($item->tempat_kegiatan) }} <br>
                                            <i class="fas fa-tag"></i> Kategori: {{ ucwords($item->kategori_kegiatan) }}
                                        </small>
                                    </p>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
@endsection
