<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Proses login admin
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Periksa apakah checkbox "remember me" dicentang
        $remember = $request->has('remember-me');

        // Cek apakah email ada di database
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            // Jika email tidak ditemukan
            return back()->withErrors([
                'email' => 'The email address is not registered.',
            ])->withInput($request->except('password'));
        }

        // Cek apakah password sesuai dengan email yang ada
        if (!Auth::guard('admin')->attempt($credentials, $remember)) {
            // Jika password salah
            return back()->withErrors([
                'password' => 'The password is incorrect.',
            ])->withInput($request->except('password'));
        }

        // Redirect ke dashboard admin jika login berhasil
        return redirect()->intended(route('admin.dashboard'));
    }


    // Logout admin
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function updateProfile(Request $request)
    {
        // Pastikan admin terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu.');
        }

        $admin = Auth::user(); // Mendapatkan admin yang sedang terautentikasi

        // Pastikan objek admin adalah instance dari Admin
        if (!$admin instanceof Admin) {
            return redirect()->back()->with('error', 'Admin tidak valid.');
        }

        // Validasi data yang masuk
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admin,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed', // Menggunakan nullable agar password tidak wajib diubah
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048', // Sesuaikan ukuran jika perlu
        ]);

        // Perbarui nama dan email admin
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Jika password baru diberikan, hash dan set
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // Menangani unggahan file untuk foto profil
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($admin->foto_profil) {
                Storage::disk('public')->delete($admin->foto_profil);
            }

            // Simpan foto profil dengan nama asli
            $file = $request->file('foto_profil');
            $filename = $file->getClientOriginalName(); // Mengambil nama file asli
            $path = $file->storeAs('profile_pictures', $filename, 'public'); // Menyimpan dengan nama asli
            $admin->foto_profil = $path; // Menyimpan jalur file di database
        }

        // Simpan perubahan
        $admin->save(); // Memastikan ini dipanggil pada instansi Admin

        // Kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function editProfile()
    {
        $admin = Auth::user(); // Mendapatkan admin yang sedang terautentikasi

        // Pastikan admin terautentikasi
        if (!$admin) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu.');
        }

        return view('admin.profile.edit', compact('admin'));
    }
}
