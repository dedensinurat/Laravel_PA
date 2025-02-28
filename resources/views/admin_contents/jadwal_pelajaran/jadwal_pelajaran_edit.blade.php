@extends('admin_layouts.app')

@section('contents')
    <div class="container">
        <h2>Edit Jadwal Pelajaran</h2>

        <div class="row">
            @foreach ($hariOptions as $hari)
                <div class="col-md-4 mb-4">
                    <form action="{{ route('schedule.update', ['id' => $kelasId]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h3>{{ $hari }}</h3>
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Mata Pelajaran</th>
                                    <th scope="col">Guru</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hours->where('hari', $hari) as $hour)
                                    @php
                                        $jadwal = $schedules->where('kelas_id', $kelasId)->where('id_jam', $hour->id_jam)->first();
                                    @endphp
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($hour->jam_mulai)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($hour->jam_selesai)->format('H:i') }}
                                        </td>
                                        <td>
                                            <select class="form-select" name="mata_pelajaran_id_{{ $hari }}_{{ $hour->id_jam }}">
                                                <option value="" selected>Pilih Mata Pelajaran</option>
                                                @if ($jadwal && $jadwal->mataPelajaran)
                                                    <option value="{{ $jadwal->mataPelajaran->id }}" selected>
                                                        {{ $jadwal->mataPelajaran->nama_mata_pelajaran }}
                                                    </option>
                                                @endif
                                                @foreach ($courses as $mataPelajaran)
                                                    <option value="{{ $mataPelajaran->id }}">
                                                        {{ $mataPelajaran->nama_mata_pelajaran }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select" name="guru_id_{{ $hari }}_{{ $hour->id_jam }}">
                                                <option value="" selected>Pilih Guru</option>
                                                @if ($jadwal && $jadwal->guru)
                                                    <option value="{{ $jadwal->guru->id }}" selected>
                                                        {{ $jadwal->guru->nama }}
                                                    </option>
                                                @endif
                                                @foreach ($gurus as $guru)
                                                    <option value="{{ $guru->id }}">
                                                        {{ $guru->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Update {{ $hari }}</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection





{{-- 
                        $schedule = $schedules->where('kelas_id', $kelasId)->first();
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Jam</th>
                                    <th>Kelas ID</th>
                                    <th>Mata Pelajaran ID</th>
                                    <th>Guru ID</th>
                                    <th>User ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->id_jam }}</td>
                                    <td>{{ $schedule->kelas_id }}</td>
                                    <td>{{ $schedule->mata_pelajaran_id }}</td>
                                    <td>{{ $schedule->guru_id }}</td>
                                    <td>{{ $schedule->id_user }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table> --}}

{{-- <option value="{{ $hari }}" >
                            {{ $hour->id_jam }}
                        </option> --}}
