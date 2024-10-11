@extends('admin.layouts.app')

@section('container')
    {{-- <p>Kegiatan</p> --}}
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Button to Open the Modal -->
        <div class="d-flex justify-content-start mb-3">
            <a href="{{ route('kegiatan.create') }}" type="button" class="btn btn-success">
                Tambah Data
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
            <h5 class="card-header">Daftar Kegiatan</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Gambar Kegiatan</th>
                            <th>Deskripsi Kegiatan</th>
                            <th>Tahun Kegiatan</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($kegiatans->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">No data available</td>
                            </tr>
                        @else
                            @foreach ($kegiatans as $kegiatan)
                                <tr>
                                    <td>
                                        <!-- Menampilkan Thumbnail dengan ukuran 200x200 -->
                                        <img src="{{ asset('storage/' . $kegiatan->gambar_kegiatan) }}"
                                            alt="gambar kegiatan" style="width: 150px">
                                    </td>
                                    <td>{{ $kegiatan->deskripsi_kegiatan }}</td>
                                    <td>{{ $kegiatan->waktu }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('kegiatan.edit', $kegiatan->id) }}"
                                            class="btn-edit btn btn-primary btn-sm me-2">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <form id="delete-form-{{ $kegiatan->id }}"
                                            action="{{ route('kegiatan.destroy', $kegiatan->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-danger btn btn-sm"
                                                onclick="confirmDelete('{{ $kegiatan->id }}')">
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
