@extends('guru_layouts.app')

@section('title', 'Daftar Siswa')

@section('contents')
    <div class="container">        
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
                                                <td>{{ $index + 1 }}</td> <!-- Perbaikan: Tambahkan nomor urut -->
                                                <td>{{ $siswa->nama_lengkap }}</td>
                                                <td>{{ $siswa->nisn }}</td>
                                                <td>{{ $siswa->jenis_kelamin }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary mx-1" data-toggle="modal"
                                                        data-target="#detailModal{{ $siswa->id_siswa }}" data-bs-toggle="tooltip" title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
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
                                            <td>{{ $siswa->class->nama_kelas }}</td>
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
