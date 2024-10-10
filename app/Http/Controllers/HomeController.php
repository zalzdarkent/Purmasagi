<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua data courses dari database
        $courses = Course::all();
        return view('client.pages.home', compact('courses'));
    }
}
