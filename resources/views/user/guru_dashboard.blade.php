@extends('guru_layouts.app')
@section('title', 'Dashboard')
@section('contents')

    <div class="row">
        <!-- Jadwal Mengajar -->
        <div class="col-md-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary my-3" data-bs-toggle="modal" data-bs-target="#passwordModal">
                Ganti Password & Username
            </button>
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Jadwal Mengajar</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @if ($schedules && count($schedules) > 0)
                            @foreach ($schedules as $schedule)
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center {{ now()->between($schedule->hours->jam_mulai, $schedule->hours->jam_selesai) ? 'current-class' : '' }}">
                                    <div>
                                        <strong>{{ $schedule->hours->hari }}</strong> -
                                        {{ $schedule->hours->jam_mulai }} -
                                        {{ $schedule->hours->jam_selesai }} -
                                        {{ $schedule->mataPelajaran->nama_mata_pelajaran }} di Kelas
                                        {{ $schedule->kelas->nama_kelas }}
                                    </div>
                                    @if (now()->between($schedule->hours->jam_mulai, $schedule->hours->jam_selesai))
                                        <span class="badge bg-success">Sekarang</span>
                                    @endif
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">Tidak ada jadwal mengajar hari ini</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if (session('error'))
        <div class="alert alert-danger mt-3" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="passwordModalLabel">Ganti Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('guru.password.update') }}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ Session::get('username') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="current_password">Password Lama</label>
                            <input type="password" class="form-control" id="current_password" name="current_password"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ganti Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection

@push('styles')
    <style>
        .current-class {
            font-weight: bold;
            color: green;
        }
    </style>
@endpush
