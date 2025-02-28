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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-4">Edit Profil Sekolah</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.update_profil_sekolah', $profilSekolah->id_profil) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                                <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah"
                                    value="{{ $profilSekolah->nama_sekolah }}" required autocomplete="nama_sekolah" autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="alamat_sekolah" class="form-label">Alamat Sekolah</label>
                                <input type="text" class="form-control" id="alamat_sekolah" name="alamat_sekolah"
                                    value="{{ $profilSekolah->alamat_sekolah }}" required autocomplete="alamat_sekolah">
                            </div>

                            <div class="mb-3">
                                <label for="no_telepon_sekolah" class="form-label">No. Telepon Sekolah</label>
                                <input type="text" class="form-control" id="no_telepon_sekolah" name="no_telepon_sekolah"
                                    value="{{ $profilSekolah->no_telepon_sekolah }}" required autocomplete="no_telepon_sekolah">
                            </div>

                            <div class="mb-3">
                                <label for="email_sekolah" class="form-label">Email Sekolah</label>
                                <input type="email" class="form-control" id="email_sekolah" name="email_sekolah"
                                    value="{{ $profilSekolah->email_sekolah }}" required autocomplete="email_sekolah">
                            </div>

                            <div class="mb-3">
                                <label for="logo_sekolah" class="form-label">Logo Sekolah</label>
                                <input type="file" class="form-control" id="logo_sekolah" name="logo_sekolah">
                            </div>

                            <div class="mb-3">
                                <label for="visi_sekolah" class="form-label">Visi Sekolah</label>
                                <textarea class="form-control" id="visi_sekolah" name="visi_sekolah" rows="3">{{ $profilSekolah->visi_sekolah }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="misi_sekolah" class="form-label">Misi Sekolah</label>
                                <textarea class="form-control" id="misi_sekolah" name="misi_sekolah" rows="3">{{ $profilSekolah->misi_sekolah }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="sambutan_kepsek" class="form-label">Sambutan Kepsek</label>
                                <textarea class="form-control" id="sambutan_kepsek" name="sambutan_kepsek" rows="3">{{ $profilSekolah->sambutan_kepsek }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
