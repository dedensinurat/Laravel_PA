@extends('admin_layouts.app')

@section('title', 'Sejarah')

@section('contents')
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tahun</th>
                    <th>Deskripsi</th>
                    <th>Sumber</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sejarah as $item)
                    <tr>
                        <td>{{ $item->tahun }}</td>
                        <td>{!! htmlspecialchars_decode($item->deskripsi) !!}</td>
                        <td>{{ $item->sumber }}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $item->id_sejarah }}" data-bs-tooltip="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>

                    </tr>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal{{ $item->id_sejarah }}" tabindex="-1" role="dialog"
                        aria-labelledby="editModalLabel{{ $item->id_sejarah }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $item->id_sejarah }}">Edit Sejarah</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form edit sejarah -->
                                    <form action="{{ route('sejarah.update', $item->id_sejarah) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="tahun">Tahun:</label>
                                            <input type="text" class="form-control" id="tahun" name="tahun"
                                                value="{{ $item->tahun }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi" class="form-label">Deskripsi:</label>
                                            <textarea class="form-control" id="deskripsi_sejarah" name="deskripsi" rows="3">{!! htmlspecialchars_decode($item->deskripsi) !!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="sumber">Sumber:</label>
                                            <input type="text" class="form-control" id="sumber" name="sumber"
                                                value="{{ $item->sumber }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
