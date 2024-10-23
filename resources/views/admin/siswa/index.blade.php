@extends('admin.layouts.app')

@section('title', 'Daftar Siswa')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Button to Add Admin -->
        <div class="d-flex justify-content-start mb-3">
            <a href="{{ route('guru.create') }}" type="button" class="btn btn-success">
                Tambah Admin
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
            <h5 class="card-header">Daftar Admin</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Admin</th>
                            <th>Kelas</th>
                            <th>Email</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($siswas->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">No data available</td>
                            </tr>
                        @else
                            @foreach ($siswas as $siswa)
                                <tr>
                                    <td><strong>{{ $siswa->nama }}</strong></td>
                                    <td>{{ $siswa->kelas }}</td>
                                    <td>{{ $siswa->email }}</td>
                                    <td>
                                        <!-- Tombol Hapus -->
                                        <form id="delete-form-{{ $siswa->id }}"
                                            action="{{ route('siswa.destroy', $siswa->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-danger btn btn-sm"
                                                onclick="confirmDelete('{{ $siswa->id }}')">
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
            @if ($siswas instanceof \Illuminate\Pagination\LengthAwarePaginator && $siswas->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $siswas->links() }}
                </div>
            @endif
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
