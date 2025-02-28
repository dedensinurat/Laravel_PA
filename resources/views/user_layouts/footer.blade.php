<footer class="bg-info-subtle py-4 text-white">
    <div class="container">
        <div class="row">
            <!-- Maps Kecil -->
            <div class="col-md-6 mb-2">
                <!-- Google Maps Embed -->
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15945.478436748603!2d99.1468343!3d2.3824334!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e01d375d85117%3A0x8415c7a6c00810f4!2sSMP%20Negeri%203%20Laguboti!5e0!3m2!1sid!2sid!4v1712986273655!5m2!1sid!2sid"
                    width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <!-- Info Kontak -->
            <div class="col-md-6">
                <h5 class="text-black">Kontak {{ App\Models\ProfilSekolah::first()->nama_sekolah }}</h5>
                <p>{{ App\Models\ProfilSekolah::first()->alamat_sekolah }}</p>                
                <p><i class="fas fa-envelope"></i> {{ App\Models\ProfilSekolah::first()->email_sekolah }}</p>
                <p>
                    <a href="#" style="color: white;"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: white;"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: white;"><i class="fab fa-instagram"></i></a>
                </p>
            </div>

        </div>
        <!-- Copyright -->
    </div>
</footer>
<div class="copyright py-4 bg-primary-cus">
    <div class="container ">
        <div class="col text-center">
            <p class="m-0 text-white">&copy; 2024 SMPN 3 Laguboti.</p>
        </div>
    </div>
</div>
