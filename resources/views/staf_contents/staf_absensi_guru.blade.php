@extends('staf_layouts.app')

@section('title', 'Absensi')

@section('contents')
    <h1 class="mb-4">Data Absensi</h1>
    <a href="#" onclick="event.preventDefault(); document.getElementById('export-pdf-form').submit();"
        class="btn btn-primary mb-4">
        Export to PDF
    </a>

    <form id="export-pdf-form" action="{{ route('export_absensi.pdf') }}" method="post" style="display: none;">
        @csrf
    </form>
    @foreach ($absensi as $tanggal => $dataAbsensi)
        <div class="card mb-4 shadow-lg border-0">
            <div class="card-header bg-light text-muted">
                <h2 class="mb-4">Tanggal: {{ $tanggal }}</h2>
                <div class="d-flex justify-content-between">
                    <h5>Guru: {{ ucwords($dataAbsensi->first()->user->username) }}</h5>
                    <h5>Kelas: {{ $dataAbsensi->first()->kelas->nama_kelas }}</h5>
                    <h5>Mata Pelajaran: {{ $dataAbsensi->first()->mataPelajaran->nama_mata_pelajaran }}</h5>
                </div>
            </div>
            <div class="card-body bg-white">
                <div class="table-responsive">
                    <table id="siswaTable-{{ $loop->index }}" data-page-length='100'
                        class="table table-bordered table-hover table-striped">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Status Absensi</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataAbsensi as $absen)
                                <tr class="bg-white text-muted">
                                    <td>{{ ucwords($absen->siswa->nama_lengkap) }}</td>
                                    <td>{{ $absen->status_absensi }}</td>
                                    <td>{{ $absen->catatan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTables for each table with a unique ID
            $('[id^="siswaTable-"]').each(function() {
                $(this).DataTable({
                    "order": [],
                    "lengthChange": true,
                    dom: 'Bfrtip',
                    buttons: ['excel'],
                    select: true,
                    language: {
                        lengthMenu: 'Display <select>' +
                            '<option value="10">10</option>' +
                            '<option value="20">20</option>' +
                            '<option value="30">30</option>' +
                            '<option value="40">40</option>' +
                            '<option value="50">50</option>' +
                            '<option value="-1">All</option>' +
                            '</select> records'
                    }
                });
            });
        });
    </script>
@endsection
