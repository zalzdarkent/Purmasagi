<?php

use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LogoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AdminController;

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

// Client Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Client Courses
Route::get('/courses', [CoursesController::class, 'indexCoursesClient'])->name('courses.client');
Route::get('/course/{id}', [CoursesController::class, 'show'])->name('courses.show');

// temporary route
Route::get('/login', function () {
    return view('client.pages.login');
})->name('siswa.login.form');
Route::get('/register', function () {
    return view('client.pages.register');
})->name('siswa.register.form');

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
});