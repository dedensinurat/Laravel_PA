@extends('staf_layouts.app')

@section('title', '')

@section('contents')
    <h1>Jadwal Mengajar Semua Guru</h1>
    <a href="#" onclick="event.preventDefault(); document.getElementById('export-pdf-form').submit();"
        class="btn btn-primary mb-4">
        Export to PDF
    </a>

    <form id="export-pdf-form" action="{{ route('export_jadwal.pdf') }}" method="post" style="display: none;">
        @csrf
    </form>

    @php
        // Define the order of the days
        $dayOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    @endphp

    @foreach ($schedules as $teacherName => $jadwalGuru)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">{{ ucwords($teacherName) }}</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" data-page-length='100'
                        id="siswaTable{{ $loop->index }}">
                        <thead>
                            <tr>
                                <th class="bg-primary text-white">Hari</th>
                                <th class="bg-primary text-white">Jam Ke-</th>
                                <th class="bg-primary text-white">Jam Mulai</th>
                                <th class="bg-primary text-white">Jam Selesai</th>
                                <th class="bg-primary text-white">Kelas</th>
                                <th class="bg-primary text-white">Mata Pelajaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Sort the schedule by day order
                                $sortedJadwalGuru = $jadwalGuru->sortBy(function ($jadwal) use ($dayOrder) {
                                    return array_search($jadwal->hours->hari, $dayOrder);
                                });
                            @endphp
                            @foreach ($sortedJadwalGuru as $jadwal)
                                <tr>
                                    <td>{{ $jadwal->hours->hari }}</td>
                                    <td>{{ $jadwal->hours->jam }}</td>
                                    <td>{{ $jadwal->hours->jam_mulai }}</td>
                                    <td>{{ $jadwal->hours->jam_selesai }}</td>
                                    <td>{{ $jadwal->kelas->nama_kelas }}</td>
                                    <td>{{ $jadwal->mataPelajaran->nama_mata_pelajaran }}</td>
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
    <!-- Ensure jQuery is loaded -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">

    <script>
        $(document).ready(function() {
            // Initialize DataTables for each table
            $('[id^="siswaTable"]').DataTable({
                "order": [],
                dom: 'Bfrtip',
                buttons: ['excel']
            });
        });
    </script>
@endsection
