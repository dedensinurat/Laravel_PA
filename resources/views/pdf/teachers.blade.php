<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Guru</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .profile-image {
            max-width: 50px;
            max-height: 50px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Data Guru</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Foto Profil</th> <!-- Changed the position of the Foto Profil column to the first -->
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Mata Pelajaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachers as $teacher)
                <tr>
                    <td>
                        @if ($teacher->foto_profil)
                            <img src="{{ public_path($teacher->foto_profil) }}" alt="Foto Profil" class="img-fluid profile-image">
                        @else
                            Tidak Ada Foto Profil
                        @endif
                    </td>
                    <td>{{ $teacher->nip }}</td>
                    <td>{{ $teacher->nama }}</td>
                    <td>{{ $teacher->alamat }}</td>
                    <td>{{ $teacher->jenis_kelamin }}</td>
                    <td>
                        @if ($teacher->id_mata_pelajaran)
                            @php
                                $subject = App\Models\Course::find($teacher->id_mata_pelajaran);
                            @endphp
                            {{ $subject ? $subject->nama_mata_pelajaran : 'Mata Pelajaran tidak tersedia' }}
                        @else
                            Mata Pelajaran tidak tersedia
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
