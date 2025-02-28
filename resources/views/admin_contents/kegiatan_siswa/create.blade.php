@extends('admin_layouts.app')

@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Kegiatan</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('kegiatan-siswa.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="judul_kegiatan">Judul Kegiatan</label>
                                <input type="text" name="judul_kegiatan" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="isi_kegiatan">Deskripsi Kegiatan</label>
                                <textarea id="isi_kegiatan" name="isi_kegiatan" class="form-control" rows="4" ></textarea>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                                <input type="date" name="tanggal_kegiatan" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="waktu_kegiatan">Waktu Kegiatan</label>
                                <input type="time" name="waktu_kegiatan" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="tempat_kegiatan">Tempat Kegiatan</label>
                                <input type="text" name="tempat_kegiatan" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="foto_kegiatan">Foto Kegiatan</label>
                                <input type="file" name="foto_kegiatan" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="kategori_kegiatan">Kategori Kegiatan</label>
                                <input type="text" name="kategori_kegiatan" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
