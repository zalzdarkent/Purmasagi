@extends('admin.layouts.app')

@section('title', 'Detail Absensi - ' . $absensi->siswa->nama)

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Back Button -->
        <div class="d-flex justify-content-start mb-4">
            <a href="{{ route('siswa.absen') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back"></i> Kembali
            </a>
        </div>

        <!-- Detail Card -->
        <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
            <div class="card-header bg-primary">
                <h4 class="mb-0 text-white">Detail Absensi</h4>
            </div>

            <div class="card-body p-4">
                <div class="row g-4">
                    <!-- Siswa Info -->
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            {{-- <div class="flex-shrink-0 me-3">
                                <img src="{{ asset('assets/admin/img/avatars/1.png') }}" alt="Avatar"
                                    class="rounded-circle" style="width: 60px;">
                            </div> --}}
                            <div>
                                <h5 class="mb-1">{{ $absensi->siswa->nama }}</h5>
                                <p class="text-muted mb-0"><i class="bx bx-envelope"></i> {{ $absensi->siswa->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Guru Info -->
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            {{-- <div class="flex-shrink-0 me-3">
                                <img src="{{ asset('assets/admin/img/avatars/2.png') }}" alt="Avatar"
                                    class="rounded-circle" style="width: 60px;">
                            </div> --}}
                            <div>
                                <h5 class="mb-1">{{ optional($absensi->guru)->name ?? '-' }}</h5>
                                <p class="text-muted mb-0"><i class="bx bx-briefcase"></i> Pengajar:
                                    {{ optional($absensi->course)->judul ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Pertemuan & Status -->
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded shadow-sm h-100">
                            <h6 class="text-muted fw-bold">Pertemuan</h6>
                            <p class="fs-5 mb-0">
                                {{ optional($absensi->content)->pertemuan ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded shadow-sm h-100">
                            <h6 class="text-muted fw-bold">Status</h6>
                            @if ($absensi->status == 'Hadir')
                                <span class="badge bg-label-success fs-6 py-2 px-3">{{ ucfirst($absensi->status) }}</span>
                            @elseif ($absensi->status == 'Izin')
                                <span class="badge bg-warning text-dark fs-6 py-2 px-3 text-white">{{ ucfirst($absensi->status) }}</span>
                            @else
                                <span class="badge bg-label-danger fs-6 py-2 px-3">{{ ucfirst($absensi->status) }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="col-12 mt-3">
                        <div class="border-top pt-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="text-muted mb-1">Tanggal Absen</p>
                                    <p class="fw-semibold">
                                        {{ \Carbon\Carbon::parse($absensi->created_at)->tz('Asia/Jakarta')->format('d M Y H:i') }}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p class="text-muted mb-1">Keterangan</p>
                                    <p class="fw-semibold">{{ $absensi->keterangan ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection