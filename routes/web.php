<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

// Rute untuk tampilan umum
Route::get('/', function () {
    return view('client.pages.home');
})->name('home');

Route::get('/courses', function () {
    return view('client.pages.courses');
})->name('courses');

Route::get('/teachers', function () {
    return view('client.pages.teachers');
})->name('teachers');

// Route::get('/course/{course_id}', function ($course_id) {
//     return view('client.pages.detail');
// })->name('detail');

// temporary route
Route::get('/', [CoursesController::class, 'indexHomeClient']);
Route::get('/courses', [CoursesController::class, 'indexCoursesClient']);
Route::get('/course/{id}', [CoursesController::class, 'show'])->name('courses.show');






// Rute untuk login umum
// Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('login', [LoginController::class, 'login']);
// Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk halaman login admin
Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Route yang memerlukan login admin
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard'); // Mengarahkan ke dashboard jika sudah login
    Route::resource('course', CoursesController::class); // Akses ke resource courses
    Route::resource('content', ContentController::class);
});