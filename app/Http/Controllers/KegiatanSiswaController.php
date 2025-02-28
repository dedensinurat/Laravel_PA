<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanSiswa;
use Illuminate\Support\Facades\Storage;

class KegiatanSiswaController extends Controller
{
    public function index()
    {
        $kegiatan_siswa = KegiatanSiswa::all();
        return view('admin_contents.kegiatan_siswa.index', compact('kegiatan_siswa'));
    }

    public function create()
    {
        return view('admin_contents.kegiatan_siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'isi_kegiatan' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'waktu_kegiatan' => 'required|string|max:10',
            'tempat_kegiatan' => 'required|string|max:255',
            'foto_kegiatan' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori_kegiatan' => 'required|string|max:255',
        ]);

        // Check if an image file is uploaded
        if ($request->hasFile('foto_kegiatan')) {
            $fileNameWithExt = $request->file('foto_kegiatan')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('foto_kegiatan')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $imagePath = $request->file('foto_kegiatan')->storeAs('public/images', $fileNameToStore);
            $fotoPath = 'images/' . $fileNameToStore;
        } else {
            $fotoPath = null;
        }

        // Ambil ID user dari session
        $id_user = session('id_user');

        KegiatanSiswa::create([
            'judul_kegiatan' => $request->judul_kegiatan,
            'isi_kegiatan' => $request->isi_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'waktu_kegiatan' => $request->waktu_kegiatan,
            'tempat_kegiatan' => $request->tempat_kegiatan,
            'foto_kegiatan' => $fotoPath,
            'kategori_kegiatan' => $request->kategori_kegiatan,
            'id_user' => $id_user,
        ]);

        return redirect()->route('kegiatan-siswa.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kegiatan = KegiatanSiswa::find($id);

        if (!$kegiatan) {
            return redirect()->route('kegiatan-siswa.index')->with('error', 'Kegiatan tidak ditemukan.');
        }

        return view('admin_contents.kegiatan_siswa.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'judul_kegiatan' => 'Required|string|max:255',
        'isi_kegiatan' => 'Required|string',
        'tanggal_kegiatan' => 'Required|date',
        'waktu_kegiatan' => 'Required|string|max:10',
        'tempat_kegiatan' => 'Required|string|max:255',
        'kategori_kegiatan' => 'Required|string|max:255',
        'foto_kegiatan' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {
        $kegiatan = KegiatanSiswa::findOrFail($id);
        $kegiatan->update([
            'judul_kegiatan' => $request->judul_kegiatan,
            'isi_kegiatan' => $request->isi_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'waktu_kegiatan' => $request->waktu_kegiatan,
            'tempat_kegiatan' => $request->tempat_kegiatan,
            'kategori_kegiatan' => $request->kategori_kegiatan,
            'id_user' => session('id_user'),
        ]);

        // Check if an image file is uploaded
        if ($request->hasFile('foto_kegiatan')) {
            $imgPath = $kegiatan->foto_kegiatan;
            if ($imgPath) {
                Storage::disk('public')->delete($imgPath); // Menghapus gambar lama
            }
            // Mendapatkan nama file dengan ekstensi
            $fileNameWithExt = $request->file('foto_kegiatan')->getClientOriginalName();
            // Mendapatkan nama file tanpa ekstensi
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Mendapatkan ekstensi file
            $extension = $request->file('foto_kegiatan')->getClientOriginalExtension();
            // Nama file yang akan disimpan
            $fileNameToStore = $fileName. '_'. time(). '.'. $extension;
            // Simpan file gambar ke folder public/images
            $imagePath = $request->file('foto_kegiatan')->storeAs('public/images', $fileNameToStore);
            // Set the image path in the KegiatanSiswa model
            $kegiatan->foto_kegiatan = 'images/'. $fileNameToStore;
            $kegiatan->save();
        }

        session()->flash('success', 'Kegiatan berhasil diperbarui.');
        return redirect()->route('kegiatan-siswa.index');
    } catch (\Exception $e) {
        session()->flash('error', 'Terjadi kesalahan saat memperbarui kegiatan: '. $e->getMessage());
        return redirect()->back()->withInput();
    }
}




    public function destroy($id)
    {
        $kegiatan = KegiatanSiswa::find($id);
        if ($kegiatan->foto_kegiatan) {
            Storage::disk('public')->delete($kegiatan->foto_kegiatan);
        }
        $kegiatan->delete();

        return redirect()->route('kegiatan-siswa.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}
