@extends('admin_layouts.app')

@section('contents')
<div class="container">
        <h3>Preview Perubahan Jadwal</h3>
        @if (!empty($newData))
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newData as $data)
                        <tr>
                            <td>{{ $data['hari'] }}</td>
                            <td>{{ $data['jam'] }}</td>
                            <td>{{ $data['mata_pelajaran'] }}</td>
                            <td>{{ $data['guru'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada perubahan yang dilakukan.</p>
        @endif
    </div>
@endsection
