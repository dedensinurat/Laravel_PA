@extends('admin_layouts.app')

@section('contents')
    <div class="container">

        <h1>Data Kelas</h1>
        <div class="col-md-12 text-right">
            <div class="mb-4">
                <a href="{{ route('classes.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Kelas</a>
            </div>
        </div>
        <div class="row">
            @foreach ($classes->groupBy('tingkat_kelas') as $tingkat => $groupedClasses)
                <div class="col-md-6 mb-4"> <!-- Tambahkan kelas mb-4 untuk memberikan jarak antar kolom -->
                    <div class="card">
                        <div class="card-header">Tingkat Kelas {{ $tingkat }}</div>

                        <div class="card-body">
                            @if ($groupedClasses->count() > 0)
                                <div class="table-responsive">
                                    <!-- Tambahkan kelas table-responsive untuk membuat tabel responsive -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama Kelas</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($groupedClasses as $class)
                                                <tr>
                                                    <td>{{ $class->nama_kelas }}</td>
                                                    <td>{{ $class->tahun_ajaran }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <!-- Detail button -->
                                                            <button type="button" class="btn btn-primary me-2"
                                                                data-toggle="modal"
                                                                data-target="#detailModal{{ $class->id_kelas }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Detail">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <!-- Edit button -->
                                                            <button type="button" class="btn btn-warning me-2"
                                                                data-toggle="modal"
                                                                data-target="#editModal{{ $class->id_kelas }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <!-- Delete form -->
                                                            <form action="{{ route('classes.destroy', $class->id_kelas) }}"
                                                                method="POST" class="delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"
                                                                    data-message="Apakah Anda yakin ingin menghapus kelas ini?"
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
                            @else
                                <p>Tidak ada kelas untuk tingkat ini.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal Detail -->
        @foreach ($classes as $class)
            <div class="modal fade" id="detailModal{{ $class->id_kelas }}" tabindex="-1" role="dialog"
                aria-labelledby="detailModalLabel{{ $class->id_kelas }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel{{ $class->id_kelas }}">Detail Kelas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Nama Kelas</th>
                                        <td>{{ $class->nama_kelas }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tingkat Kelas</th>
                                        <td>{{ $class->tingkat_kelas }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tahun Ajaran</th>
                                        <td>{{ $class->tahun_ajaran }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Dibuat pada</th>
                                        <td>{{ $class->created_at->format('d M Y H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Diperbarui pada</th>
                                        <td>{{ $class->updated_at->format('d M Y H:i:s') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Modal Edit -->
        @foreach ($classes as $class)
            <div class="modal fade" id="editModal{{ $class->id_kelas }}" tabindex="-1" role="dialog"
                aria-labelledby="editModalLabel{{ $class->id_kelas }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $class->id_kelas }}">Edit
                                Kelas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form edit kelas -->
                            <form id="updateForm{{ $class->id_kelas }}"
                                action="{{ route('classes.update', $class->id_kelas) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nama_kelas">Nama Kelas:</label>
                                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas"
                                        value="{{ $class->nama_kelas }}">
                                </div>
                                <div class="form-group">
                                    <label for="tahun_ajaran">Tahun Ajaran:</label>
                                    <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran"
                                        value="{{ $class->tahun_ajaran }}">
                                </div>
                                <!-- Tambahkan input fields untuk mengedit informasi kelas lainnya -->
                                <!-- Pastikan untuk menyesuaikan dengan atribut kelas yang ingin diedit -->
                                <button type="button" class="btn btn-primary"
                                    onclick="confirmUpdate('updateForm{{ $class->id_kelas }}')">Simpan
                                    Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
