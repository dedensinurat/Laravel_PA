@extends('guru_layouts.app')

@section('title', 'Data Absensi yang Diubah')

@section('contents')
    <div class="container">
        <h1>Data Absensi yang Diubah</h1>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped table-bordered mb-5">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Status Kehadiran</th>
                    <th>Catatan</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($updatedData as $data)
                    <tr>
                        <td>{{ $data['id_siswa'] }}</td>
                        <td>{{ $data['status_absensi'] }}</td>
                        <td>{{ $data['catatan'] }}</td>
                        <td>{{ $data['kelas_id'] }}</td>
                        <td>{{ $data['mata_pelajaran_id'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
