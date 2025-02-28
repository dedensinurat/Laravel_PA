@extends('admin_layouts.app')

@section('contents')
    <div class="container">
        <h1>Uji Coba Hapus Data</h1>

        <form action="{{ route('students.deleteMultiple') }}" method="POST">
            @csrf
            @method('DELETE') <!-- Tambahkan ini -->
            <button type="submit" class="btn btn-danger" id="deleteSelected">Hapus yang Dipilih</button>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"><input type="checkbox" id="selectAll"></th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Jenis Kelamin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $siswa)
                        <tr>
                            <td>
                                <input type="checkbox" name="ids[]" class="delete-checkbox"
                                    value="{{ $siswa->id_siswa }}">
                            </td>
                            <td>{{ $siswa->nama_lengkap }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->jenis_kelamin }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
@endsection
