@extends('admin_layouts.app')

@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Pengumuman</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('pengumumans.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="judul_pengumuman">Judul Pengumuman:</label>
                                <input type="text" name="judul_pengumuman" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="isi_pengumuman">Isi Pengumuman:</label>
                                <textarea id="isi_pengumuman" name="isi_pengumuman" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pengumuman">Tanggal Pengumuman:</label>
                                <input type="date" name="tanggal_pengumuman" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="waktu_pengumuman">Waktu Pengumuman:</label>
                                <input type="time" name="waktu_pengumuman" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="penulis">Penulis:</label>
                                <input type="text" name="penulis" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="kategori_pengumuman">Kategori Pengumuman:</label>
                                <input type="text" name="kategori_pengumuman" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="file_pengumuman">File Pengumuman:</label>
                                <input type="file" name="file_pengumuman" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="img_pengumuman">Gambar Pengumuman:</label>
                                <input type="file" name="img_pengumuman" class="form-control-file">
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
