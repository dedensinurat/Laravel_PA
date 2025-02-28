@extends('user_layouts.app')

@section('contents')
    <div class="banner">
        <div class="banner-top">
            <h2 class="mb-4 text-center">Sejarah Sekolah</h2>
        </div>
    </div>
    <div class="entry-content">

        <div class="container-xxl py-5" style="background-image: linear-gradient(to bottom, #f7f7f7, #e7e7e7);">
            <div class="container">
                <div class="row g-5 align-items-center">
                    @foreach ($sejarah as $item)
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <img class="img-fluid rounded w-100 bg-white pt-3 pe-3 shadow-sm" src="images/oke.png"
                                alt="" style="border-radius: 10px;">
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <p class="text-muted">{{ $item->tahun }}</p>
                            <p class="text-muted">{!! htmlspecialchars_decode($item->deskripsi) !!}</p>
                            <p class="text-muted">Sumber: {{ $item->sumber }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>

    </section>
@endsection

<style>
    .banner {
        background-image: linear-gradient(to bottom, #333, #444);
        background-size: cover;
        background-position: center;
        padding: 50px 0;
        text-align: center;
        color: #fff;
    }

    .banner h2 {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 30px;
    }

    .entry-content {
        padding: 50px 0;
    }

    .image-container {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .styled-image {
        width: 80%;
        max-width: 500px;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out;
    }

    .styled-image:hover {
        transform: scale(1.05);
    }

    .image-caption {
        text-align: center;
        text-transform: uppercase;
        font-size: 24px;
        font-weight: 700;
        margin: 10px 0 5px;
    }

    .image-subcaption {
        text-align: center;
        font-size: 20px;
        margin-bottom: 20px;
    }
</style>
