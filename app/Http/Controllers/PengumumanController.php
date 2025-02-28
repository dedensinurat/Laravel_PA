<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::all();
        return view('admin_contents.pengumumans.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('admin_contents.pengumumans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_pengumuman' => 'required|string|max:255',
            'isi_pengumuman' => 'required|string',
            'tanggal_pengumuman' => 'required|date',
            'waktu_pengumuman' => 'required|string|max:10',
            'penulis' => 'required|string|max:255',
            'kategori_pengumuman' => 'required|string|max:255',
            'file_pengumuman' => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
            'img_pengumuman' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tambahkan validasi untuk img_pengumuman
        ]);

        $filePath = null;
        if ($request->hasFile('file_pengumuman')) {
            $filePath = $request->file('file_pengumuman')->store('file_pengumuman', 'public');
        }

        $imgPath = null;
        if ($request->hasFile('img_pengumuman')) {
            // Mendapatkan nama file dengan ekstensi
            $fileNameWithExt = $request->file('img_pengumuman')->getClientOriginalName();
            // Mendapatkan nama file tanpa ekstensi
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Mendapatkan ekstensi file
            $extension = $request->file('img_pengumuman')->getClientOriginalExtension();
            // Nama file yang akan disimpan
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Simpan file gambar ke folder public/images
            $imgPath = $request->file('img_pengumuman')->storeAs('public/images', $fileNameToStore);
        }

        // Ambil ID user dari session
        $id_user = session('id_user');

        try {
            Pengumuman::create([
                'judul_pengumuman' => $request->judul_pengumuman,
                'isi_pengumuman' => $request->isi_pengumuman,
                'tanggal_pengumuman' => $request->tanggal_pengumuman,
                'waktu_pengumuman' => $request->waktu_pengumuman,
                'penulis' => $request->penulis,
                'kategori_pengumuman' => $request->kategori_pengumuman,
                'file_pengumuman' => $filePath,
                'img_pengumuman' => $imgPath ? 'images/' . $fileNameToStore : null, // Simpan path img_pengumuman
                'id_user' => $id_user,
            ]);

            session()->flash('success', 'Pengumuman berhasil diperbarui.');
            return redirect()->route('pengumumans.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memperbarui pengumuman: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function edit($id)
    {
        $pengumuman = Pengumuman::find($id);

        if (!$pengumuman) {
            return redirect()->route('pengumumans.index')->with('error', 'Pengumuman tidak ditemukan.');
        }

        return view('admin_contents.pengumumans.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_pengumuman' => 'required|string|max:255',
            'isi_pengumuman' => 'required|string',
            'tanggal_pengumuman' => 'required|date',
            'waktu_pengumuman' => 'required|string|max:10',
            'penulis' => 'required|string|max:255',
            'kategori_pengumuman' => 'required|string|max:255',
            'file_pengumuman' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'img_pengumuman' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'id_user' => 'required|integer'
        ]);

        try {
            $pengumuman = Pengumuman::findOrFail($id);

            // Menangani upload file dokumen
            $filePath = $pengumuman->file_pengumuman;
            if ($request->hasFile('file_pengumuman')) {
                if ($filePath) {
                    Storage::disk('public')->delete($filePath); // Menghapus file lama
                }
                $filePath = $request->file('file_pengumuman')->store('file_pengumuman', 'public'); // Menyimpan file baru
            }

            // Menangani upload gambar
            $imgPath = $pengumuman->img_pengumuman;
            if ($request->hasFile('img_pengumuman')) {
                if ($imgPath) {
                    Storage::disk('public')->delete($imgPath); // Menghapus gambar lama
                }
                // Mendapatkan nama file dengan ekstensi
                $fileNameWithExt = $request->file('img_pengumuman')->getClientOriginalName();
                // Mendapatkan nama file tanpa ekstensi
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Mendapatkan ekstensi file
                $extension = $request->file('img_pengumuman')->getClientOriginalExtension();
                // Nama file yang akan disimpan
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                // Simpan file gambar ke folder public/img
                $imgPath = $request->file('img_pengumuman')->storeAs('public/images', $fileNameToStore);
                // Ubah path menjadi URL
                $imgPath = 'images/' . $fileNameToStore;
            }

            // Memperbarui data pengumuman
            $pengumuman->update([
                'judul_pengumuman' => $request->judul_pengumuman,
                'isi_pengumuman' => $request->isi_pengumuman,
                'tanggal_pengumuman' => $request->tanggal_pengumuman,
                'waktu_pengumuman' => $request->waktu_pengumuman,
                'penulis' => $request->penulis,
                'kategori_pengumuman' => $request->kategori_pengumuman,
                'file_pengumuman' => $filePath,
                'img_pengumuman' => $imgPath,
                'id_user' => $request->id_user
            ]);

            session()->flash('success', 'Pengumuman berhasil diperbarui.');
            return redirect()->route('pengumumans.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memperbarui pengumuman: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }




    public function destroy($id)
    {
        $pengumuman = Pengumuman::find($id);
        if ($pengumuman->file_pengumuman) {
            Storage::disk('public')->delete($pengumuman->file_pengumuman);
        }
        $pengumuman->delete();

        return redirect()->route('pengumumans.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
