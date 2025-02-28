@extends('admin_layouts.app')

@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Kelas Baru</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('classes.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nama_kelas" class="col-md-4 col-form-label text-md-right">Nama Kelas</label>

                            <div class="col-md-6">
                                <input id="nama_kelas" type="text" class="form-control @error('nama_kelas') is-invalid @enderror" name="nama_kelas" value="{{ old('nama_kelas') }}" required autofocus>

                                @error('nama_kelas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tingkat_kelas" class="col-md-4 col-form-label text-md-right">Tingkat Kelas</label>

                            <div class="col-md-6">
                                <input id="tingkat_kelas" type="number" class="form-control @error('tingkat_kelas') is-invalid @enderror" name="tingkat_kelas" value="{{ old('tingkat_kelas') }}" required>

                                @error('tingkat_kelas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tahun_ajaran" class="col-md-4 col-form-label text-md-right">Tahun Ajaran</label>

                            <div class="col-md-6">
                                <input id="tahun_ajaran" type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" required>

                                @error('tahun_ajaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
