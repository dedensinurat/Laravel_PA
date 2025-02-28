@extends('admin_layouts.app')
@section('title', 'Daftar Pengumuman')
@section('contents')
    <div class="container-fluid">
        <div class="row justify-content-end mb-3">
            <div class="col-md-6 text-right">
                <a href="{{ route('pengumumans.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                    title="Tambah Pengumuman">
                    <i class="fas fa-plus"></i> Tambah Pengumuman
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Pengumuman</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengumumans as $index => $pengumuman)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pengumuman->judul_pengumuman }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $pengumuman->id_pengumuman }}"
                                            data-bs-toggle="tooltip" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('pengumumans.edit', $pengumuman->id_pengumuman) }}"
                                            class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pengumumans.destroy', $pengumuman->id_pengumuman) }}"
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

                                <!-- Detail Modal -->
                                <div class="modal fade" id="detailModal{{ $pengumuman->id_pengumuman }}" tabindex="-1"
                                    aria-labelledby="detailModalLabel{{ $pengumuman->id_pengumuman }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="detailModalLabel{{ $pengumuman->id_pengumuman }}">Detail Pengumuman
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Judul Pengumuman:</strong> {{ $pengumuman->judul_pengumuman }}
                                                </p>
                                                <p><strong>Isi Pengumuman:</strong>
                                                    {!! htmlspecialchars_decode($pengumuman->isi_pengumuman) !!}</p>
                                                <p><strong>Tanggal Pengumuman:</strong>
                                                    {{ $pengumuman->tanggal_pengumuman }}</p>
                                                <p><strong>Waktu Pengumuman:</strong> {{ $pengumuman->waktu_pengumuman }}
                                                </p>
                                                <p><strong>Penulis:</strong> {{ $pengumuman->penulis }}</p>
                                                <p><strong>Kategori Pengumuman:</strong>
                                                    {{ $pengumuman->kategori_pengumuman }}</p>
                                                @if ($pengumuman->img_pengumuman)
                                                    <p><strong>Gambar Pengumuman:</strong><br><img
                                                            src="{{ url('public/' . $pengumuman->img_pengumuman) }}"
                                                            alt="Image" style="width: 100px; height: auto;"></p>
                                                @endif
                                                @if ($pengumuman->file_pengumuman)
                                                    <p><strong>File Pengumuman:</strong><br><a
                                                            href="{{ asset('public/' . $pengumuman->file_pengumuman) }}"
                                                            target="_blank">Lihat File</a></p>
                                                @endif
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
        </div>
    </div>
@endsection
