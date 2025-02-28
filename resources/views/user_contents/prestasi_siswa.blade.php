@extends('user_layouts.app')

@section('contents')
    <section class="welcome-section row g-5"
        style="display: flex; margin: 0; padding: 10% 15% 10% 5%; background-image: url('images/bisa.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="col-lg-6 mt-0">
            <h2 style="color: white;">Selamat Datang di</h2>
            <h1 style="color: white;">Prestasi SMPN 3 Laguboti</h1>

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
                    <p>SMP Negeri 3 Laguboti telah menegaskan dirinya sebagai wadah pendidikan yang unggul, terbukti dari
                        rangkaian prestasi yang gemilang yang telah diraihnya. Prestasi ini mencakup berbagai bidang,
                        seperti akademik, olahraga, seni, dan lainnya, menandakan komitmen sekolah untuk memajukan siswa
                        dalam semua aspek kehidupan mereka. Keberhasilan ini tidak hanya mencerminkan keunggulan siswa,
                        tetapi juga kualitas pengajaran yang luar biasa yang diberikan oleh para guru. Lebih dari itu,
                        prestasi ini adalah hasil dari budaya sekolah yang mendorong prestasi tinggi dan komunitas sekolah
                        yang kuat</p>
                </div>
            </div>
        </div>
    </div>

    <main class="container" style="margin-top: 50px; padding-top: 1em; margin-bottom:10vh;">
        <div class="big-container p-5"
            style="background: #f9f9f9; border: 1px solid #ccc; border-radius: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <section class="row " style="justify-content: center">
                @foreach ($prestasi as $item)
                    <div class="col-md-6 my-3 p-2 d-flex align-items-stretch">
                        <div class="outer-wrapper w-100 d-flex flex-column"
                            style="background-color: #fff; border: 1px solid #ddd; border-radius: 20px; overflow: hidden; max-width: 1000px; max-height: 800px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                            <!-- Perbesar kotak gambar -->
                            <div class="card d-flex flex-row flex-grow-1">
                                <div class="card-body p-100 d-flex flex-column justify-content-center"
                                    style="width: 50%; background: linear-gradient(to bottom, #00C2FF, #007bff); color: white; border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
                                    <div class="card-header p-6 bg-transparent border-100">
                                        <h2 class="h4" style="color: #0500FF;">{{ ucwords($item->jenis_prestasi) }}</h2>
                                        <p class="card-text mt-auto">
                                            <small class="text-muted">
                                                Tahun: {{ $item->tahun_prestasi }}
                                            </small>
                                        </p>
                                    </div>
                                    <p class="card-text fs-6 flex-grow-1">
                                        {!! htmlspecialchars_decode($item->deskripsi_prestasi) !!}
                                    </p>
                                </div>
                                <img src="{{ isset($item->foto_prestasi) ? asset('storage/' . $item->foto_prestasi) : asset('storage/default.jpg') }}"
                                    class="card-img-left" alt="Foto Prestasi"
                                    style="width: 100%; height: auto; object-fit: cover; max-width: 300%; max-height: 100%; border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
                                <!-- Atur agar gambar memiliki ukuran maksimum yang lebih besar -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
    </main>
@endsection
