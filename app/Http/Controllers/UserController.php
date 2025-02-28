<?php

namespace App\Http\Controllers;

use App\Models\UserWeb;
use App\Models\KegiatanSiswa;
use App\Models\Pengumuman;
use App\Models\Prestasi; // Pastikan model ini ada
use App\Models\ProfilSekolah;
use App\Models\Sejarah;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Fetch the first record from ProfilSekolah
        $profilSekolah = ProfilSekolah::first();
        $sejarah = Sejarah::all();
        $fasilitas = Fasilitas::all();
        $kegiatanSiswa = KegiatanSiswa::all();


        // Pass the single model instance to the view
        return view('user_contents.beranda', compact('profilSekolah', 'fasilitas', 'kegiatanSiswa', 'sejarah'));
    }


    public function index_kegiatan_siswa()
    {
        $kegiatan = KegiatanSiswa::all();

        return view('user_contents.kegiatan_siswa', compact('kegiatan'));
    }

    public function index_profile_sekolah()
    {
        $profileSekola = ProfilSekolah::all();

        return view('user_contents.profile_sekolah', compact('profileSekola'));
    }

    public function index_prestasi_siswa()
    {
        // Ambil semua data prestasi siswa
        $prestasi = Prestasi::all();

        // Kirim data ke tampilan
        return view('user_contents.prestasi_siswa', compact('prestasi'));
    }
    public function index_pengumuman_siswa()
    {
        // Ambil semua data prestasi siswa
        $Pengumuman = Pengumuman::all();

        // Kirim data ke tampilan
        return view('user_contents.pengumuman_siswa', compact('Pengumuman'));
    }

    public function index_inbox_user()
    {
        // Logika untuk menampilkan halaman Inbox User
        return view('user_contents.inbox_pengguna');
    }



    public function index_sejarah_siswa()
    {
        $sejarah = Sejarah::all();

        return view('user_contents.sejarah_siswa', compact('sejarah'));
    }
    public function index_visi_misi()
    {
        $visimisi = ProfilSekolah::all();

        return view('user_contents.visi_misi_sekolah', compact('visimisi'));
    }

    public function index_fasilitas_siswa()
    {
        $fasilitas = Fasilitas::all();

        return view('user_contents.fasilitas_siswa', compact('fasilitas'));
    }




    public function logout()
    {
        Auth::logout(); // logout user
        session()->flush(); // clear all session data

        return redirect()->route('form')->with('success', 'You have been logged out.'); // redirect to login page with success message
    }

    public function validasi(Request $request)
    {
        // Validation rules
        $rules = [
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required',
        ];
        // Custom error messages
        $messages = ['username.required' => 'Username is required.',    'username.string' => 'Username must be a string.',    'username.max' => 'Username may not be greater than 255 characters.',    'email.required' => 'Email is required.',    'email.email' => 'Invalid email format.',    'password.required' => 'Password is required.',];

        // Validate the request data
        $validatedData = $request->validate($rules, $messages);

        // Normalize the username (remove extra spaces, convert to lowercase, etc.)
        $normalizedUsername = strtolower(trim($validatedData['username']));

        // Find the user by username
        $pengguna = UserWeb::where('username', $normalizedUsername)->first();

        // Check if the user exists
        if (!$pengguna) {
            // If user doesn't exist, redirect back with error
            session()->flash('error', 'Invalid username. Please provide correct username.');
            return redirect()->route('form')->withInput();
        }

        // Check if the provided email matches the user's email
        if ($pengguna->email !== $validatedData['email']) {
            // If email doesn't match, redirect back with error
            session()->flash('error', 'Invalid email. Please provide correct email address.');
            return redirect()->route('form')->withInput();
        }

        // Check if the provided password matches the user's password
        if (!password_verify($validatedData['password'], $pengguna->password)) {
            // If password doesn't match, redirect back with error
            session()->flash('error', 'Invalid password.');
            return redirect()->route('form')->withInput();
        }

        // Update last_login field with current timestamp
        $pengguna->update(['last_login' => now()]);

        // Get the role of the user from the model
        $role = $pengguna->role;

        // Simpan id_user dan role ke dalam session
        session([
            'is_logged_in' => true,
            'id_user' => $pengguna->id_user,
            'username' => $normalizedUsername,
            'email' => $pengguna->email,
            'role' => $role
        ]);

        // Redirect to different routes based on the role
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.home')->with('success', 'Login berhasil.');
            case 'guru':
                return redirect()->route('guru.index')->with('success', 'Login berhasil.');
            case 'staf':
                return redirect()->route('staf.index')->with('success', 'Login berhasil.');
            default:
                // If role is not recognized, redirect back with error
                return redirect()->route('form')->withErrors(['form' => 'Unknown role.'])->withInput();
        }
    }

    public function insertUser(Request $request)
    {
        // Tambahkan logika untuk menyimpan pengguna baru
    }

    // Halaman GuruDashboard
    public function GuruDashboard()
    {
        // Logika dashboard Anda di sini
        return view('user.guru_dashboard'); // Misalnya, mengembalikan tampilan admin.dashboard
    }
}
