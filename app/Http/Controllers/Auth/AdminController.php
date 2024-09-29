<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $admin = \App\Models\Admin::where('email', $request->email)->first();

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
}
