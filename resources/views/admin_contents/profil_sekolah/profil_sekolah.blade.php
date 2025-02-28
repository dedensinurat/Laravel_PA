@extends('admin_layouts.app')

@section('title', 'Profil Sekolah')

@section('contents')
<style>
    .text-nonwrap{
        width: 15%
    }
</style>
    <div class="row">
        @include('message')
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table ">
                    <tbody>
                        <tr>
                            <th class="text-nowrap">Nama Sekolah</th>
                            <td>:</td>
                            <td>{{ $profilSekolah->nama_sekolah }}</td>
                        </tr>
                        <tr>
                            <th class="text-nonwrap">Alamat Sekolah</th>
                            <td>:</td>
                            <td>{{ $profilSekolah->alamat_sekolah }}</td>
                        </tr>
                        <tr>
                            <th class="text-nonwrap">No. Telepon Sekolah</th>
                            <td>:</td>
                            <td>{{ $profilSekolah->no_telepon_sekolah }}</td>
                        </tr>
                        <tr>
                            <th class="text-nonwrap">Email Sekolah</th>
                            <td>:</td>
                            <td>{{ $profilSekolah->email_sekolah }}</td>
                        </tr>
                        <tr>
                            <th class="text-nonwrap">Logo Sekolah</th>
                            <td>:</td>
                            <td>
                                @if ($profilSekolah->logo_sekolah)
                                    <img src="{{ asset('storage/' . $profilSekolah->logo_sekolah) }}" alt="Logo Sekolah"
                                        style="max-width: 200px;">
                                @else
                                    <p>No logo available</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-nonwrap">Visi Sekolah</th>
                            <td>:</td>
                            <td>{!! htmlspecialchars_decode($profilSekolah->visi_sekolah) !!}</td>
                        </tr>
                        
                        <tr>
                            <th class="text-nonwrap">Misi Sekolah</th>
                            <td>:</td>
                            <td>{!! htmlspecialchars_decode($profilSekolah->misi_sekolah) !!}</td>
                        </tr>
                        <tr>
                            <th class="text-nonwrap">Sambutan Kepsek</th>
                            <td>:</td>
                            <td>{!! htmlspecialchars_decode($profilSekolah->sambutan_kepsek) !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Action button -->
            <div class="text-right">
                <a href="{{ route('admin.edit_profil_sekolah') }}" class="btn btn-primary my-5">
                    <i class="fas fa-edit"></i> Edit Profil Sekolah
                </a>
            </div>
        </div>
    </div>
@endsection
