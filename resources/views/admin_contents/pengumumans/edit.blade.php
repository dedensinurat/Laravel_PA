@extends('admin_layouts.app')

@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Pengumuman</div>

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

                        <form action="{{ route('pengumumans.update', $pengumuman->id_pengumuman) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="judul_pengumuman">Judul Pengumuman:</label>
                                <input type="text" name="judul_pengumuman" class="form-control"
                                    value="{{ $pengumuman->judul_pengumuman }}" required>
                            </div>

                            <div class="form-group">
                                <label for="isi_pengumuman">Isi Pengumuman:</label>
                                <textarea id="isi_pengumuman" name="isi_pengumuman" class="form-control" rows="4" required>{{ $pengumuman->isi_pengumuman }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pengumuman">Tanggal Pengumuman:</label>
                                <input type="date" name="tanggal_pengumuman" class="form-control"
                                    value="{{ $pengumuman->tanggal_pengumuman }}" required>
                            </div>

                            <div class="form-group">
                                <label for="waktu_pengumuman">Waktu Pengumuman:</label>
                                <input type="time" name="waktu_pengumuman" class="form-control"
                                    value="{{ $pengumuman->waktu_pengumuman }}">
                            </div>

                            <div class="form-group">
                                <label for="penulis">Penulis:</label>
                                <input type="text" name="penulis" class="form-control" value="{{ $pengumuman->penulis }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="kategori_pengumuman">Kategori Pengumuman:</label>
                                <input type="text" name="kategori_pengumuman" class="form-control"
                                    value="{{ $pengumuman->kategori_pengumuman }}" required>
                            </div>

                            <div class="form-group">
                                <label for="file_pengumuman">File Pengumuman:</label>
                                <input type="file" name="file_pengumuman" class="form-control-file">
                                @if ($pengumuman->file_pengumuman)
                                    <a href="{{ asset('storage/' . $pengumuman->file_pengumuman) }}" target="_blank">Lihat
                                        File</a>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="img_pengumuman">Gambar Pengumuman:</label>
                                <input type="file" name="img_pengumuman" class="form-control-file">
                                @if ($pengumuman->img_pengumuman)
                                    <img src="{{ asset('storage/' . $pengumuman->img_pengumuman) }}"
                                        alt="Gambar Pengumuman" style="width: 100px; height: auto;">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="id_user">ID User:</label>
                                <input type="number" name="id_user" class="form-control"
                                    value="{{ $pengumuman->id_user }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Pengumuman</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
