@extends('client.layouts.app')

@section('title', $course->judul)

@section('container')
    {{-- Hero --}}
    <div class="relative isolate overflow-hidden">
        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/img/contents/image-not-found.png') }}"
            alt="{{ $course->title }}" class="absolute inset-0 -z-10 h-full w-full object-cover">
        <div class="opacity-85 absolute inset-0 -z-10 bg-black"></div>

        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="mx-auto max-w-2xl px-6 py-16">
            <div class="text-center">
                <h1 class="text-balance text-4xl font-bold tracking-tight text-white">{{ $course->judul }}</h1>
                <p class="mt-6 text-justify text-base leading-8 text-gray-300 lg:text-lg">{{ $course->deskripsi }}</p>
            </div>
        </div>
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
            aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
    </div>

    {{-- Main --}}
    <div class="mx-auto my-6 max-w-2xl px-8 text-gray-700 sm:px-6">
        <h2 class="mb-6 text-2xl font-semibold text-gray-800">Content</h2>

        {{-- Pertemuan 1 dan Modal --}}
        @if ($contents->count() > 0)
            @foreach ($contents as $content)
                <div class="mb-4">
                    <div class="rounded-lg border border-gray-300">
                        <button
                            class="flex w-full items-center justify-between rounded-lg bg-white p-4 text-left focus:outline-none focus:ring focus:ring-indigo-500"
                            onclick="toggle({{ $content->pertemuan }})">
                            <span class="text-base font-medium lg:text-lg"> {{ $content->pertemuan }}</span>
                            <svg id="pertemuan-icon-{{ $content->pertemuan }}"
                                class="h-6 w-6 transition-transform duration-200" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.70711 9.71069C5.31658 10.1012 5.31658 10.7344 5.70711 11.1249L10.5993 16.0123C11.3805 16.7927 12.6463 16.7924 13.4271 16.0117L18.3174 11.1213C18.708 10.7308 18.708 10.0976 18.3174 9.70708C17.9269 9.31655 17.2937 9.31655 16.9032 9.70708L12.7176 13.8927C12.3271 14.2833 11.6939 14.2832 11.3034 13.8927L7.12132 9.71069C6.7308 9.32016 6.09763 9.32016 5.70711 9.71069Z"
                                    fill="#0F0F0F"></path>
                            </svg>
                        </button>
                        <div id="pertemuan-{{ $content->pertemuan }}" class="hidden border-t border-gray-200 p-4">
                            <p class="mb-4 text-base text-gray-500">{{ $content->deskripsi_konten }}</p>
                            <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                                class="mt-2 flex rounded-lg bg-indigo-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300"
                                type="button" onclick="playVideo()">
                                <svg viewBox="0 0 24 24" class="mr-2 h-4 w-4" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                    <path
                                        d="M16.6582 9.28638C18.098 10.1862 18.8178 10.6361 19.0647 11.2122C19.2803 11.7152 19.2803 12.2847 19.0647 12.7878C18.8178 13.3638 18.098 13.8137 16.6582 14.7136L9.896 18.94C8.29805 19.9387 7.49907 20.4381 6.83973 20.385C6.26501 20.3388 5.73818 20.0469 5.3944 19.584C5 19.053 5 18.1108 5 16.2264V7.77357C5 5.88919 5 4.94701 5.3944 4.41598C5.73818 3.9531 6.26501 3.66111 6.83973 3.6149C7.49907 3.5619 8.29805 4.06126 9.896 5.05998L16.6582 9.28638Z"
                                        stroke="#ffffff" stroke-width="2" stroke-linejoin="round"></path>
                                </svg>
                                Play
                            </button>
                        </div>
                    </div>

                    {{-- Modal for video --}}
                    <div id="default-modal" tabindex="-1" aria-hidden="true"
                        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
                        <div class="relative max-h-full w-full max-w-2xl p-4">
                            <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                                {{-- Modal header --}}
                                <div
                                    class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white lg:text-2xl">Pertemuan
                                        {{ $content->pertemuan }}
                                    </h3>
                                    <button type="button"
                                        class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="default-modal" onclick="stopVideo()">
                                        <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close</span>
                                    </button>
                                </div>
                                {{-- Modal body --}}
                                <div class="space-y-6 p-6">
                                    <video id="courseVideo" class="w-full rounded-lg border bg-gray-200" controls>
                                        <source src="{{ asset('storage/' . $content->video) }}" type="video/mp4">
                                        Mohon maaf, video tidak dapat ditampilkan. Silakan coba lagi nanti.
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="my-20">
                <h2 class="text-center text-gray-500">Mohon maaf, belum ada pertemuan yang tersedia saat ini.</h2>
            </div>
        @endif

    </div>
@endsection
