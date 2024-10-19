<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use App\Models\Siswa;
use App\Models\Course;
use App\Models\Content;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total kursus
        $courseCount = Course::count();

        // Menghitung total konten
        $contentCount = Content::count();

        // Menghitung total kegiatan
        $eventCount = Kegiatan::count();
        // Menghitung total guru (hanya untuk admin)
        $teacherCount = Admin::where('role', 'guru')->count();

        // Menghitung total siswa (guard siswa)
        $studentCount = Siswa::count();

        // Array berisi kata-kata penyemangat
        $motivationalQuotes = [
            'Keep inspiring your students with passion and creativity!',
            'Every small step you take makes a big impact on your students!',
            'Teaching is the profession that creates all other professions!',
            'You are shaping the future, one student at a time!',
            'Your hard work and dedication are making a difference!',
            'Believe in the power of your influence, you are making a huge impact!',
            'Thank you for being an amazing mentor and guide to your students!',
            'Your passion for teaching lights up the minds of your students!',
            'Keep pushing forward, you’re doing amazing work!',
            'You have the power to change lives every day!'
        ];

        // Ambil waktu saat ini dan bagi menjadi interval 6 jam
        $hour = Carbon::now()->hour;
        $quoteIndex = floor($hour / 6) % count($motivationalQuotes);

        // Pilih kata penyemangat berdasarkan waktu
        $randomQuote = $motivationalQuotes[$quoteIndex];

        // Kirim ke view
        return view('admin.layouts.dashboard', compact('courseCount', 'contentCount', 'eventCount', 'teacherCount', 'studentCount', 'randomQuote'));
    }
}
