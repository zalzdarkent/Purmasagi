<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $courses = Course::all();
        // $kegiatan = Kegiatan::all(); 

        $latestCourses = Course::orderBy('created_at', 'desc')->limit(3)->get();
        $latestActivity = Kegiatan::orderBy('created_at', 'desc')->limit(3)->get();
    
        return view('client.pages.home', compact('latestCourses', 'latestActivity'));

    }
}
