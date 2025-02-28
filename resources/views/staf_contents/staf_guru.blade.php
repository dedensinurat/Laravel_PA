@extends('staf_layouts.app')

@section('contents')
    <div class="container">

        <h1>Data Guru</h1>
        
        <!-- Export PDF Button -->
        <div class="mb-3">
            <a href="#" onclick="event.preventDefault(); document.getElementById('export-pdf-form').submit();"
                class="btn btn-success">
                Export PDF
            </a>

            <form id="export-pdf-form" action="{{ route('teachers.exportPdfAll') }}" method="post" style="display: none;">
                @csrf
                <input type="hidden" name="export" value="all">
            </form>
        </div>

        <div class="row">

            @foreach ($teachers as $teacher)
                <div class="col-lg-4 mb-4">
                    <div class="card border-primary">
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>
                                            <h5>NIP:</h5>
                                        </strong></td>
                                    <td>{{ $teacher->nip }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama:</strong></td>
                                    <td>{{ $teacher->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat:</strong></td>
                                    <td>{{ $teacher->alamat }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Kelamin:</strong></td>
                                    <td>{{ $teacher->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Foto Profil:</strong></td>
                                    <td>
                                        @if ($teacher->foto_profil)
                                            <img src="{{ url('public/'.$teacher->foto_profil) }}" alt="Foto Profil"
                                                class="img-fluid mb-3 img-profile">
                                        @else
                                            Tidak Ada Foto Profil {{$teacher->foto_profil}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Mata Pelajaran:</strong></td>
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
                                <tr>
                                    <td colspan="2">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#detailModal{{ $teacher->id_guru }}">Detail</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail Guru -->
                <div class="modal fade" id="detailModal{{ $teacher->id_guru }}" tabindex="-1" role="dialog"
                    aria-labelledby="detailModalLabel{{ $teacher->id_guru }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel{{ $teacher->id_guru }}">Detail Guru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>NIP:</strong> {{ $teacher->nip }}</p>
                                <p><strong>Nama:</strong> {{ $teacher->nama }}</p>
                                <p><strong>Alamat:</strong> {{ $teacher->alamat }}</p>
                                <p><strong>Jenis Kelamin:</strong> {{ $teacher->jenis_kelamin }}</p>
                                <p><strong>Mata Pelajaran:</strong>
                                    {{ $subject ? $subject->nama_mata_pelajaran : 'Mata Pelajaran tidak tersedia' }}</p>
                                <p><strong>Foto Profil:</strong>
                                    @if ($teacher->foto_profil)
                                        <img src="{{ url('public/'.$teacher->foto_profil) }}" alt="Foto Profil"
                                            class="img-fluid img-thumbnail">
                                    @else
                                        Tidak Ada Foto Profil
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
