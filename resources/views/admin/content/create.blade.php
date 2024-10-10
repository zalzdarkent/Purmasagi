@extends('admin.layouts.app')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Tambah Konten</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('content.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-course">Course <span style="color: red">*</span></label>
                            <select name="course_id" class="form-select" id="basic-default-course" required>
                                <option value="">Select a course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->judul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-pertemuan">Pertemuan <span style="color: red">*</span></label>
                            <input type="text" name="pertemuan" class="form-control" id="basic-default-pertemuan"
                                placeholder="Type your meeting title" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="desc">Deskripsi <span style="color: red">*</span></label>
                            <textarea name="deskripsi_konten" id="desc" class="form-control" cols="30" rows="5"
                                placeholder="Type your course description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="video">Video <span style="color: red">*</span></label>
                            <input type="file" name="video" class="form-control" id="video" accept="video/*" required />
                            <div id="videoError" class="text-danger" style="display: none;">Please upload a .mp4 file
                                only.
                            </div> <!-- Pesan error -->
                        </div>
                        <button type="submit" class="btn btn-primary" id="saveButton">Save</button> <!-- Tombol Save -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
