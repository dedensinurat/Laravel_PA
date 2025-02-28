<!DOCTYPE html>
<html>

<head>
    <title>Data Absensi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        css Copy code th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }

        .highlight {
            background-color: #d1e7dd;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1 class="mb-4">Data Absensi</h1>
        @foreach ($absensi as $tanggal => $dataAbsensi)
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Tanggal: {{ $tanggal }}</h2>
                    <div class="d-flex justify-content-between">
                        <h5>Guru: {{ ucwords($dataAbsensi->first()->user->username) }}</h5>
                        <h5>Kelas: {{ $dataAbsensi->first()->kelas->nama_kelas }}</h5>
                        <h5>Mata Pelajaran: {{ $dataAbsensi->first()->mataPelajaran->nama_mata_pelajaran }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Siswa</th>
                                <th>Status Absensi</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataAbsensi as $index => $absen)
                                <tr class="{{ $absen->status_absensi == 'Hadir' ? 'highlight' : '' }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $absen->siswa->nama_lengkap }}</td>
                                    <td>{{ $absen->status_absensi }}</td>
                                    <td>{{ $absen->catatan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
