<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function showRegistrationForm()
    {
        return view('client.pages.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:siswa',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            $siswa = Siswa::create([
                'nama' => $request->nama,
                'kelas' => $request->kelas,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::guard('siswa')->login($siswa);
            return redirect()->to('/')->with('success', 'Registrasi berhasil, selamat datang!');
        } catch (\Exception $e) {
            return back()->withErrors(['register' => 'Terjadi kesalahan, silakan coba lagi.']);
        }
    }

    public function showLoginForm()
    {
        return view('client.pages.login');
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
            return redirect()->to('/')->with('success', 'Login berhasil!'); // Ganti '/' dengan route yang sesuai jika diperlukan
        }

        // Jika gagal, kembali ke halaman login dengan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }


    public function logout()
    {
        Auth::guard('siswa')->logout();
        return redirect('/')->with('success', 'Anda telah logout.');
    }

    public function index()
    {
        $siswas = Siswa::paginate(10);
        return view('admin.siswa.index', compact('siswas'));
    }

    public function destroy(string $id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data berhasil dihapus!');
    }

    // Profile
    public function showProfile()
    {
        $siswa = Auth::guard('siswa')->user();
        return view('client.pages.profile', compact('siswa'));
    }

    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'nullable|string|max:255',
            'kelas' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:siswa,email,' . Auth::guard('siswa')->id(),
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $siswa = Auth::guard('siswa')->user();

        // Cek apakah user ditemukan
        if (!$siswa) {
            return redirect()->route('login')->withErrors(['update' => 'User tidak ditemukan.']);
        }

        try {
            $siswa->nama = $request->nama;
            $siswa->kelas = $request->kelas;
            $siswa->email = $request->email;

            if ($request->filled('password')) {
                $siswa->password = Hash::make($request->password);
            }

            $siswa->save();

            return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withErrors(['update' => 'Terjadi kesalahan, silakan coba lagi.']);
        }
    }

    public function absensiSiswa(Request $request)
    {
        if (!auth()->guard('siswa')->check()) {
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
        }

        $validated = $request->validate([
            'id_siswa' => 'required|exists:siswa,id',
            'id_guru' => 'required|exists:admin,id',
            'id_course' => 'required|exists:courses,id',
            'id_content' => 'required|exists:contents,id',
            'status' => 'required|in:hadir,izin,sakit',
            'keterangan' => [
                Rule::requiredIf(fn() => in_array($request->status, ['izin', 'sakit'])),
                'string',
                'max:255',
                'nullable'
            ],
            'foto_absensi' => 'required|image|max:2048',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        try {
            if ($validated['id_siswa'] != auth()->guard('siswa')->id()) {
                return redirect()->back()->withErrors(['error' => 'Unauthorized action.']);
            }

            // dd([
            //     'request_all' => $request->all(),
            //     'files' => $request->allFiles(),
            //     'auth_id' => auth()->guard('siswa')->id(),
            //     'is_file_present' => $request->hasFile('foto_absensi'),
            // ]);

            $existingAbsensi = Absensi::where([
                'id_siswa' => $validated['id_siswa'],
                'id_guru' => $validated['id_guru'],
                'id_course' => $validated['id_course'],
                'id_content' => $validated['id_content'],
            ])->first();

            if ($existingAbsensi) {
                return redirect()->back()->withErrors(['error' => 'Anda sudah melakukan absensi untuk pertemuan ini.']);
            }

            if ($validated['status'] === 'hadir') {
                $validated['keterangan'] = null;
            }

            // Handle file upload
            if ($request->hasFile('foto_absensi')) {
                $path = $request->file('foto_absensi')->store('absensi', 'public');
                $validated['foto_absensi'] = $path;
            }

            Absensi::create($validated);

            return redirect()->back()->with('success', 'Absensi berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan absensi.']);
        }
    }

    public function daftarAbsenSiswa()
    {
        $adminId = auth()->id();
        $siswa = Auth::guard('siswa')->user();
        $absensi = \App\Models\Absensi::where('id_guru', $adminId)->get();
        return view('admin.siswa.absensi', compact('absensi'));
    }

    public function detailAbsensi($id)
    {
        $absensi = Absensi::find($id);
        if (!$absensi) {
            return redirect()->back()->withErrors(['error' => 'Data absensi tidak ditemukan.']);
        }

        return view('admin.siswa.detail-absensi', compact('absensi'));
    }
}
