@extends('admin.layouts.app')

@section('title', 'Daftar Logo')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Button to Open the Modal -->
        <div class="d-flex justify-content-start mb-3">
            <a href="{{ route('logo.create') }}" type="button" class="btn btn-success">
                Tambah Logo
            </a>
        </div>

        @if (session('success'))
            <div class="alert-dismissible fade show alert alert-success" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert-danger alert-dismissible fade show alert" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <h5 class="card-header">Daftar Logo</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Gambar Logo</th>
                            <th>Nama Logo</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($logos->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">No data available</td>
                            </tr>
                        @else
                            @foreach ($logos as $logo)
                                <tr>
                                    <td>
                                        <!-- Menampilkan Thumbnail logo dengan ukuran 150px -->
                                        <img src="{{ asset('uploads/logo/' . $logo->gambar_logo) }}" alt="gambar logo"
                                            style="width: 150px">
                                    </td>
                                    <td>{{ $logo->nama_logo }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('logo.edit', $logo->id) }}"
                                            class="btn-edit btn btn-primary btn-sm me-2">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <form id="delete-form-{{ $logo->id }}"
                                            action="{{ route('logo.destroy', $logo->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-danger btn btn-sm"
                                                onclick="confirmDelete('{{ $logo->id }}')">
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
