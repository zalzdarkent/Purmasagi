@extends('admin.layouts.app')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Edit Konten</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('content.update', $content->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-course">Course <span
                                    style="color: red">*</span></label>
                            <select name="course_id" class="form-select" id="basic-default-course" required>
                                <option value="">Select a course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ $course->id == $content->course_id ? 'selected' : '' }}>
                                        {{ $course->judul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-pertemuan">Pertemuan <span
                                    style="color: red">*</span></label>
                            <input type="text" name="pertemuan" class="form-control" id="basic-default-pertemuan"
                                placeholder="Type your meeting title" value="{{ old('pertemuan', $content->pertemuan) }}"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="desc">Deskripsi <span style="color: red">*</span></label>
                            <textarea name="deskripsi_konten" id="desc" class="form-control" cols="30" rows="5"
                                placeholder="Type your course description" required>{{ old('deskripsi_konten', $content->deskripsi_konten) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="video">Video <span style="color: red">*</span></label>
                            <input type="file" name="video" class="form-control" id="video" accept="video/*" />
                            <div id="videoError" class="text-danger" style="display: none;">Please upload a .mp4 file only.
                            </div>
                            <!-- Pesan error -->
                            <p>Current video: <a href="{{ asset('storage/' . $content->video) }}" target="_blank">View
                                    Video</a></p> <!-- Tampilkan video saat ini -->
                        </div>
                        <button type="submit" class="btn btn-primary" id="saveButton">Update</button> <!-- Tombol Save -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('video').addEventListener('change', function() {
            const videoInput = this;
            const videoError = document.getElementById('videoError');
            const allowedExtensions = /(\.mp4|\.avi|\.mov)$/i; // Format yang diizinkan

            if (!allowedExtensions.exec(videoInput.value)) {
                videoError.style.display = 'block'; // Tampilkan pesan error
                videoInput.value = ''; // Reset input file
            } else {
                videoError.style.display = 'none'; // Sembunyikan pesan error jika format valid
            }
        });
    </script>
@endsection
