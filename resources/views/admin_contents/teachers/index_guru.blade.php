@extends('admin_layouts.app')

@section('contents')
    <div class="container">

        <h1>Data Guru</h1>
        <!-- Tambahkan form action untuk menambahkan guru baru -->
        <form action="{{ route('teachers.create') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-primary mb-3">Tambah Data Guru Baru</button>
        </form>

        @include('message')

        <div class="row">

            @foreach ($teachers as $teacher)
                <div class="col-lg-4 mb-4">
                    <div class="card border-primary">
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>
                                            <h5>NIP:</h5>
                                        </strong></td>
                                    <td>{{ $teacher->nip }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama:</strong></td>
                                    <td>{{ $teacher->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat:</strong></td>
                                    <td>{{ $teacher->alamat }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Kelamin:</strong></td>
                                    <td>{{ $teacher->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Foto Profil:</strong></td>
                                    <td>
                                        @if ($teacher->foto_profil)
                                            <img src="{{ asset($teacher->foto_profil) }}" alt="Foto Profil"
                                                class="img-fluid mb-3 img-profile">
                                        @else
                                            Tidak Ada Foto Profil
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Mata Pelajaran:</strong></td>
                                    <td>
                                        @if ($teacher->id_mata_pelajaran)
                                            @php
                                                $subject = App\Models\Course::find($teacher->id_mata_pelajaran);
                                            @endphp
                                            {{ $subject ? $subject->nama_mata_pelajaran : 'Mata Pelajaran tidak tersedia' }}
                                        @else
                                            Mata Pelajaran tidak tersedia
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <!-- Tombol Edit dan Hapus -->
                            <div class="d-flex justify-content-center mt-3">
                                <!-- Tautan edit -->
                                <!-- Button to open modal -->
                                <button type="button" class="btn btn-warning mx-2" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $teacher->id_guru }}" data-bs-tooltip="tooltip"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- Form untuk aksi hapus -->
                                <form action="{{ route('teachers.destroy', $teacher->id_guru) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn" data-bs-tooltip="tooltip"
                                        title="Hapus" data-message="Apakah Anda yakin ingin menghapus data guru ini?">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @foreach ($teachers as $teacher)
        <!-- Modal untuk setiap guru -->
        <div class="modal fade" id="editModal{{ $teacher->id_guru }}" tabindex="-1" role="dialog"
            aria-labelledby="editModalLabel{{ $teacher->id_guru }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $teacher->id_guru }}">Edit Data Guru
                            {{ $teacher->nama }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk mengedit data guru -->
                        <form id="updateForm{{ $teacher->id_guru }}"
                            action="{{ route('teachers.update', $teacher->id_guru) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @csrf
                            @method('PUT')
                            <!-- Masukkan input dengan nilai-nilai yang sesuai -->
                            <div class="mb-3">
                                <label for="nip{{ $teacher->id_guru }}" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="nip{{ $teacher->id_guru }}" name="nip"
                                    value="{{ $teacher->nip }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama{{ $teacher->id_guru }}" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama{{ $teacher->id_guru }}" name="nama"
                                    value="{{ $teacher->nama }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat{{ $teacher->id_guru }}" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat{{ $teacher->id_guru }}" name="alamat" required>{{ $teacher->alamat }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin{{ $teacher->id_guru }}" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin{{ $teacher->id_guru }}" name="jenis_kelamin"
                                    required>
                                    <option value="Laki-laki"
                                        {{ $teacher->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Perempuan"
                                        {{ $teacher->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="foto_profil{{ $teacher->id_guru }}" class="form-label">Foto Profil</label>
                                <input type="file" class="form-control" id="foto_profil{{ $teacher->id_guru }}"
                                    name="foto_profil">
                            </div>
                            <div class="mb-3">
                                <label for="id_mata_pelajaran{{ $teacher->id_guru }}" class="form-label">Mata Pelajaran
                                    yang Diampu</label>
                                <select class="form-select" id="id_mata_pelajaran{{ $teacher->id_guru }}"
                                    name="id_mata_pelajaran" required>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id_mata_pelajaran }}"
                                            {{ $teacher->id_mata_pelajaran == $course->id_mata_pelajaran ? 'selected' : '' }}>
                                            {{ $course->nama_mata_pelajaran }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Tambahkan input lainnya sesuai kebutuhan -->
                            <button type="button" class="btn btn-primary mt-2"
                                onclick="confirmUpdate('updateForm{{ $teacher->id_guru }}')">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
