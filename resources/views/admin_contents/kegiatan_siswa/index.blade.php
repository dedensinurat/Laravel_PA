@extends('admin_layouts.app')
@section('title', 'Daftar Kegiatan Siswa')
@section('contents')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-md-12 text-right">
                <a href="{{ route('kegiatan-siswa.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                    title="Tambah Kegiatan">
                    <i class="fas fa-plus"></i> Tambah Kegiatan
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatan_siswa as $index => $kegiatan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kegiatan->judul_kegiatan }}</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $kegiatan->id_kegiatan }}" data-bs-toggle="tooltip"
                                    title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('kegiatan-siswa.edit', $kegiatan->id_kegiatan) }}"
                                    class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('kegiatan-siswa.destroy', $kegiatan->id_kegiatan) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                        title="Hapus"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Detail Modal -->
                        <div class="modal fade" id="detailModal{{ $kegiatan->id_kegiatan }}" tabindex="-1"
                            aria-labelledby="detailModalLabel{{ $kegiatan->id_kegiatan }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel{{ $kegiatan->id_kegiatan }}">Detail
                                            Kegiatan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Judul Kegiatan:</strong> {{ $kegiatan->judul_kegiatan }}</p>
                                        <p><strong>Tanggal:</strong> {{ $kegiatan->tanggal_kegiatan }}</p>
                                        <p><strong>Waktu:</strong> {{ $kegiatan->waktu_kegiatan }}</p>
                                        <p><strong>Tempat:</strong> {{ $kegiatan->tempat_kegiatan }}</p>
                                        @if ($kegiatan->foto_kegiatan)
                                            <p><strong>Foto Kegiatan:</strong><br><img
                                                    src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}"
                                                    alt="Foto Kegiatan" style="max-width: 100px; height: auto;"></p>
                                        @endif
                                        <p><strong>Deskripsi:</strong> {!! htmlspecialchars_decode($kegiatan->isi_kegiatan) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Detail Modal -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Activate tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endsection
