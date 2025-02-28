@extends('guru_layouts.app')

@section('title', 'Jadwal Mengajar')

@section('contents')    
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th class="bg-primary text-white">Hari</th>
                    <th class="bg-primary text-white">Jam Ke-</th>
                    <th class="bg-primary text-white">Jam Mulai</th>
                    <th class="bg-primary text-white">Jam Selesai</th>
                    <th class="bg-primary text-white">Kelas</th>
                    <th class="bg-primary text-white">Mata Pelajaran</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                @endphp
                @foreach ($daysOfWeek as $day)
                    @if ($schedules->groupBy('hours.hari')->has($day))
                        @php $jadwal = $schedules->groupBy('hours.hari')->get($day); @endphp
                        @foreach ($jadwal as $key => $jadwalPerHari)
                            <tr>
                                @if ($key === 0)
                                    <td rowspan="{{ count($jadwal) }}">{{ $day }}</td>
                                @endif
                                <td>{{ $jadwalPerHari->hours->jam }}</td>
                                <td>{{ $jadwalPerHari->hours->jam_mulai }}</td>
                                <td>{{ $jadwalPerHari->hours->jam_selesai }}</td>
                                <td>{{ $jadwalPerHari->kelas->nama_kelas }}</td>
                                <td>{{ $jadwalPerHari->mataPelajaran->nama_mata_pelajaran }}</td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
