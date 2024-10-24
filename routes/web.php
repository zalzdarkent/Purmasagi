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
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/courses', [CoursesController::class, 'indexCoursesClient'])->name('courses.client');
Route::get('/course/{id}', [CoursesController::class, 'show'])->name('courses.show');

Route::get('/activities', [KegiatanController::class, 'indexActivitiesClient'])->name('activities');
Route::get('/teachers', [AdminController::class, 'indexForClient'])->name('teachers');

Route::get('/register', [SiswaController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [SiswaController::class, 'register'])->name('register');

Route::get('/login', [SiswaController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [SiswaController::class, 'login'])->name('login');

Route::post('/logout', [SiswaController::class, 'logout'])->name('logout');

Route::middleware('auth:siswa')->group(function () {
    Route::get('/profile', [SiswaController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [SiswaController::class, 'updateProfile'])->name('profile.update');
});

// temporary route
// Route::get('/teachers', function () {
//     return view('client.pages.teachers');
// })->name('teachers');

// Route untuk halaman login admin
Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Route yang memerlukan login admin
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard'); // Mengarahkan ke dashboard jika sudah login
    Route::resource('course', CoursesController::class); // Akses ke resource courses
    Route::resource('content', ContentController::class);
    Route::post('/content/delete-file', [ContentController::class, 'deleteFile'])->name('content.delete-file');
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('logo', LogoController::class);
    Route::post('profile/update', [AdminController::class, 'updateProfile'])->name('update.profile');
    Route::get('profile/edit', [AdminController::class, 'editProfile'])->name('edit.profile');
    Route::get('daftar-guru', [AdminController::class, 'index'])->name('guru.index');
    Route::get('tambah-guru', [AdminController::class, 'create'])->name('guru.create');
    Route::post('store-guru', [AdminController::class, 'store'])->name('guru.store');
    Route::get('daftar-siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::delete('hapus-guru/{id}', [AdminController::class, 'destroy'])->name('guru.destroy');
    Route::delete('hapus-siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
});
