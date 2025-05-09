<?php

use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LogoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\SiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Client Route
Route::group(['prefix' => '/', 'as' => 'client.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/courses', [CoursesController::class, 'indexCoursesClient'])->name('courses');
    Route::get('/activities', [KegiatanController::class, 'indexActivitiesClient'])->name('activities');
    Route::get('/teachers', [AdminController::class, 'indexForClient'])->name('teachers');

    // Authentication Routes
    Route::get('/register', [SiswaController::class, 'showRegistrationForm'])->name('register.form');
    Route::post('/register', [SiswaController::class, 'register'])->name('register');
    Route::get('/login/siswa', [SiswaController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login/siswa', [SiswaController::class, 'login'])->name('login');
    Route::post('/logout', [SiswaController::class, 'logout'])->name('logout');

    // Authenticated Routes
    Route::middleware('auth:siswa')->group(function () {
        Route::get('/course/{slug}', [CoursesController::class, 'show'])->name('courses.show');
        Route::get('/profile', [SiswaController::class, 'showProfile'])->name('profile');
        Route::post('/profile', [SiswaController::class, 'updateProfile'])->name('profile.update');
    });

    // Temporary Route
    Route::get('/login', function () {
        return view('client.pages.select-role');
    })->name('login.select');
});

// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // Authentication Routes
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Authenticated Admin Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('course', CoursesController::class);
        Route::resource('content', ContentController::class);
        Route::post('/content/delete-file', [ContentController::class, 'deleteFile'])->name('content.delete-file');
        Route::resource('kegiatan', KegiatanController::class);
        Route::resource('logo', LogoController::class);

        // Profile Routes
        Route::post('profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::get('profile/edit', [AdminController::class, 'editProfile'])->name('profile.edit');

        // Guru Routes
        Route::get('daftar-guru', [AdminController::class, 'index'])->name('guru.index');
        Route::get('tambah-guru', [AdminController::class, 'create'])->name('guru.create');
        Route::post('store-guru', [AdminController::class, 'store'])->name('guru.store');
        Route::delete('hapus-guru/{id}', [AdminController::class, 'destroy'])->name('guru.destroy');

        // Siswa Routes
        Route::get('daftar-siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::delete('hapus-siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

        // Absensi Routes
        Route::get('daftar-absen', [SiswaController::class, 'daftarAbsenSiswa'])->name('absen.index');
        Route::post('absen-siswa', [SiswaController::class, 'absensiSiswa'])->name('absen.store');
        Route::get('absen-siswa/{id}', [SiswaController::class, 'detailAbsensi'])->name('absen.show');
    });
});