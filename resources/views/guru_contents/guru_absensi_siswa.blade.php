@extends('guru_layouts.app')

@section('title', 'Absensi Siswa')

@section('contents')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @foreach ($schedules->sortBy('hours.jam') as $schedule)
            <div class="schedule-info mt-3 p-3 bg-light rounded">
                <h3 class="text-primary schedule-header">
                    <span class="badge bg-secondary">Kelas {{ $schedule->kelas->nama_kelas }}</span>
                    <span class="badge bg-success">Mata Pelajaran -
                        {{ $schedule->mataPelajaran->nama_mata_pelajaran }}</span>
                    <span class="badge bg-primary">Jam ke-{{ $schedule->hours->jam }}</span>
                </h3>
            </div>

            <form action="{{ route('save-attendance') }}" method="POST">
                @csrf
                <input type="hidden" name="tanggal_absensi" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                <input type="hidden" name="kelas_id" value="{{ $schedule->kelas_id }}">
                <input type="hidden" name="guru_id" value="{{ $schedule->guru_id }}">
                <input type="hidden" name="mata_pelajaran_id" value="{{ $schedule->mata_pelajaran_id }}">
                <input type="hidden" name="id_jadwal" value="{{ $schedule->id_jadwal }}">

                <table class="table table-striped table-bordered mb-2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Status Kehadiran</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedule->kelas->students as $index => $siswa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $siswa->nama_lengkap }}</td>
                                <td>
                                    <select name="status_absensi[{{ $siswa->id_siswa }}]" class="form-control">
                                        @php
                                            $statuses = ['hadir', 'sakit', 'izin', 'alpa'];
                                            $selectedStatus = $siswa
                                                ->absensi()
                                                ->where('mata_pelajaran_id', $schedule->mata_pelajaran_id)
                                                ->where('id_jadwal', $schedule->id_jadwal)
                                                ->value('status_absensi');
                                        @endphp
                                        <option value="" {{ is_null($selectedStatus) ? 'selected' : '' }}>Pilih
                                            Status</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}"
                                                {{ $selectedStatus == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="catatan[{{ $siswa->id_siswa }}]" class="form-control"
                                        value="{{ $siswa->absensi()->where('mata_pelajaran_id', $schedule->mata_pelajaran_id)->where('id_jadwal', $schedule->id_jadwal)->value('catatan') }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary mb-2">Simpan</button>
            </form>
        @endforeach
    </div>
@endsection
