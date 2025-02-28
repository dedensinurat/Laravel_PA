@extends('admin_layouts.app')

@section('contents')
    <div class="container">
        <h1>Inbox</h1>
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>

                        <th>Tanggal</th>

                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $message->tanggal }}</td>

                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#viewModal{{ $message->id_pengunjung }}">
                                    Lihat
                                </button>
                                {{-- <form action="{{ route('inbox.destroy', $message->_pengunjung) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form> --}}
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="viewModal{{ $message->id_pengunjung }}" tabindex="-1" role="dialog"
                            aria-labelledby="viewModalLabel{{ $message->id_pengunjung }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel{{ $message->id_pengunjung }}">Detail Pesan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Nama Pengunjung ya:</strong>
                                            {{ optional($message->pengunjung)->nama_pengunjung ?? 'Unknown' }}</p>
                                        <p><strong>Email:</strong> {{ optional($message->pengunjung)->email ?? 'Unknown' }}
                                        </p>
                                        <p><strong>Tanggal:</strong> {{ $message->tanggal }}</p>
                                        <p><strong>Subjek:</strong> {{ $message->subjek }}</p>
                                        <p><strong>Isi Pesan:</strong> {{ $message->isi_pesan }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
