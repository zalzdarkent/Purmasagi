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

        // Coba autentikasi admin
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            // Redirect ke dashboard admin jika login berhasil
            return redirect()->intended(route('admin.dashboard'));
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password')); // Jaga input email agar tidak hilang
    }

    // Logout admin
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
