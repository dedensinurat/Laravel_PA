<?php

namespace App\Http\Controllers;

use App\Models\UserWeb;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Mendapatkan semua model yang ada di direktori Models
        $models = collect(File::allFiles(app_path('Models')))
            ->map(function ($file) {
                return Str::replaceLast('.php', '', $file->getFilename());
            });

        // Menghitung jumlah baris data untuk setiap model
        $modelData = $models->map(function ($modelName) {
            $className = "App\\Models\\$modelName";
            $count = $className::count();
            return [
                'name' => $modelName,
                'count' => $count,
            ];
        });

        // Teruskan informasi jumlah baris data ke tampilan dashboard admin
        return view('user.admin_dashboard', compact('modelData'));
    }



    // Method untuk menampilkan halaman CRUD profil sekolah
    public function profilSekolah()
    {
        $profilSekolah = ProfilSekolah::first(); // Misalnya hanya mengambil data pertama
        return view('admin_contents.profil_sekolah.profil_sekolah', ['profilSekolah' => $profilSekolah]);
    }
    // Method untuk menampilkan halaman edit profil sekolah
    public function editProfilSekolah()
    {
        // Ambil data profil sekolah dari database
        $profilSekolah = ProfilSekolah::first();

        // Kirim data ke view edit profil sekolah
        return view('admin_contents.profil_sekolah.edit_profil_sekolah', compact('profilSekolah'));
    }


    public function UpdateProfilSekolah(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'alamat_sekolah' => 'required|string|max:255',
            'no_telepon_sekolah' => 'required|string|max:20',
            'email_sekolah' => 'required|string|email|max:255',
            'logo_sekolah' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Max file size 2MB
            'visi_sekolah' => 'required|string',
            'misi_sekolah' => 'required|string',
            'sambutan_kepsek' => 'required|string',
        ], [
            'logo_sekolah.image' => 'The logo sekolah must be an image.',
            'logo_sekolah.mimes' => 'The logo sekolah must be a file of type: jpeg, png, jpg, gif.',
        ]);

        // Cari profil sekolah berdasarkan ID
        $profilSekolah = ProfilSekolah::findOrFail($id);

        // Handle file upload for logo_sekolah
        if ($request->hasFile('logo_sekolah')) {
            // Validasi bahwa file yang diunggah adalah gambar
            $validatedData = $request->validate([
                'logo_sekolah' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // tambahkan validasi untuk tipe dan ukuran gambar
            ]);

            // Mendapatkan nama file dengan ekstensi
            $fileNameWithExt = $request->file('logo_sekolah')->getClientOriginalName();
            // Mendapatkan nama file tanpa ekstensi
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Mendapatkan ekstensi file
            $extension = $request->file('logo_sekolah')->getClientOriginalExtension();
            // Nama file yang akan disimpan
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Simpan file gambar ke folder public/img
            $path = $request->file('logo_sekolah')->storeAs('public/images', $fileNameToStore);
            // Ubah path menjadi URL
            $validatedData['logo_sekolah'] = 'images/' . $fileNameToStore;

            // Hapus logo lama jika ada
            if ($profilSekolah->logo_sekolah) {
                Storage::delete('public/logo_sekolah/' . $profilSekolah->logo_sekolah);
            }
        }

        // Update data profil sekolah
        $profilSekolah->update($validatedData);

        // Jika update berhasil        
        Session::flash('success', 'Profil sekolah berhasil diperbarui.');

        // Redirect dengan pesan sukses
        return redirect()->route('admin.profile.sekolah');
    }
}
