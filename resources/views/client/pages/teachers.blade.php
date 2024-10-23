@extends('client.layouts.app')

@section('title', 'Guru')

@section('container')
    {{-- Hero --}}
    @include('client.components.hero', [
        'title' => 'Temui Para Guru Kami',
        'description' =>
            'Kenali para guru yang berdedikasi dan berpengalaman yang siap membimbing Anda dalam proses pembelajaran.',
    ])

    {{-- Teachers --}}
    <div class="mx-auto my-16 max-w-screen-xl px-10 lg:px-20">
        @if ($teachers->count() > 0)
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-y-12 lg:grid-cols-3">
                @foreach ($teachers as $teacher)
                    {{-- Teacher Card --}}
                    <div
                        class="mx-auto mb-6 flex w-full max-w-md flex-col items-center justify-center rounded-lg border border-gray-200 bg-white p-5 shadow transition duration-500 ease-in-out hover:-translate-y-4 hover:shadow-lg md:mb-0">
                        @php
                            $initials = strtoupper(
                                collect(explode(' ', $teacher->name))
                                    ->take(2)
                                    ->map(function ($word) {
                                        return substr($word, 0, 1);
                                    })
                                    ->join(''),
                            );
                            $avatarColor = \App\Helpers\TextHelpers::getColorFromName($teacher->name);
                        @endphp
                        @if ($teacher->foto_profil)
                            <img class="h-24 w-24 rounded-full object-cover"
                                src="{{ asset('storage/' . $teacher->foto_profil) }}" alt="{{ $teacher->name }}">
                        @else
                            <span class="inline-flex h-24 w-24 items-center justify-center rounded-full text-4xl"
                                style="background-color: {{ $avatarColor }}; color: white;">
                                {{ $initials }}
                            </span>
                        @endif

                        <p class="mt-5 text-center text-xl font-bold text-gray-900 lg:text-2xl">{{ $teacher->name }}</p>

                        <p class="mb-5 text-center text-sm text-gray-600 lg:text-base">
                            {{ $teacher->email }}
                            <a href="mailto:{{ $teacher->email }}">
                                <svg class="inline-block h-4 w-4 text-gray-600" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M4 7.00005L10.2 11.65C11.2667 12.45 12.7333 12.45 13.8 11.65L20 7"
                                            stroke="#4B5563" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                        </path>
                                        <rect x="3" y="5" width="18" height="14" rx="2" stroke="#4B5563"
                                            stroke-width="2" stroke-linecap="round"></rect>
                                    </g>
                                </svg>
                            </a>
                        </p>

                        {{-- <a href="/user/teacher/{{ $teacher->id }}"
                            class="mx-auto inline-flex w-fit items-center rounded-lg bg-indigo-600 px-3 py-2 text-center text-sm font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                            Lihat Profil
                            <svg class="ms-2 h-3.5 w-3.5 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a> --}}
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="my-12">
                {{ $teachers->links('pagination::tailwind') }}
            </div>
        @else
            <h2 class="text-center text-gray-500">Mohon maaf, belum ada guru yang tersedia saat ini</h2>
        @endif
    </div>

@endsection
