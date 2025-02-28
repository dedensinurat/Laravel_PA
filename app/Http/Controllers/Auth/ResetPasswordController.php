<?php

namespace App\Http\Controllers\Auth;

use App\Models\UserWeb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request)
    {
        // Mengambil email dari query string jika ada
        $email = $request->query('email');

        // Mengirimkan email ke view form reset password
        return view('auth.form_email_reset', compact('email'));
    }
    public function updatePassword(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Cari pengguna berdasarkan email
        $user = UserWeb::where('email', $request->email)->first();

        // Periksa apakah pengguna ditemukan
        if (!$user) {
            return back()->withErrors(['email' => 'Email not found. Please enter  a valid email address']);
        }

        // Update password pengguna dengan password yang baru di-hash
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect ke halaman login atau halaman beranda dengan pesan sukses
        return redirect()->route('form')->with('success', 'Password updated successfully.');
    }

    public function updatePasswordGuru(Request $request)
    {
        try {
            // Validasi data yang diterima dari form
            $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|email',
                'current_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $username = session('username');

            // Dapatkan pengguna saat ini berdasarkan email
            $user = UserWeb::where('username', $username)->first();

            // Periksa apakah password saat ini cocok
            if (!Hash::check($request->current_password, $user->password)) {
                // Jika password saat ini tidak cocok, kembalikan dengan pesan error
                session()->flash('error', 'Password saat ini salah.');
                return redirect()->back()->withInput();
            }

            // Update username dan password pengguna dengan data yang baru di-hash
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();

            // Redirect ke halaman beranda dengan pesan sukses
            session()->flash('success', 'Username dan password berhasil diperbarui.');
            return redirect()->route('guru.index');
        } catch (\Exception $e) {
            // Tangani kesalahan dan kembalikan dengan pesan error
            session()->flash('error', 'Terjadi kesalahan saat memperbarui username dan password: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function updatePasswordStaf(Request $request)
    {
        try {
            // Validasi data yang diterima dari form
            $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|email',
                'current_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $username = session('username');

            // Dapatkan pengguna saat ini berdasarkan email
            $user = UserWeb::where('username', $username)->first();

            // Periksa apakah password saat ini cocok
            if (!Hash::check($request->current_password, $user->password)) {
                // Jika password saat ini tidak cocok, kembalikan dengan pesan error
                session()->flash('error', 'Password saat ini salah.');
                return redirect()->back()->withInput();
            }

            // Update username dan password pengguna dengan data yang baru di-hash
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();

            // Redirect ke halaman beranda dengan pesan sukses
            session()->flash('success', 'Username dan password berhasil diperbarui.');
            return redirect()->route('guru.index');
        } catch (\Exception $e) {
            // Tangani kesalahan dan kembalikan dengan pesan error
            session()->flash('error', 'Terjadi kesalahan saat memperbarui username dan password: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
