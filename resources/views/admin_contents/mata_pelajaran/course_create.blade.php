@extends('admin_layouts.app')

@section('contents')
    <div class="container">
        <h1>Tambah Mata Pelajaran</h1>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('course.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_mata_pelajaran" class="form-label">Nama Mata Pelajaran</label>
                                <input type="text" class="form-control" id="nama_mata_pelajaran" name="nama_mata_pelajaran" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi_mata_pelajaran" class="form-label">Deskripsi Mata Pelajaran</label>
                                <textarea class="form-control" id="deskripsi_mata_pelajaran" name="deskripsi_mata_pelajaran" required></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
