@extends('admin_contents.jadwal_pelajaran.jadwal_pelajaran_index')

@section('kelas')
    <div class="container">
        <h4 class="mt-4 mb-4">Jadwal Pelajaran Kelas {{ $class->nama_kelas }}</h4>
        <div class="table-responsive">
            @foreach ($hariOptions as $hari)
                <h5 class="mt-4">{{ $hari }}</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Guru</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($class->schedules()->whereHas('hours', function ($query) use ($hari) {
                $query->where('hari', $hari);
            })->get() as $schedule)
                            <tr>
                                <td>
                                    @if ($schedule->mataPelajaran)
                                        {{ $schedule->mataPelajaran->nama_mata_pelajaran }}
                                    @else
                                        Mata Pelajaran Tidak Ditemukan
                                    @endif
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($schedule->hours->jam_mulai)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($schedule->hours->jam_selesai)->format('H:i') }}
                                </td>
                                <td>
                                    @if ($schedule->guru)
                                        {{ $schedule->guru->nama }}
                                    @else
                                        Belum ditentukan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mb-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#updateScheduleModal" data-hari="{{ $hari }}" data-bs-tooltip="tooltip"
                        title="Edit jadwal">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="updateScheduleModal" tabindex="-1" aria-labelledby="updateScheduleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateScheduleModalLabel">Edit Jadwal Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container"
                        style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <div class="row justify-content-center">
                            @foreach ($hariOptions as $hari)
                                <div class="modal-hari col-12 mb-4" data-hari="{{ $hari }}">
                                    <form action="{{ route('schedule.update', ['id' => $class->id_kelas]) }}" method="POST"
                                        id="form-{{ $hari }}">
                                        @csrf
                                        @method('PUT')

                                        <h3 class="text-center">{{ $hari }}</h3>
                                        <table class="table table-responsive">
                                            <thead class="text-center">
                                                <tr>
                                                    <th scope="col">Jam</th>
                                                    <th scope="col">Mata Pelajaran</th>
                                                    <th scope="col">Guru</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach ($hours->where('hari', $hari) as $hour)
                                                    @php
                                                        $jadwal = $schedules
                                                            ->where('kelas_id', $class->id_kelas)
                                                            ->where('id_jam', $hour->id_jam)
                                                            ->first();
                                                    @endphp
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($hour->jam_mulai)->format('H:i') }} -
                                                            {{ \Carbon\Carbon::parse($hour->jam_selesai)->format('H:i') }}
                                                        </td>
                                                        <td>
                                                            <select class="form-select"
                                                                name="mata_pelajaran_id_{{ $hari }}_{{ $hour->id_jam }}">
                                                                <option value="" disabled selected>Pilih Mata
                                                                    Pelajaran</option>
                                                                @if ($jadwal && $jadwal->mataPelajaran)
                                                                    <option
                                                                        value="{{ $jadwal->mataPelajaran->id_mata_pelajaran }}"
                                                                        selected>
                                                                        {{ $jadwal->mataPelajaran->nama_mata_pelajaran }}
                                                                    </option>
                                                                @endif
                                                                @foreach ($courses as $mataPelajaran)
                                                                    <option
                                                                        value="{{ $mataPelajaran->id_mata_pelajaran }}">
                                                                        {{ $mataPelajaran->nama_mata_pelajaran }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-select"
                                                                name="guru_id_{{ $hari }}_{{ $hour->id_jam }}">
                                                                <option value="" disabled selected>Pilih Guru</option>
                                                                @if ($jadwal && $jadwal->guru)
                                                                    <option value="{{ $jadwal->guru->id_guru }}" selected>
                                                                        {{ $jadwal->guru->nama }}
                                                                    </option>
                                                                @endif
                                                                @foreach ($gurus as $guru)
                                                                    <option value="{{ $guru->id_guru }}">
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var updateScheduleModal = document.getElementById('updateScheduleModal');
        updateScheduleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var hari = button.getAttribute('data-hari');

            // Hide all hari sections initially
            var modalHariSections = updateScheduleModal.querySelectorAll('.modal-hari');
            modalHariSections.forEach(function(section) {
                section.style.display = 'none';
            });

            // Show only the relevant hari section
            var activeSection = updateScheduleModal.querySelector('.modal-hari[data-hari="' + hari + '"]');
            if (activeSection) {
                activeSection.style.display = 'block';
            }
        });
    </script>
@endsection
