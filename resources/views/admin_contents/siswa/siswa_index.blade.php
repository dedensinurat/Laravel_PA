@extends('admin_layouts.app')
@section('title', 'Daftar Siswa')
@section('contents')
    <div class="container">
        <!-- Tambahkan tombol tambah -->
        <div class="mb-4">
            <a href="{{ route('students.create') }}" class="btn btn-primary">Tambah Siswa</a>
            <form action="{{ route('students.uploadCsv') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="csv_file">Upload File CSV untuk mempersingkat pengisian data:</label>
                            <small class="form-text text-muted">Format CSV harus mengikuti struktur berikut:<br>
                                <strong>Nama Lengkap, NISN, Jenis Kelamin, Kelas</strong><br>
                                Contoh:
                                <br>
                                <em>nama_lengkap,nisn,jenis_kelamin,kelas</em>
                                <br>
                                <em>John Doe,1234567890,Laki-Laki,X-A</em>
                            </small>
                            <input type="file" class="form-control-file @error('csv_file') is-invalid @enderror"
                                id="csv_file" name="csv_file">
                            @error('csv_file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            @foreach ($students->sortBy('class.nama_kelas')->groupBy('class.nama_kelas') as $kelas => $siswas)
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="mb-0">{{ $kelas }}</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="siswaTable{{ $kelas }}">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Lengkap</th>
                                            <th scope="col">NISN</th>
                                            <th scope="col">Jenis Kelamin</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswas->sortBy('nama_lengkap') as $index => $siswa)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $siswa->nama_lengkap }}</td>
                                                <td>{{ $siswa->nisn }}</td>
                                                <td>{{ $siswa->jenis_kelamin }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <!-- Detail Button with Tooltip -->
                                                        <button type="button" class="btn btn-primary mx-1"
                                                            data-toggle="modal"
                                                            data-target="#detailModal{{ $siswa->id_siswa }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <!-- Edit Button with Tooltip -->
                                                        <button type="button" class="btn btn-warning mx-1"
                                                            data-toggle="modal"
                                                            data-target="#editModal{{ $siswa->id_siswa }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <!-- Delete Button with Tooltip -->
                                                        <form action="{{ route('students.destroy', $siswa->id_siswa) }}"
                                                            method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger delete-btn"
                                                                data-message="Apakah Anda yakin ingin menghapus siswa ini?"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Hapus">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Modal Detail -->
                @foreach ($siswas as $siswa)
                    <div class="modal fade" id="detailModal{{ $siswa->id_siswa }}" tabindex="-1" role="dialog"
                        aria-labelledby="detailModalLabel{{ $siswa->id_siswa }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $siswa->id_siswa }}">Detail Siswa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Isi Detail Siswa -->
                                    <table class="table">
                                        <tr>
                                            <td><strong>Nama Lengkap:</strong></td>
                                            <td>{{ $siswa->nama_lengkap }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>NISN:</strong></td>
                                            <td>{{ $siswa->nisn }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Kelamin:</strong></td>
                                            <td>{{ $siswa->jenis_kelamin }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kelas:</strong></td>
                                            <td>{{ $siswa->kelas_id }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>ID User:</strong></td>
                                            <td>{{ $siswa->id_user }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Modal Edit -->
                @foreach ($siswas as $siswa)
                    <div class="modal fade" id="editModal{{ $siswa->id_siswa }}" tabindex="-1" role="dialog"
                        aria-labelledby="editModalLabel{{ $siswa->id_siswa }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $siswa->id_siswa }}">Edit Siswa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Edit Siswa -->
                                    <form id="updateForm{{ $siswa->id_siswa }}"
                                        action="{{ route('students.update', $siswa->id_siswa) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap:</label>
                                            <input type="text" class="form-control" id="nama_lengkap"
                                                name="nama_lengkap" value="{{ $siswa->nama_lengkap }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nisn">NISN:</label>
                                            <input type="text" class="form-control" id="nisn" name="nisn"
                                                value="{{ $siswa->nisn }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                                <option value="Laki-laki"
                                                    {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                                </option>
                                                <option value="Perempuan"
                                                    {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-primary"
                                            onclick="confirmUpdate('updateForm{{ $siswa->id_siswa }}')">Simpan
                                            Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Loop through each table dynamically
            $('[id^="siswaTable"]').each(function() {
                var tableId = $(this).attr('id');
                $(this).DataTable({
                    "order": [
                        [0, "asc"]
                    ],
                    "initComplete": function() {
                        var api = this.api();
                        api.buttons().container().appendTo($('#' + tableId +
                            '_wrapper .col-md-6:eq(0)'));
                    }
                });
            });
        });
    </script>
@endsection
