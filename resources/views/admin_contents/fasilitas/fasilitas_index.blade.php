@extends('admin_layouts.app')

@section('title', 'Fasilitas')

@section('contents')
    <div class="container">
        <div class="col-md-12 text-right">
            <div class="mb-4">
                <!-- Button tambah fasilitas -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahModal">
                    <i class="fas fa-plus"></i> Tambah Fasilitas
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Fasilitas</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fasilitas as $item)
                        <tr>
                            <td>{{ $item->nama_fasilitas }}</td>
                            <td><img src="{{ url('public/' . $item->img_fasilitas) }}" alt="Gambar Fasilitas"
                                    style="max-width: 100px;"></td>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#detailModal{{ $item->id_fasilitas }}" data-toggle="tooltip"
                                    title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <!-- Edit Button -->
                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#editModal{{ $item->id_fasilitas }}" data-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- Delete Button -->
                                <form action="{{ route('fasilitas.destroy', $item->id_fasilitas) }}" method="POST"
                                    class="delete-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn"
                                        data-message="Apakah Anda yakin ingin menghapus fasilitas ini?"
                                        data-toggle="tooltip" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                <!-- Detail Button -->
                            </td>

                        </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $item->id_fasilitas }}" tabindex="-1" role="dialog"
                            aria-labelledby="editModalLabel{{ $item->id_fasilitas }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $item->id_fasilitas }}">Edit
                                            Fasilitas
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form edit fasilitas -->
                                        <form action="{{ route('fasilitas.update', $item->id_fasilitas) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="nama_fasilitas">Nama Fasilitas:</label>
                                                <input type="text" class="form-control" id="nama_fasilitas"
                                                    name="nama_fasilitas" value="{{ $item->nama_fasilitas }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsi_fasilitas">Deskripsi:</label>
                                                <!-- Added Deskripsi input -->
                                                <textarea class="form-control" id="deskripsi_fasilitas_edit" name="deskripsi_fasilitas">{{ $item->deskripsi }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlah">Jumlah:</label>
                                                <input type="text" class="form-control" id="jumlah" name="jumlah"
                                                    value="{{ $item->jumlah }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="kondisi">Kondisi:</label>
                                                <input type="text" class="form-control" id="kondisi" name="kondisi"
                                                    value="{{ $item->kondisi }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="lokasi">Lokasi:</label>
                                                <input type="text" class="form-control" id="lokasi" name="lokasi"
                                                    value="{{ $item->lokasi }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="gambar_fasilitas">Gambar Fasilitas:</label>
                                                <input type="file" class="form-control-file" id="gambar_fasilitas"
                                                    name="gambar_fasilitas">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal{{ $item->id_fasilitas }}" tabindex="-1" role="dialog"
                            aria-labelledby="detailModalLabel{{ $item->id_fasilitas }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel{{ $item->id_fasilitas }}">Detail
                                            Fasilitas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Nama Fasilitas:</strong> {{ $item->nama_fasilitas }}</p>
                                        <p><strong>Jumlah:</strong> {{ $item->jumlah }}</p>
                                        <p><strong>Kondisi:</strong> {{ $item->kondisi }}</p>
                                        <p><strong>Lokasi:</strong> {{ $item->lokasi }}</p>
                                        <p><strong>Deskripsi:</strong> {{ $item->deskripsi }}</p>
                                       <img src="{{ url('public/' . $item->img_fasilitas) }}" alt="Gambar Fasilitas"
                                            style="max-width: 100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Fasilitas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_fasilitas">Nama Fasilitas:</label>
                            <input type="text" class="form-control" id="nama_fasilitas" name="nama_fasilitas"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_fasilitas">Deskripsi:</label>
                            <textarea class="form-control" id="deskripsi_fasilitas_tambah" name="deskripsi_fasilitas"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah:</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="kondisi">Kondisi:</label>
                            <input type="text" class="form-control" id="kondisi" name="kondisi" required>
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Lokasi:</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar_fasilitas">Gambar Fasilitas:</label>
                            <input type="file" class="form-control" id="gambar_fasilitas" name="gambar_fasilitas"
                                accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-success">Tambah Fasilitas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#deskripsi_fasilitas_edit'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#deskripsi_fasilitas_tambah'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
