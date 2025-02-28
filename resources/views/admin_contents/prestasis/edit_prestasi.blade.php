@extends('admin_layouts.app')

@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Prestasi</div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('prestasis.update', $prestasi->id_prestasi) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="siswa_id">ID Siswa:</label>
                            <input type="number" name="siswa_id" class="form-control" value="{{ $prestasi->siswa_id }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="jenis_prestasi">Jenis Prestasi</label>
                            <input type="text" class="form-control" id="jenis_prestasi" name="jenis_prestasi" value="{{ $prestasi->jenis_prestasi }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="tingkat_prestasi">Tingkat Prestasi</label>
                            <input type="text" class="form-control" id="tingkat_prestasi" name="tingkat_prestasi" value="{{ $prestasi->tingkat_prestasi }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="tahun_prestasi">Tahun Prestasi</label>
                            <input type="number" class="form-control" id="tahun_prestasi" name="tahun_prestasi" value="{{ $prestasi->tahun_prestasi }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="deskripsi_prestasi">Deskripsi Prestasi</label>
                            <textarea class="form-control" class="form-control" id="deskripsi_prestasi" name="deskripsi_prestasi" rows="5" required>{{ $prestasi->deskripsi_prestasi }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="foto_prestasi">Foto Prestasi</label>
                            <input type="file" class="form-control-file" id="foto_prestasi" name="foto_prestasi">
                            @if ($prestasi->foto_prestasi)
                                <img src="{{ asset('storage/' . $prestasi->foto_prestasi) }}" alt="Foto Prestasi" width="100">
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="id_user">ID User:</label>
                            <input type="number" name="id_user" class="form-control" value="{{ $prestasi->id_user }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Prestasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
