<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        return view('admin.content.create', compact('courses', 'contents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'pertemuan' => 'required|string|max:255',
            'deskripsi_konten' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4,avi,mov|max:20480',
        ]);

        // Menggunakan metode store untuk mengupload video
        $videoPath = $request->file('video')->store('videos', 'public');

        // Membuat instance model dan menyimpan data
        $data = new Content();
        $data->course_id = $request->course_id;
        $data->pertemuan = $request->pertemuan;
        $data->deskripsi_konten = $request->deskripsi_konten;
        $data->video = $videoPath; // Simpan path yang benar
        $data->save();
        // dd($request->all());

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
        $content = Content::with('course')->find($id); // Ambil konten dengan
        $courses = Course::all(); // Ambil semua kursus
        return view('admin.content.edit', compact('content', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'pertemuan' => 'required|string|max:255',
            'deskripsi_konten' => 'required|string|max:255',
            'video' => 'nullable|file|mimes:mp4,avi,mov|max:20480', // Video adalah optional
        ]);

        // Ambil konten yang ada
        $content = Content::findOrFail($id);

        // Perbarui atribut yang diterima
        $content->course_id = $request->course_id;
        $content->pertemuan = $request->pertemuan;
        $content->deskripsi_konten = $request->deskripsi_konten;

        // Cek jika ada video baru yang diunggah
        if ($request->hasFile('video')) {
            // Hapus video lama
            if ($content->video) {
                Storage::disk('public')->delete($content->video); // Hapus file lama
            }

            // Simpan video baru
            $videoPath = $request->file('video')->store('videos', 'public');
            $content->video = $videoPath; // Simpan path video baru
        }

        // Simpan perubahan ke database
        $content->save();

        // Redirect atau mengembalikan response
        return redirect()->route('content.index')->with('success', 'Data berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ambil konten yang ada
        $content = Content::findOrFail($id);

        // Hapus video jika ada
        if ($content->video) {
            Storage::disk('public')->delete($content->video); // Hapus file video dari penyimpanan
        }

        // Hapus konten dari database
        $content->delete();

        // Redirect atau mengembalikan response
        return redirect()->route('content.index')->with('success', 'Data berhasil dihapus!');
    }
}
