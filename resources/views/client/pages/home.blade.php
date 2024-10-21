@extends('client.layouts.app')

@section('title', 'Beranda')

@section('container')
    <div class="mx-auto px-2 py-10 lg:px-20">
        {{-- Hero Section --}}
        <div class="relative isolate px-8 lg:px-0">
            <!-- Gradient Background -->
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
            <!-- Header Section -->
            <div class="mx-auto max-h-screen max-w-2xl py-32">
                <h1 class="text-balance text-center text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                    Pembelajaran Mudah di Mana Saja, Kapan Saja
                </h1>
                <p class="mt-6 text-center text-base leading-8 text-gray-600 lg:text-lg">
                    Jelajahi kelas online, atur kemajuan Anda, dan wujudkan potensi maksimal dengan Purmasagi.
                </p>
                <div class="mt-5 flex items-center justify-center gap-x-6 md:mt-10">
                    @if (Auth::guard('siswa')->check())
                        <a href="{{ route('courses.client') }}"
                            class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                            Mulai Sekarang!
                        </a>
                    @else
                        <a href="/login"
                            class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                            Mulai Sekarang!
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Card --}}
        <div class="mb-36 flex flex-wrap items-center justify-center gap-y-6 space-x-0 md:space-x-8">
            <x-card count="{{ $studentCountFormatted }}" title="Pelajar"
                description="{{ $studentCount }} pelajar telah bergabung dengan kelas kami untuk meningkatkan keterampilan mereka." />
            <x-card count="{{ $courseCountFormatted }}" title="Kelas Video"
                description="Akses kelas video yang memungkinkan Anda belajar tanpa batasan geografis dan waktu." />
            <x-card count="{{ $teacherCountFormatted }}" title="Guru"
                description="Belajar dari guru berpengalaman yang siap membimbing Anda dalam perjalanan pendidikan Anda." />
        </div>

        {{-- Courses Card --}}
        <div class="mx-auto my-16 max-w-screen-xl px-10 lg:px-20">
            <h1 class="mb-12 text-center text-3xl font-bold text-gray-900">Kelas Terbaru</h1>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-y-12 xl:grid-cols-3">
                @foreach ($latestCourses as $course)
                    <div
                        class="mx-auto mb-6 flex w-full max-w-md flex-col justify-between rounded-lg border border-gray-200 bg-white shadow transition duration-500 ease-in-out hover:-translate-y-4 hover:shadow-lg md:mb-0">
                        <a href="/course/{{ $course->id }}">
                            <img class="h-48 w-full rounded-t-lg object-cover"
                                src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/img/contents/image-not-found.png') }}"
                                alt="{{ $course->judul }}" />
                        </a>
                        <div class="flex flex-grow flex-col p-5">
                            <div class="flex-grow">
                                @php
                                    $initials = strtoupper(
                                        collect(explode(' ', $course->admin->name))
                                            ->take(2)
                                            ->map(function ($word) {
                                                return substr($word, 0, 1);
                                            })
                                            ->join(''),
                                    );
                                    $avatarColor = \App\Helpers\TextHelpers::getColorFromName($course->admin->name);
                                @endphp
                                <div class="mb-2 flex items-center space-x-3">
                                    @if ($course->admin->foto_profil)
                                        <img class="h-8 w-8 rounded-full"
                                            src="{{ asset('storage/' . $course->admin->foto_profil) }}"
                                            alt="{{ $course->admin->name }}">
                                    @else
                                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full"
                                            style="background-color: {{ $avatarColor }}; color: white;">
                                            {{ $initials }}
                                        </span>
                                    @endif
                                    <a href="#"
                                        class="text-sm text-gray-600 lg:text-base">{{ $course->admin->name }}</a>
                                </div>
                                <a href="/course/{{ $course->id }}" class="hover:underline hover:underline-offset-4">
                                    <h5 class="mb-2 text-xl font-semibold tracking-tight text-gray-900 lg:text-2xl">
                                        {{ $course->judul }}
                                    </h5>
                                </a>
                            </div>
                            <p class="mb-3 line-clamp-2 h-10 text-justify text-sm text-gray-600 lg:h-12 lg:text-base">
                                {{ $course->deskripsi }}
                            </p>
                            @if (Auth::guard('siswa')->check())
                                <!-- Tombol jika sudah login -->
                                <a href="/course/{{ $course->id }}"
                                    class="mt-4 inline-flex w-fit items-center rounded-lg bg-indigo-600 px-3 py-2 text-center text-sm font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                                    Pelajari
                                    <svg class="ms-2 h-3.5 w-3.5 rtl:rotate-180" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                            @else
                                <!-- Tombol jika belum login -->
                                <a href="/register"
                                    class="mt-4 inline-flex w-fit items-center rounded-lg bg-indigo-600 px-3 py-2 text-center text-sm font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                                    Daftar
                                    <svg class="ms-2 h-3.5 w-3.5 rtl:rotate-180" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- Pagination --}}
            <div class="mt-5 flex items-center justify-center gap-x-6 md:mt-10">
                <a href="/courses"
                    class="mb-8 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300 lg:mb-0">Lihat
                    kelas lainnya</a>
            </div>
        </div>

        {{-- Activities --}}
        <div class="mx-auto my-20 max-w-screen-xl">
            <h1 class="mb-12 text-center text-3xl font-bold text-gray-900">Aktivitas</h1>
            @if ($latestActivities->count() > 0)
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-y-12 lg:grid-cols-3">
                    @foreach ($latestActivities as $activities)
                        <div
                            class="group relative mx-auto mb-6 w-full max-w-md rounded-lg border border-gray-200 bg-white shadow md:mb-0">
                            <img class="h-60 w-full rounded-lg object-cover"
                                src="{{ $activities->gambar_kegiatan ? asset('storage/' . $activities->gambar_kegiatan) : asset('assets/img/contents/image-not-found.png') }}"
                                alt="{{ $activities->deskripsi_kegiatan }}" />
                            <div
                                class="absolute inset-0 bottom-0 flex h-full flex-col justify-end bg-black bg-opacity-50 opacity-0 transition-opacity duration-300 hover:rounded-lg group-hover:opacity-100">
                                <div class="m-4">
                                    <h2 class="text-xl font-semibold text-white">{{ $activities->deskripsi_kegiatan }}</h2>
                                    <h3 class="text-white">{{ $activities->waktu }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h2 class="mb-8 text-center text-gray-500 lg:mb-0">Belum ada aktivitas</h2>
            @endif

            <div class="mt-5 flex items-center justify-center gap-x-6 md:mt-10">
                <a href="/activities"
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300">Lihat
                    aktivitas lainnya</a>
            </div>
        </div>

        {{-- CTA --}}
        <div class="mb-10 flex flex-col items-center justify-between px-8 md:flex-row lg:px-0">
            <div class="w-full space-y-6 md:w-1/2 md:p-4">
                <h1 class="text-4xl font-bold text-gray-900">Temukan Pengajar Terbaik!</h1>
                <p class="text-gray-700 lg:text-lg">Cari guru yang sesuai dengan kebutuhanmu dan mulailah belajar dengan
                    mudah dan nyaman.</p>
                <div class="mt-10">
                    <a href="/teachers"
                        class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300">Cari
                        Sekarang</a>
                </div>
            </div>
            <div class="mt-8 w-full md:mt-0 md:w-1/2">
                <img src="../assets/img/coba/lecture.jpg" alt="Teacher Picture"
                    class="flex h-64 w-full items-center justify-center rounded-lg object-cover">
            </div>
        </div>

        {{-- Scroll Up Button --}}
        <button id="scrollUpBtn"
            class="fixed bottom-5 right-5 hidden rounded-full bg-indigo-600 p-3 text-white shadow-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300"
            aria-label="Scroll to top" onclick="scrollToTop()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m-8-8l8-8 8 8" />
            </svg>
        </button>
    </div>
@endsection
