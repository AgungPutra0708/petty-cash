<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Mencari pengguna berdasarkan email
            $user = User::where('email', $request->email)->first();

            // Memeriksa apakah pengguna ada dan password cocok
            if ($user && Hash::check($request->password, $user->password)) {
                // Jika password cocok, login pengguna
                Auth::login($user);
                
                return redirect()->route('dashboard.index');
            }
            // Jika autentikasi gagal
            return redirect()->back()->with('error', 'Login gagal, coba lagi');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan, silakan coba lagi!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Menghapus semua session
        $request->session()->invalidate();

        // Regenerasi token untuk mencegah serangan CSRF
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
