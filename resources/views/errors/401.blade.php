@extends('errors.custom_baru')

@section('contents')
<div class="stars">
    <div class="custom-navbar">
        <div class="navbar-links">
            <ul>
                <li><a href="#" target="_blank">Home</a></li>
                <li><a href="#" target="_blank">About</a></li>
                <li><a href="#" target="_blank">Features</a></li>
                <li><a href="#" class="btn-request" target="_blank">Request A Demo</a></li>
            </ul>
        </div>
    </div>
    <div class="central-body">
        <img class="image-404" src="http://salehriaz.com/404Page/img/404.svg" width="300px">
        <p class="error_text">Unauthorized - Websolutionstuff</p>
        <!-- Tambahkan rute yang sesuai di sini -->
        <a href="{{ route('beranda') }}" class="btn-go-home" target="_blank">GO BACK HOME</a>
    </div>
    <div class="objects">
        <img class="object_rocket" src="http://salehriaz.com/404Page/img/rocket.svg" width="40px">
        <div class="earth-moon">
            <img class="object_earth" src="http://salehriaz.com/404Page/img/earth.svg" width="100px">
            <img class="object_moon" src="http://salehriaz.com/404Page/img/moon.svg" width="80px">
        </div>
        <div class="box_astronaut">
            <img class="object_astronaut" src="http://salehriaz.com/404Page/img/astronaut.svg" width="140px">
        </div>
    </div>
    <div class="glowing_stars">
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
    </div>
</div>
@endsection
