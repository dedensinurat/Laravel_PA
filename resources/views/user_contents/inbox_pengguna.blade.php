@extends('user_layouts.app')

@section('contents')
    <div class="wrapper"
        style="background-image: url('{{ asset('public/images/bisa.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed; padding: 25px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="bg-white p-4 rounded-5 shadow-sm">
                        <h2 class="mb-4 text-center" style="color: #333;">Umpan Balik</h2>
                        <form action="{{ route('inbox.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nama_pengunjung" class="form-label" style="color: #333;">Nama:</label>
                                <input type="text" class="form-control" id="nama_pengunjung" name="nama_pengunjung"
                                    placeholder="Masukkan nama anda" style="border-color: #ced4da;" required>                                
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label" style="color: #333;">Email:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan email anda" style="border-color: #ced4da;" required>
                                <small id="emailHelpBlock" class="form-text text-muted">
                                    Contoh: email@example.com
                                </small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="subjek" class="form-label" style="color: #333;">Subjek:</label>
                                <input type="text" class="form-control" id="subjek" name="subjek"
                                    placeholder="Masukkan subjek pesan" style="border-color: #ced4da;" required>
                                <small id="subjekHelpBlock" class="form-text text-muted">                                     
                                    Contoh: Pertanyaan tentang kurikulum
                                </small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="isi_pesan" class="form-label" style="color: #333;">Isi Pesan:</label>
                                <textarea class="form-control" id="isi_pesan" name="isi_pesan" rows="5"
                                    placeholder="Masukkan isi pesan anda" style="border-color: #ced4da;" required></textarea>
                                <small id="isiPesanHelpBlock" class="form-text text-muted">                                     
                                    Contoh: Saya ingin mengetahui lebih lanjut tentang kurikulum yang diterapkan di sekolah
                                    ini.
                                </small>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block"
                                style="background-color: #007bff; border-color: #007bff;">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
