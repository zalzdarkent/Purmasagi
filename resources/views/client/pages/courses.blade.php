@extends('client.layouts.app')

@section('title', 'Courses')

@section('container')
    {{-- Hero --}}
    <div class="relative isolate overflow-hidden">
        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2830&q=80&blend=111827&sat=-100&exp=15&blend-mode=multiply"
            alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="mx-auto max-w-2xl px-6 py-16">
            <div class="text-center">
                <h1 class="text-balance text-4xl font-bold tracking-tight text-white">Kelas Pembelajaran</h1>
                <p class="mt-6 text-base leading-8 text-gray-300 lg:text-lg">Temukan berbagai kelas yang tersedia untuk
                    membantu Anda meningkatkan pengetahuan.</p>
            </div>
        </div>
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
            aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
    </div>

    {{-- Courses --}}
    <div class="mx-auto my-16 max-w-screen-xl px-10 lg:px-20">
        @if ($courses->count() > 0)
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-y-12 lg:grid-cols-3">
                @foreach ($courses as $course)
                    {{-- Course Card --}}
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
                                    {{-- !!!! --}}
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
                            <p class="mb-3 line-clamp-2 h-10 text-justify text-sm text-gray-600 md:h-12 lg:text-base">
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
            <div class="my-12">
                {{ $courses->links() }}
            </div>
        @else
            <h2 class="text-center text-gray-500">Mohon maaf, belum ada kelas yang tersedia saat ini</h2>
        @endif
    </div>

    {{-- Pagination --}}

@endsection
