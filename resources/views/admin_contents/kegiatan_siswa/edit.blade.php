@extends('admin_layouts.app')

@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Kegiatan</div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('kegiatan-siswa.update', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="judul_kegiatan">Judul Kegiatan</label>
                            <input type="text" name="judul_kegiatan" class="form-control" value="{{ $kegiatan->judul_kegiatan }}" required>
                        </div>

                        <div class="form-group">
                            <label for="isi_kegiatan">Deskripsi Kegiatan</label>
                            <textarea id="isi_kegiatan" name="isi_kegiatan" class="form-control" rows="4" required>{{ $kegiatan->isi_kegiatan }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal_kegiatan" class="form-control" value="{{ $kegiatan->tanggal_kegiatan }}" required>
                        </div>

                        <div class="form-group">
                            <label for="waktu_kegiatan">Waktu Kegiatan</label>
                            <input type="time" name="waktu_kegiatan" class="form-control" value="{{ $kegiatan->waktu_kegiatan }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tempat_kegiatan">Tempat Kegiatan</label>
                            <input type="text" name="tempat_kegiatan" class="form-control" value="{{ $kegiatan->tempat_kegiatan }}" required>
                        </div>

                        <div class="form-group">
                            <label for="foto_kegiatan">Foto Kegiatan</label>
                            <input type="file" name="foto_kegiatan" class="form-control-file">
                            @if ($kegiatan->foto_kegiatan)
                                <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}" alt="Foto Kegiatan" width="100">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="kategori_kegiatan">Kategori Kegiatan</label>
                            <input type="text" name="kategori_kegiatan" class="form-control" value="{{ $kegiatan->kategori_kegiatan }}" required>
                        </div>

                        <div class="form-group">
                            <label for="id_user">ID User</label>
                            <input type="number" name="id_user" class="form-control" value="{{ $kegiatan->id_user }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Kegiatan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
