@extends('admin_layouts.app')

@section('contents')
    <div class="container">
        <h1>Tambah Siswa</h1>

        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap:</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
            </div>
            <div class="mb-3">
                <label for="nisn" class="form-label">NISN:</label>
                <input type="text" class="form-control" id="nisn" name="nisn" required>
            </div>
            {{-- <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
            </div> --}}
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin:</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            {{-- <div class="mb-3">
                <label for="alamat" class="form-label">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">No. Telepon:</label>
                <input type="text" class="form-control" id="no_telepon" name="no_telepon" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div> --}}
            <div class="mb-3">
                <label for="kelas_id" class="form-label">Kelas:</label>
                <select class="form-control" id="kelas_id" name="kelas_id" required>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id_kelas }}">
                            <!-- Menampilkan tingkat kelas dan nama kelas -->
                            Tingkat {{ $class->tingkat_kelas }} - {{ $class->nama_kelas }}
                        </option>
                    @endforeach
                </select>
                <!-- Penjelasan dengan contoh dari database: -->
                <small class="form-text text-muted">
                    Pilih tingkat kelas dan nama kelas yang sesuai.
                    @if(isset($classes[0]))
                        Contoh: "Tingkat {{ $classes[0]->tingkat_kelas }} - {{ $classes[0]->nama_kelas }}"
                    @endif
                    @if(isset($classes[1]))
                        atau "Tingkat {{ $classes[1]->tingkat_kelas }} - {{ $classes[1]->nama_kelas }}"
                    @endif
                    @if(empty($classes))
                        Tidak ada kelas tersedia.
                    @endif
                </small>
                
            </div>
            
            {{-- <div class="mb-3">
                <label for="agama" class="form-label">Agama:</label>
                <input type="text" class="form-control" id="agama" name="agama" required>
            </div> --}}
            <button type="submit" class="btn btn-primary my-4">Simpan</button>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
@endsection
