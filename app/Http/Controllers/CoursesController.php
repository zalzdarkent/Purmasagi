<?php

namespace App\Http\Controllers;

use App\Models\Content;
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

    public function indexCoursesClient()
    {
        // $courses = Course::all();
        $courses = Course::paginate(3);
        return view('client.pages.courses', compact('courses'));
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
        // Validasi input, termasuk thumbnail
        $validasi = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10048', // Validasi file gambar
        ]);

        // Proses untuk menyimpan file gambar
        if ($request->hasFile('thumbnail')) {
            // Ambil file gambar
            $file = $request->file('thumbnail');
            $fileName = $file->hashName(); // Menggunakan hash untuk nama file yang unik

            // Simpan file ke dalam folder 'public/thumbnails'
            $file->storeAs('public/thumbnails', $fileName); // Menggunakan Storage facade untuk menyimpan

            // Buat entri data course dengan thumbnail
            Course::create([
                'judul' => $validasi['judul'],
                'deskripsi' => $validasi['deskripsi'],
                'thumbnail' => 'thumbnails/' . $fileName, // Simpan path thumbnail
            ]);

            return redirect()->route('course.index')->with('success', 'Course has been saved');
        } else {
            return redirect()->route('course.index')->with('error', 'Thumbnail is required');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $course = Course::with('contents')->findOrFail($id);
        // return view('client.pages.detail', compact('course'));

        $course = Course::findOrFail($id);
        $contents = Content::where('course_id', $course->id)->get();

        return view('client.pages.detail', compact('course', 'contents'));

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
        // Validate input
        $validasi = $request->validate([
            'judul' => 'required|sometimes|max:255',
            'deskripsi' => 'required|sometimes|max:255',
            'thumbnail' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);

        // Find the course by ID
        $course = Course::findOrFail($id);

        // Store the old thumbnail path
        $oldThumbnailPath = $course->thumbnail;

        // Update course data (without thumbnail first)
        $course->update([
            'judul' => $validasi['judul'],
            'deskripsi' => $validasi['deskripsi']
        ]);

        // Check if a new thumbnail was uploaded
        if ($request->hasFile('thumbnail')) {
            // Process the new thumbnail
            $file = $request->file('thumbnail');
            $fileName = $file->hashName(); // Create a unique file name

            // Save the new file to 'public/thumbnails'
            $file->storeAs('public/thumbnails', $fileName); // Using Storage facade to save

            // Update the thumbnail path in the course record
            $course->update(['thumbnail' => 'thumbnails/' . $fileName]);

            // Delete the old thumbnail file if it exists
            if ($oldThumbnailPath) {
                $oldFilePath = storage_path('app/public/' . $oldThumbnailPath);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Delete the old thumbnail file
                }
            }
        }

        // Redirect back with success message
        return redirect()->route('course.index')->with('success', 'Course has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);

        if ($course) {
            // Hapus thumbnail dari storage jika ada
            if ($course->thumbnail) {
                $thumbnailPath = public_path('storage/' . $course->thumbnail); // Sesuaikan dengan lokasi penyimpanan thumbnail
                if (file_exists($thumbnailPath)) {
                    unlink($thumbnailPath); // Hapus file thumbnail
                }
            }

            $course->delete(); // Hapus kursus dari database

            return redirect()->back()->with('success', 'Course deleted successfully!');
        }

        return redirect()->back()->with('error', 'Course not found.');
    }
}
