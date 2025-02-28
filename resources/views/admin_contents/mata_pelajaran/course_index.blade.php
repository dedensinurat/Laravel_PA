@extends('admin_layouts.app')

@section('title', 'Mata Pelajaran')

@section('contents')
    <div class="container">
        <div class="col-md-12 text-right">
            <div class="mb-4">
                <a href="{{ route('course.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                    title="Tambah Mata Pelajaran">
                    <i class="fas fa-plus"></i> Tambah Mata Pelajaran
                </a>
            </div>
        </div>
        @include('message')
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-lg-4 mb-4">
                    <div class="card border-primary">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">{{ $course->nama_mata_pelajaran }}</h5>
                                <p class="card-text">{{ $course->deskripsi_mata_pelajaran }}</p>
                            </div>
                            <!-- Conditional styling based on screen width -->
                            <div class="btn-group {{ request()->is('*width=<400px>*') ? 'd-block' : '' }}" role="group"
                                aria-label="Basic example">
                                <button type="button"
                                    class="btn btn-primary {{ request()->is('*width=<400px>*') ? 'btn-block mb-1' : 'mx-1' }}"
                                    data-toggle="modal" data-target="#detailModal{{ $course->id_mata_pelajaran }}"
                                    data-bs-toggle="tooltip" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button"
                                    class="btn btn-warning {{ request()->is('*width=<400px>*') ? 'btn-block mb-1' : 'mx-1' }}"
                                    data-toggle="modal" data-target="#editModal{{ $course->id_mata_pelajaran }}"
                                    data-bs-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- Delete button -->
                                <form action="{{ route('course.destroy', $course->id_mata_pelajaran) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger {{ request()->is('*width=<400px>*') ? 'btn-block delete-btn' : 'mx-1 delete-btn' }}"
                                        data-message="Apakah Anda yakin ingin menghapus mata pelajaran ini?"
                                        data-bs-toggle="tooltip" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Detail Modal -->
                <div class="modal fade" id="detailModal{{ $course->id_mata_pelajaran }}" tabindex="-1" role="dialog"
                    aria-labelledby="detailModalLabel{{ $course->id_mata_pelajaran }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel{{ $course->id_mata_pelajaran }}">Detail Mata
                                    Pelajaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Isi Detail Mata Pelajaran -->
                                <p><strong>Nama:</strong> {{ $course->nama_mata_pelajaran }}</p>
                                <p><strong>Deskripsi:</strong> {{ $course->deskripsi_mata_pelajaran }}</p>
                                <p><strong>Dibuat Pada:</strong> {{ $course->created_at->format('d M Y H:i:s') }}</p>
                                <p><strong>Diperbarui Pada:</strong> {{ $course->updated_at->format('d M Y H:i:s') }}</p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $course->id_mata_pelajaran }}" tabindex="-1" role="dialog"
                    aria-labelledby="editModalLabel{{ $course->id_mata_pelajaran }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $course->id_mata_pelajaran }}">Edit Mata
                                    Pelajaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Isi Form Edit Mata Pelajaran -->
                                <form id="updateForm{{ $course->id_mata_pelajaran }}"
                                    action="{{ route('course.update', $course->id_mata_pelajaran) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <!-- Input fields untuk edit -->
                                    <div class="mb-3">
                                        <label for="nama_mata_pelajaran{{ $course->id_mata_pelajaran }}"
                                            class="form-label">Nama Mata Pelajaran</label>
                                        <input type="text" class="form-control"
                                            id="nama_mata_pelajaran{{ $course->id_mata_pelajaran }}"
                                            name="nama_mata_pelajaran" value="{{ $course->nama_mata_pelajaran }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi_mata_pelajaran{{ $course->id_mata_pelajaran }}"
                                            class="form-label">Deskripsi Mata Pelajaran</label>
                                        <textarea class="form-control" id="deskripsi_mata_pelajaran{{ $course->id_mata_pelajaran }}"
                                            name="deskripsi_mata_pelajaran" required>{{ $course->deskripsi_mata_pelajaran }}</textarea>
                                    </div>
                                    <button type="button" class="btn btn-primary"
                                        onclick="confirmUpdate('updateForm{{ $course->id_mata_pelajaran }}')">Simpan
                                        Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
