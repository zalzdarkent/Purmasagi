<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    // Metode untuk menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('siswa.register'); // Pastikan ada view 'siswa/register.blade.php'
    }

    // Metode untuk registrasi siswa
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:siswa',
            'password' => 'required|string|min:8|confirmed', // Konfirmasi password
        ]);

        // Buat siswa baru
        $siswa = Siswa::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
        ]);

        // Login otomatis setelah registrasi (opsional)
        Auth::guard('siswa')->login($siswa);

        // Redirect ke halaman dashboard siswa atau halaman lain
        return redirect()->route('siswa.dashboard')->with('success', 'Registrasi berhasil, selamat datang!');
    }

    // Metode untuk menampilkan form login
    public function showLoginForm()
    {
        return view('siswa.login'); // Pastikan ada view 'siswa/login.blade.php'
    }

    // Metode untuk login siswa
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Coba autentikasi menggunakan guard siswa
        if (Auth::guard('siswa')->attempt($credentials, $request->filled('remember'))) {
            // Jika sukses, redirect ke halaman beranda
            return redirect()->intended('/')->with('success', 'Login berhasil!'); // Ganti '/' dengan route yang sesuai jika diperlukan
        }

        // Jika gagal, kembali ke halaman login dengan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }


    // Metode untuk logout siswa
    public function logout()
    {
        Auth::guard('siswa')->logout();
        return redirect('/')->with('success', 'Anda telah logout.');
    }
}
