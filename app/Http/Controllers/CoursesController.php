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
        $adminId = auth()->id();

        $courses = Course::where('admin_id', $adminId)->paginate(3);

        return view('admin.course.index', compact('courses'));
    }

    public function indexCoursesClient()
    {
        // $courses = Course::all();
        $courses = Course::paginate(6);
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
            $fileName = $file->getClientOriginalName(); // Mengambil nama asli file yang diupload

            // Simpan file ke dalam folder 'public/thumbnails'
            $file->storeAs('public/thumbnails', $fileName); // Menggunakan Storage facade untuk menyimpan

            // Buat entri data course dengan thumbnail dan admin_id
            Course::create([
                'admin_id' => auth()->id(), // Menyimpan ID admin yang sedang login
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
        // Validasi input
        $validasi = $request->validate([
            'judul' => 'required|sometimes|max:255',
            'deskripsi' => 'required|sometimes|max:255',
            'thumbnail' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);

        // Cari course berdasarkan ID
        $course = Course::findOrFail($id);

        // Simpan path thumbnail lama
        $oldThumbnailPath = $course->thumbnail;

        // Update data course (tanpa thumbnail terlebih dahulu)
        $course->update([
            'judul' => $validasi['judul'],
            'deskripsi' => $validasi['deskripsi']
        ]);

        // Periksa jika ada thumbnail baru yang diunggah
        if ($request->hasFile('thumbnail')) {
            // Ambil file thumbnail baru
            $file = $request->file('thumbnail');
            $fileName = $file->getClientOriginalName(); // Mengambil nama file asli

            // Simpan file baru ke folder 'public/thumbnails'
            $file->storeAs('public/thumbnails', $fileName); // Menggunakan Storage facade untuk menyimpan

            // Update path thumbnail pada data course
            $course->update(['thumbnail' => 'thumbnails/' . $fileName]);

            // Hapus file thumbnail lama jika ada
            if ($oldThumbnailPath) {
                $oldFilePath = storage_path('app/public/' . $oldThumbnailPath);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Hapus file thumbnail lama
                }
            }
        }

        // Redirect kembali dengan pesan sukses
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
