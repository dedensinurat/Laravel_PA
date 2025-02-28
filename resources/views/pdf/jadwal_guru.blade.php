<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Mengajar Guru</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            size: landscape;
            margin: 1cm;
        }

        .table {
            font-size: 10px;
        }

        table {
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }

        .day-header {
            background-color: #4e73df;
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 14px;
            padding: 5px 0;
        }

        .bg-primary {
            background-color: #4e73df !important;
        }

        .text-white {
            color: #ffffff !important;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <h4 class="text-center mb-4">Jadwal Mengajar Semua Guru</h4>
        @foreach ($schedules as $teacherName => $jadwalGuru)
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h5>{{ ucwords($teacherName) }}</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        @foreach ($jadwalGuru->groupBy('hours.hari') as $hari => $jadwalPerHari)
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr class="day-header">
                                        <td colspan="5">{{ ucfirst($hari) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-primary text-white">Jam Ke-</th>
                                        <th class="bg-primary text-white">Jam Mulai</th>
                                        <th class="bg-primary text-white">Jam Selesai</th>
                                        <th class="bg-primary text-white">Kelas</th>
                                        <th class="bg-primary text-white">Mata Pelajaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwalPerHari as $jadwal)
                                        <tr>
                                            <td>{{ $jadwal->hours->jam }}</td>
                                            <td>{{ $jadwal->hours->jam_mulai }}</td>
                                            <td>{{ $jadwal->hours->jam_selesai }}</td>
                                            <td>{{ $jadwal->kelas->nama_kelas }}</td>
                                            <td>{{ $jadwal->mataPelajaran->nama_mata_pelajaran }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
