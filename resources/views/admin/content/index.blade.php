@extends('admin.layouts.app')

@section('title', 'Daftar Konten')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Button to Open the Modal -->
        <div class="d-flex justify-content-start mb-3">
            <a href="{{ route('content.create') }}" class="btn btn-success">
                Tambah Data
            </a>
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
                            <th>Pertemuan ke-</th>
                            <th>Title</th>
                            <th>File Pendukung</th>
                            <th>Deskripsi Pertemuan</th>
                            <th>Deskripsi Konten</th>
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
                                    {{-- <td>{{ $content->course->admin_id }}</td> --}}
                                    <td>
                                        <strong>Pertemuan {{ $content->pertemuan }}</strong>
                                    </td>
                                    <td>{{ $content->course->judul }}</td> <!-- Menampilkan judul kursus -->
                                    <td>
                                        @foreach (json_decode($content->file_paths) as $file)
                                            @php
                                                $extension = pathinfo($file, PATHINFO_EXTENSION); // Dapatkan ekstensi file
                                            @endphp

                                            @if (in_array($extension, ['mp4', 'avi', 'mov']))
                                                <!-- Ikon Play untuk Video -->
                                                <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                    class="btn btn-link text-primary">
                                                    <i class="menu-icon tf-icons bx bx-play-circle"></i> Play Video
                                                </a>
                                            @elseif(in_array($extension, ['pdf']))
                                                <!-- Ikon untuk PDF -->
                                                <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                    class="btn btn-link text-danger">
                                                    <i class="menu-icon tf-icons bx bx-file"></i> View PDF
                                                </a>
                                            @elseif(in_array($extension, ['ppt', 'pptx']))
                                                <!-- Ikon untuk PPT -->
                                                <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                    class="btn btn-link text-warning">
                                                    <i class="menu-icon tf-icons bx bx-file"></i> View PPT
                                                </a>
                                            @elseif(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                <!-- Ikon untuk Gambar -->
                                                <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                    class="btn btn-link text-success">
                                                    <i class="menu-icon tf-icons bx bx-image"></i> View Image
                                                </a>
                                            @else
                                                <!-- Jika format tidak dikenal -->
                                                <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                    class="btn btn-link">
                                                    <i class="menu-icon tf-icons bx bx-file"></i> View File
                                                </a>
                                            @endif
                                            <br> <!-- Ganti baris untuk tiap file -->
                                        @endforeach
                                    </td>
                                    <td>{{ Str::limit($content->course->deskripsi, 20) }}</td>
                                    <td>{{ Str::limit($content->deskripsi_konten, 20) }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('content.edit', $content->id) }}"
                                            class="btn btn-primary btn-sm me-2 btn-edit">
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

    <script>
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
