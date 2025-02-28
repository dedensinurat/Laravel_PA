@extends('admin_layouts.app')

@section('contents')
    <div class="container">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h1>Tambah Data Guru Baru</h1>
        <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="foto_profil" class="form-label">Foto Profil</label>
                <input type="file" class="form-control" id="foto_profil" name="foto_profil">
            </div>
            <div class="mb-3">
                <label for="id_mata_pelajaran" class="form-label">Mata Pelajaran yang Diampu</label>
                <select class="form-select" id="id_mata_pelajaran" name="id_mata_pelajaran" required>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id_mata_pelajaran }}">{{ $course->nama_mata_pelajaran }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tambahkan input fields untuk data lainnya sesuai kebutuhan -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Tambah Data Guru</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
