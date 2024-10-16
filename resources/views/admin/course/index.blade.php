@extends('admin.layouts.app')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Button to Open the Modal -->
        <div class="d-flex justify-content-start mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCourseModal">
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
            <h5 class="card-header">Course List</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php
                            $hasCourses = false; // Flag untuk mengecek apakah ada kursus yang cocok
                        @endphp

                        @foreach ($courses as $course)
                            @if (Auth::user()->id == $course->admin_id)
                                @php
                                    $hasCourses = true; 
                                @endphp
                                <tr>
                                    <td>
                                        <!-- Menampilkan Thumbnail dengan ukuran 200x200 -->
                                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->judul }}"
                                            style="width: 100px">
                                    </td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $course->judul }}</strong>
                                    </td>
                                    <td>{!! \App\Helpers\TextHelpers::splitText($course->deskripsi, 40) !!}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm me-2 btn-edit"
                                            data-id="{{ $course->id }}" data-judul="{{ $course->judul }}"
                                            data-deskripsi="{{ $course->deskripsi }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <form id="delete-form-{{ $course->id }}"
                                            action="{{ route('course.destroy', $course->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete('{{ $course->id }}')">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        @if (!$hasCourses)
                            <tr>
                                <td colspan="4" class="text-center">No data available</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Course -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">Add Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('course.store') }}" method="post" enctype="multipart/form-data"
                        id="addCourseForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-judul">Judul <span
                                    style="color: red">*</span></label>
                            <input type="text" name="judul" class="form-control" id="basic-default-judul"
                                placeholder="Type your course title" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="desc">Deskripsi <span style="color: red">*</span></label>
                            <textarea name="deskripsi" id="desc" class="form-control" cols="30" rows="5"
                                placeholder="Type your course description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="thumbnail">Thumbnail <span style="color: red">*</span></label>
                            <input type="file" name="thumbnail" class="form-control" id="thumbnail" required
                                onchange="previewImage(event, 'add')" />
                        </div>
                        <div class="mb-3 text-center">
                            <img id="add-thumbnail-preview" src="" alt="Image Preview"
                                style="display: none; width:100%;" class="img-preview" />
                        </div>

                        <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Course -->
    <div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('course.update', ':id') }}" method="post" id="editCourseForm"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Make sure to use the PUT method for updates -->
                        <div class="mb-3">
                            <label class="form-label" for="edit-judul">Judul <span style="color: red">*</span></label>
                            <input type="text" name="judul" class="form-control" id="edit-judul"
                                placeholder="Type your course title" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit-desc">Deskripsi <span style="color: red">*</span></label>
                            <textarea name="deskripsi" id="edit-desc" class="form-control" cols="30" rows="5"
                                placeholder="Type your course description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit-thumbnail">Thumbnail (optional)</label>
                            <input type="file" name="thumbnail" class="form-control" id="edit-thumbnail"
                                onchange="previewImage(event, 'edit')" />
                        </div>
                        <div class="mb-3 text-center">
                            <img id="current-thumbnail" src="" alt="Image Preview"
                                style="display: none; width:100%;" class="img-preview" />
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to preview image
        function previewImage(event, modalType) {
            const preview = modalType === 'add' ? document.getElementById('add-thumbnail-preview') : document
                .getElementById('current-thumbnail');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Show the image
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none'; // Hide if no file is selected
            }
        }

        // Script for filling the edit modal
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                const courseId = this.getAttribute('data-id');
                const courseTitle = this.getAttribute('data-judul');
                const courseDescription = this.getAttribute('data-deskripsi');
                const courseThumbnail = this.getAttribute('data-thumbnail'); // Get the thumbnail path

                // Replace URL in edit form action
                const form = document.getElementById('editCourseForm');
                form.action = form.action.replace(':id', courseId);

                // Fill modal fields with course data
                document.getElementById('edit-judul').value = courseTitle;
                document.getElementById('edit-desc').value = courseDescription;

                // Set current thumbnail image
                document.getElementById('current-thumbnail').src = "{{ asset('storage/') }}" +
                    courseThumbnail;
                document.getElementById('current-thumbnail').style.display =
                    'block'; // Show current thumbnail

                // Show modal
                var editModal = new bootstrap.Modal(document.getElementById('editCourseModal'));
                editModal.show();
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
