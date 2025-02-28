@extends('admin_layouts.app')

@section('contents')
    <div class="container">
        <h1>Form Jadwal Pelajaran</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- Tombol Toggle untuk Mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Daftar Kelas -->
                <div class="collapse navbar-collapse mt-4" id="navbarNav">
                    <ul class="navbar-nav navbar-nav-cus">
                        @foreach ($classes as $class)
                            <li class="nav-item-cus pt-2 pb-2 border-right border-left border-dark">
                                <a class="nav-link-cus"
                                    href="{{ route('schedule.show', $class) }}">{{ $class->nama_kelas }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>

        <div class="kelas-details">
            @yield('kelas')
        </div>






        <!-- CRUD Jam Pelajaran -->
        <div class="mt-4">
            <h1 class="mb-4">Jam Pelajaran</h1>
            <div class="col-md-12 text-right">
                <div class="mb-4">
                    <a href="" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#tambahJadwalModal"><i class="fas fa-plus"></i> Tambah Jam
                        Pelajaran</a>
                </div>
            </div>
            <!-- Tabel untuk menampilkan daftar jadwal pelajaran -->
            <div class="table-responsive">
                @foreach ($hours->groupBy('hari') as $hari => $groupedHours)
                    <h2 class="mt-4">{{ $hari }}</h2>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Jam Mulai</th>
                                <th scope="col">Jam Selesai</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop untuk menampilkan jadwal pelajaran -->
                            @foreach ($groupedHours as $hour)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $hour->jam }}</td>
                                    <td>{{ $hour->jam_mulai }}</td>
                                    <td>{{ $hour->jam_selesai }}</td>
                                    <td>
                                        <!-- Edit Button with Tooltip -->
                                        <button type="button" class="btn btn-warning mx-2" data-bs-toggle="modal"
                                            data-bs-target="#editJadwalModal"
                                            onclick="fillEditForm('{{ $hour->id_jam }}','{{ $hour->jam }}','{{ $hour->jam_mulai }}', '{{ $hour->jam_selesai }}','{{ $hour->hari }}')"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Form untuk menghapus jam pelajaran -->
                                        <form action="{{ route('schedule.destroy_hours', ['id' => $hour->id_jam]) }}"
                                            method="POST" class="delete-form" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <!-- Delete Button with Tooltip -->
                                            <button type="submit" class="btn btn-danger delete-btn"
                                                data-message="Apakah Anda yakin ingin menghapus data Jam ini?"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>



    <!-- Modal Tambah Jam Pelajaran -->
    <div class="modal fade" id="tambahJadwalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jam Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form tambah jadwal pelajaran -->
                    <form action="{{ route('schedule.add_hours') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari</label>
                            <select class="form-select" id="hari" name="hari">
                                @foreach ($hariOptions as $hari)
                                    <option value="{{ $hari }}">{{ $hari }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jam" class="form-label">Jam</label>
                            <input type="number" class="form-control" id="jam" name="jam">
                        </div>
                        <div class="mb-3">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai">
                        </div>
                        <div class="mb-3">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Edit Jadwal Pelajaran -->
    <div class="modal fade" id="editJadwalModal" tabindex="-1" aria-labelledby="editJadwalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editJadwalModalLabel">Edit Jam Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form edit jadwal pelajaran -->
                    <form id="updateForm{{ $hour->id_jam }}"
                        action="{{ route('schedule_update_hours', ['id' => $hour->id_jam]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id" name="id">

                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari</label>
                            <h1 id="hariLabel"></h1>
                            <input type="hidden" id="edit_hari" name="hari">
                        </div>

                        <div class="mb-3">
                            <label for="edit_jam" class="form-label">Jam</label>
                            <input type="number" class="form-control" id="edit_jam" name="jam">
                        </div>

                        <div class="mb-3">
                            <label for="edit_jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control" id="edit_jam_mulai" name="jam_mulai">
                        </div>

                        <div class="mb-3">
                            <label for="edit_jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control" id="edit_jam_selesai" name="jam_selesai">
                        </div>

                        <button type="button" class="btn btn-primary mt-2"
                            onclick="confirmUpdate('updateForm{{ $hour->id_jam }}')">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
