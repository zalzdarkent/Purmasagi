<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.course.index', compact('courses'));

    }

    public function indexHomeClient()
    {
        $courses = Course::orderBy('created_at', 'desc')->limit(3)->get();     
        return view('client.pages.home')->with('courses', $courses);
    }

    public function indexCoursesClient()
    {
        $courses = Course::all();
        return view('client.pages.courses')->with('courses', $courses);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('admin.course.index', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required|max:255',
        ]);

        // dd($request->all()); 

        Course::create([
            'judul' => $validasi['judul'],
            'deskripsi' => $validasi['deskripsi']
        ]);
        return redirect()->route('course.index')->with('success', 'Course has been saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);
        return view('client.pages.detail', compact('course'));


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
        $validasi = $request->validate([
            'judul' => 'required|sometimes|max:255',
            'deskripsi' => 'required|sometimes|max:255',
        ]);

        // Mencari kursus berdasarkan ID
        $course = Course::findOrFail($id);

        // Memperbarui data kursus
        $course->update([
            'judul' => $validasi['judul'],
            'deskripsi' => $validasi['deskripsi']
        ]);

        // Mengalihkan pengguna kembali ke daftar kursus dengan pesan sukses
        return redirect()->route('course.index')->with('success', 'Course has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'Course deleted successfully!');
        }
        return redirect()->back()->with('error', 'Course not found.');
    }
}
