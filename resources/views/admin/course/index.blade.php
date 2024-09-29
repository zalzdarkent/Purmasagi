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
                            <th>Title</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($courses->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">No data available</td>
                            </tr>
                        @else
                            @foreach ($courses as $course)
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $course->judul }}</strong>
                                    </td>
                                    <td>{{ $course->deskripsi }}</td>
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
                            @endforeach
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
                    <form action="{{ route('course.store') }}" method="post">
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
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Course -->
    <div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('course.update', ':id') }}" method="post" id="editCourseForm">
                        @csrf
                        @method('PUT') <!-- Pastikan untuk menggunakan metode PUT untuk pembaruan -->
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
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script untuk mengisi modal edit
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                const courseId = this.getAttribute('data-id');
                const courseTitle = this.getAttribute('data-judul');
                const courseDescription = this.getAttribute('data-deskripsi');

                // Ganti URL pada action form edit
                const form = document.getElementById('editCourseForm');
                form.action = form.action.replace(':id', courseId);

                // Mengisi field modal dengan data kursus
                document.getElementById('edit-judul').value = courseTitle;
                document.getElementById('edit-desc').value = courseDescription;

                // Tampilkan modal
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
