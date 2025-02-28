@extends('user_layouts.app')

@section('contents')
    <section class="welcome-section row g-5"
        style="display: flex; margin: 0; padding: 10% 15% 10% 5%; background-image: url('images/bisa.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="col-lg-6 mt-0">
            <h2 style="color: white;">Selamat Datang di</h2>
            <h1 style="color: white;">Pengumuman SMPN 3 Laguboti</h1>
        </div>
    </section>
    <div class="opacity-section"
        style="height: 50px; opacity: 2; position:relative; top:-45px; background-image: linear-gradient(to bottom, rgba(0,0,0,0), #D9E1EF,#D9E1EF,#D9E1EF);">
    </div>
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 wow fadeIn" data-wow-delay="0.5s">
                <div
                    style="background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease-in-out; text-align: center;">
                    <p>Ini merupakan pemberitahuan resmi atau komunikasi yang disampaikan kami pihak sekolah kepada publik
                        atau pihak yang berkepentingan mengenai informasi, peristiwa, atau keputusan penting.
                        Pengumuman dapat dilakukan melalui berbagai media, seperti surat, papan pengumuman, email, situs
                        web, media sosial, atau pertemuan langsung. Kami memilih untuk mengumumkan melalui situs web ini.
                        Tujuan dari pengumuman adalah untuk menyampaikan informasi secara jelas dan transparan kepada
                        orang-orang yang terkait agar mereka dapat memperoleh pemahaman yang benar dan bertindak sesuai
                        dengan informasi yang diberikan.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <section class="row mb-5" style="justify-content: center">
            @foreach ($Pengumuman as $index => $item)
                <div class="col-md-6 my-4 p-2 {{ $index % 2 == 0 ? 'order-md-1' : 'order-md-2' }}">
                    <div class="card flex-row h-100"
                        style="border-radius: 10px; overflow: hidden; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                        @if (isset($item->foto_pengumuman))
                            <img src="{{ asset('storage/' . $item->foto_pengumuman) }}" class="card-img-left"
                                alt="Foto Pengumuman"
                                style="width: 40%; height: auto; object-fit: cover; border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                        @else
                            <img src="{{ asset('storage/default.jpg') }}" class="card-img-left" alt="Default Image"
                                style="width: 40%; height: auto; object-fit: cover; border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                        @endif
                        <div class="card-body p-4 d-flex flex-column justify-content-center"
                            style="background: linear-gradient(to bottom, #00C2FF, #007bff); color: white; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                            <div class="card-header p-2 bg-transparent border-0">
                                <h2 class="h4" style="color: #0500FF;">{{ ucwords($item->judul_pengumuman) }}</h2>
                            </div>
                            <p class="card-text fs-3 flex-grow-1">{!! htmlspecialchars_decode($item->isi_pengumuman) !!}</p>
                            <p class="card-text mt-auto">
                                <small class="text-muted">
                                    Tanggal: {{ ucwords($item->tanggal_pengumuman) }} <br>
                                    Waktu: {{ ucwords($item->waktu_pengumuman) }} <br>
                                    Tempat: {{ ucwords($item->tempat_pengumuman) }}
                                </small>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">Kategori: {{ ucwords($item->kategori_pengumuman) }}</small>
                            </p>                            
                        </div>
                    </div>
                </div>
                @if (($index + 1) % 2 == 0)
                    <div class="w-100 d-md-none"></div> <!-- Add a new row for smaller screens -->
                @endif
            @endforeach
        </section>
    </div>
@endsection
