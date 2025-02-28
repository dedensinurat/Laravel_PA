<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasis = Prestasi::all();
        return view('admin_contents.prestasis.index', compact('prestasis'));
    }

    public function create()
    {
        $siswas = Siswa::with('class')->get()->groupBy('class.nama_kelas');

        return view('admin_contents.prestasis.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'siswa_id' => 'required|integer',
                'jenis_prestasi' => 'required|string|max:255',
                'tingkat_prestasi' => 'required|string|max:255',
                'tahun_prestasi' => 'required|string|max:4',
                'deskripsi_prestasi' => 'required|string',
                'foto_prestasi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Ambil ID user dari session
            $id_user = session('id_user');

            $fotoPath = null;
            if ($request->hasFile('foto_prestasi')) {
                // Mendapatkan nama file dengan ekstensi
                $fileNameWithExt = $request->file('foto_prestasi')->getClientOriginalName();
                // Mendapatkan nama file tanpa ekstensi
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Mendapatkan ekstensi file
                $extension = $request->file('foto_prestasi')->getClientOriginalExtension();
                // Nama file yang akan disimpan
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                // Simpan file gambar ke folder public/images
                $fotoPath = $request->file('foto_prestasi')->storeAs('public/images', $fileNameToStore);
                // Ubah path menjadi URL
                $fotoPath = 'images/' . $fileNameToStore;
            }

            Prestasi::create([
                'siswa_id' => $request->siswa_id,
                'jenis_prestasi' => $request->jenis_prestasi,
                'tingkat_prestasi' => $request->tingkat_prestasi,
                'tahun_prestasi' => $request->tahun_prestasi,
                'deskripsi_prestasi' => $request->deskripsi_prestasi,
                'foto_prestasi' => $fotoPath,
                'id_user' => $id_user,
            ]);

            session()->flash('success', 'Prestasi berhasil ditambahkan.');
            return redirect()->route('prestasis.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menambahkan prestasi: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function edit($id)
    {
        $prestasi = Prestasi::find($id);

        if (!$prestasi) {
            return redirect()->route('prestasis.index')->with('error', 'Prestasi tidak ditemukan.');
        }

        return view('admin_contents.prestasis.edit_prestasi', compact('prestasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'Required|integer',
            'jenis_prestasi' => 'Required|string|max:255',
            'tingkat_prestasi' => 'Required|string|max:255',
            'tahun_prestasi' => 'Required|string|max:4',
            'deskripsi_prestasi' => 'Required|string',
            'foto_prestasi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_user' => 'Required|integer'
        ]);

        $prestasi = Prestasi::find($id);

        $fotoPath = $prestasi->foto_prestasi;
        if ($request->hasFile('foto_prestasi')) {
            $validatedData = $request->validate([
                'foto_prestasi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fileNameWithExt = $request->file('foto_prestasi')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('foto_prestasi')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $fotoPath = $request->file('foto_prestasi')->storeAs('public/images', $fileNameToStore);
            $fotoPath = 'images/' . $fileNameToStore;
        }

        $prestasi->update([
            'iswa_id' => $request->siswa_id,
            'jenis_prestasi' => $request->jenis_prestasi,
            'tingkat_prestasi' => $request->tingkat_prestasi,
            'tahun_prestasi' => $request->tahun_prestasi,
            'deskripsi_prestasi' => $request->deskripsi_prestasi,
            'foto_prestasi' => $fotoPath,
            'id_user' => $request->id_user
        ]);

        return redirect()->route('prestasis.index')
            ->with('success', 'Prestasi berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $prestasi = Prestasi::find($id);
        if ($prestasi->foto_prestasi) {
            Storage::disk('public')->delete($prestasi->foto_prestasi);
        }
        $prestasi->delete();

        return redirect()->route('prestasis.index')
            ->with('success', 'Prestasi berhasil dihapus.');
    }
}
