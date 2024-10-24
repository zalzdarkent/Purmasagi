@extends('client.layouts.app')

@section('title', 'Courses')

@section('container')
    {{-- Hero --}}
    @include('client.components.hero', [
        'title' => 'Kelas Pembelajaran',
        'description' => 'Temukan berbagai kelas yang tersedia untuk membantu Anda meningkatkan pengetahuan.',
    ])

    {{-- Courses --}}
    <div class="mx-auto my-8 max-w-screen-xl px-10 lg:px-20">
        <form class="mx-auto max-w-md pb-8" method="GET" action="{{ route('courses.client') }}">
            <label for="search" class="sr-only mb-2 text-sm font-medium text-gray-900 dark:text-white">Search</label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                    <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="search" name="search"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-4 ps-10 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-indigo-500 dark:focus:ring-indigo-500"
                    placeholder="Cari kelas..." value="{{ request()->query('search') }}" />
                <button type="submit"
                    class="absolute bottom-2.5 end-2.5 rounded-lg bg-indigo-700 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Cari</button>
            </div>
        </form>

        @if ($courses->count() > 0)
            <div id="coursesContainer" class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-y-12 lg:grid-cols-3">
                @foreach ($courses as $course)
                    <div
                        class="course-card mx-auto mb-6 flex w-full max-w-md flex-col justify-between rounded-lg border border-gray-200 bg-white shadow transition duration-500 ease-in-out hover:-translate-y-4 hover:shadow-lg md:mb-0">
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
                                        {{ $course->judul }}</h5>
                                </a>
                            </div>
                            <p class="mb-3 line-clamp-2 h-10 text-justify text-sm text-gray-600 md:h-12 lg:text-base">
                                {{ $course->deskripsi }}</p>
                            <a href="/course/{{ $course->id }}"
                                class="mt-4 inline-flex w-fit items-center rounded-lg bg-indigo-600 px-3 py-2 text-center text-sm font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                                Pelajari
                                <svg class="ms-2 h-3.5 w-3.5 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="my-12">
                {{ $courses->links('pagination::tailwind') }}
            </div>
        @else
            <h2 class="text-center text-gray-500">Mohon maaf, belum ada kelas yang tersedia saat ini</h2>
        @endif
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const courses = document.querySelectorAll('.course-card');

            courses.forEach(course => {
                const title = course.querySelector('h5').innerText.toLowerCase();
                const description = course.querySelector('p').innerText.toLowerCase();

                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    course.style.display = '';
                } else {
                    course.style.display = 'none';
                }
            });
        });
    </script>
@endsection
