@extends('admin.layouts.app')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Button to Open the Modal -->
        <div class="d-flex justify-content-start mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addContentModal">
                Tambah Data
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Content List</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Pertemuan</th>
                            <th>Title</th>
                            <th>Video</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($contents->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">No data available</td>
                            </tr>
                        @else
                            @foreach ($contents as $content)
                                <tr>
                                    <td>
                                        <strong>{{ $content->pertemuan }}</strong>
                                    </td>
                                    <td>{{ $content->course->judul }}</td> <!-- Menampilkan judul kursus -->
                                    <td>
                                        <!-- Ikon Play -->
                                        <button class="btn btn-link text-primary" data-toggle="modal"
                                            data-target="#videoModal{{ $content->id }}">
                                            <i class="menu-icon tf-icons bx bx-play-circle"></i> Play
                                        </button>
                                    </td>
                                    <td>{{ $content->course->deskripsi }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm me-2 btn-edit"
                                            data-id="{{ $content->id }}" data-course-id="{{ $content->course->id }}"
                                            data-pertemuan="{{ $content->pertemuan }}" data-video="{{ $content->video }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>


                                        <!-- Tombol Hapus -->
                                        <form id="delete-form-{{ $content->id }}"
                                            action="{{ route('content.destroy', $content->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete('{{ $content->id }}')">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal untuk menampilkan video -->
    @foreach ($contents as $content)
        <div class="modal fade" id="videoModal{{ $content->id }}" tabindex="-1" role="dialog"
            aria-labelledby="videoModalLabel{{ $content->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="videoModalLabel{{ $content->id }}">{{ $content->pertemuan }} - Video
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <video width="100%" controls>
                            <source src="{{ asset('storage/' . $content->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    @endforeach



    <!-- Modal for Adding Course -->
    <div class="modal fade" id="addContentModal" tabindex="-1" aria-labelledby="addContentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContentModalLabel">Add Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('content.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-course">Course <span
                                    style="color: red">*</span></label>
                            <select name="course_id" class="form-select" id="basic-default-course" required>
                                <option value="">Select a course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->judul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-pertemuan">Pertemuan <span
                                    style="color: red">*</span></label>
                            <input type="text" name="pertemuan" class="form-control" id="basic-default-pertemuan"
                                placeholder="Type your meeting title" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="video">Video <span style="color: red">*</span></label>
                            <input type="file" name="video" class="form-control" id="video" accept="video/*"
                                required />
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

    <!-- Modal for Editing Course -->
    <div class="modal fade" id="editContentModal" tabindex="-1" aria-labelledby="editContentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editContentModalLabel">Edit Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="editContentForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" for="edit-course-id">Course <span
                                    style="color: red">*</span></label>
                            <select name="course_id" class="form-select" id="edit-course-id" required>
                                <option value="">Select a course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->judul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit-pertemuan">Pertemuan <span
                                    style="color: red">*</span></label>
                            <input type="text" name="pertemuan" class="form-control" id="edit-pertemuan"
                                placeholder="Type your meeting title" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit-video">Video Konten (URL atau Upload) <span
                                    style="color: red">*</span></label>
                            <input type="url" name="video_url" class="form-control" id="edit-video"
                                placeholder="Paste video URL" />
                            <input type="file" name="video_file" class="form-control mt-2" id="edit-video-file"
                                accept="video/*" />
                        </div>
                        <input type="hidden" name="content_id" id="edit-content-id" />
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Hentikan video saat modal ditutup
            $('.modal').on('hide.bs.modal', function() {
                console.log('Modal ditutup, menghentikan video.'); // Debug log
                $(this).find('video')[0].pause(); // Hentikan video
                $(this).find('video')[0].currentTime = 0; // Reset waktu video ke awal
            });
        });

        const videoInput = document.getElementById('video');
        const videoError = document.getElementById('videoError');
        const saveButton = document.getElementById('saveButton');

        videoInput.addEventListener('change', function() {
            const file = videoInput.files[0];

            if (file) {
                const fileExtension = file.name.split('.').pop().toLowerCase();
                if (fileExtension !== 'mp4') {
                    videoError.style.display = 'block'; // Tampilkan pesan error
                    saveButton.disabled = true; // Nonaktifkan tombol Save
                } else {
                    videoError.style.display = 'none'; // Sembunyikan pesan error
                    saveButton.disabled = false; // Aktifkan tombol Save
                }
            } else {
                videoError.style.display = 'none'; // Sembunyikan pesan error jika tidak ada file
                saveButton.disabled = false; // Pastikan tombol Save aktif
            }
        });

        // Script untuk mengisi modal edit
        $(document).ready(function() {
            // Hentikan video saat modal ditutup
            $('.modal').on('hide.bs.modal', function() {
                $(this).find('video')[0].pause(); // Hentikan video
                $(this).find('video')[0].currentTime = 0; // Reset waktu video ke awal
            });

            // Script untuk mengisi modal edit
            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', function() {
                    const contentId = this.getAttribute('data-id');
                    const courseId = this.getAttribute('data-course-id'); // Ambil data-course-id
                    const meetingTitle = this.getAttribute('data-pertemuan');
                    const video = this.getAttribute(
                    'data-video'); // Jika diperlukan untuk ditampilkan

                    // Ganti URL pada action form edit
                    const form = document.getElementById('editContentForm');
                    form.action = form.action.replace(':id',
                    contentId); // Pastikan action form mengarah ke content yang benar

                    // Mengisi field modal dengan data konten
                    document.getElementById('edit-course-id').value = courseId; // Mengisi course_id
                    document.getElementById('edit-pertemuan').value =
                    meetingTitle; // Mengisi pertemuan
                    document.getElementById('edit-video').value =
                    video; // Mengisi video URL, jika diperlukan

                    // Tampilkan modal
                    var editModal = new bootstrap.Modal(document.getElementById(
                    'editContentModal'));
                    editModal.show();
                });
            });
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
