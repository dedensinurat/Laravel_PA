@extends('admin_layouts.app')

@section('title', 'Daftar Prestasi')

@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('prestasis.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                            title="Tambah Prestasi">
                            <i class="fas fa-plus"></i> Tambah Prestasi
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto Prestasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prestasis as $index => $prestasi)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <img src="{{ asset($prestasi->foto_prestasi) }}" alt="Foto Prestasi" width="100">
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm"
                                            title="Detail" data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $prestasi->id_prestasi }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('prestasis.edit', $prestasi->id_prestasi) }}"
                                            class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('prestasis.destroy', $prestasi->id_prestasi) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Modal Detail -->
                                <div class="modal fade" id="detailModal{{ $prestasi->id_prestasi }}" tabindex="-1"
                                    role="dialog" aria-labelledby="detailModalLabel{{ $prestasi->id_prestasi }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel{{ $prestasi->id_prestasi }}">
                                                    Detail Prestasi</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Jenis Prestasi:</strong> {{ $prestasi->jenis_prestasi }}</p>
                                                <p><strong>Tingkat Prestasi:</strong> {{ $prestasi->tingkat_prestasi }}</p>
                                                <p><strong>Tahun Prestasi:</strong> {{ $prestasi->tahun_prestasi }}</p>
                                                <p><strong>Deskripsi Prestasi:</strong> {!! htmlspecialchars_decode($prestasi->deskripsi_prestasi) !!}</p>
                                                <img src="{{ asset($prestasi->foto_prestasi) }}" alt="Foto Prestasi"
                                                    class="img-fluid">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('#detailModal{{ $prestasi->id_prestasi }} [data-bs-toggle="tooltip"]').tooltip();
                                    });
                                </script>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
