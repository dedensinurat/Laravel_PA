<?php

namespace App\Http\Controllers\Auth;

use App\Models\UserWeb;
use Illuminate\Http\Request;
use App\Models\PasswordResetToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{

    public function FormResetLink(Request $request)
    {
        $request->validate(['username' => 'required', 'email' => 'required|email']);

        // Memeriksa apakah pengguna dengan username at email yang diberikan sudah terdaftar
        $user = UserWeb::where('username', $request->username)->where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['username' => 'Username not found. Please enter a valid username', 'email' => 'Email not found. Please enter a valid email']);
        }

        // Jika username at email terdaftar, kirim data ke view reset password
        return redirect()->route('form.reset.password', ['username' => $request->username, 'email' => $request->email]);
    }
}
