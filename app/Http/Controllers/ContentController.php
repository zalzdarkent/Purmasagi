<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all(); // Ambil semua kursus
        $contents = Content::with('course')->get(); // Ambil semua konten dengan relasi kursus

        return view('admin.content.index', compact('courses', 'contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all(); // Ambil semua kursus
        $contents = Content::with('course')->get(); // Ambil semua konten dengan relasi kursus

        return view('admin.content.index', compact('courses', 'contents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        // Validasi input
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'pertemuan' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4,avi,mov|max:20480',
        ]);

        // Menggunakan metode store untuk mengupload video
        $videoPath = $request->file('video')->store('videos', 'public');

        // Membuat instance model dan menyimpan data
        $data = new Content();
        $data->course_id = $request->course_id;
        $data->pertemuan = $request->pertemuan;
        $data->video = $videoPath; // Simpan path yang benar
        $data->save();

        // Redirect atau mengembalikan response
        return redirect()->route('content.index')->with('success', 'Data berhasil disimpan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
