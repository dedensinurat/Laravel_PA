@extends('admin_layouts.app')

@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Prestasi</div>

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
                        <form method="POST" action="{{ route('prestasis.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="siswa_id">Siswa:</label>
                                <select name="siswa_id" id="siswa_id" class="form-control" required>
                                    <option value="">Pilih Siswa</option>
                                    @foreach ($siswas as $namaKelas => $siswaGroup)
                                        <optgroup label="Kelas {{ $namaKelas }}">
                                            @foreach ($siswaGroup as $siswa)
                                                <option value="{{ $siswa->id_siswa }}">{{ $siswa->nama_lengkap }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jenis_prestasi">Jenis Prestasi:</label>
                                <input type="text" name="jenis_prestasi" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="tingkat_prestasi">Tingkat Prestasi:</label>
                                <input type="number" name="tingkat_prestasi" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="tahun_prestasi">Tahun Prestasi:</label>
                                <input type="number" name="tahun_prestasi" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi_prestasi">Deskripsi Prestasi:</label>
                                <textarea id="deskripsi_prestasi" name="deskripsi_prestasi" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="foto_prestasi">Foto Prestasi:</label>
                                <input type="file" name="foto_prestasi" class="form-control-file">
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
