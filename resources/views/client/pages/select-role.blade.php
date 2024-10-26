@extends('client.layouts.app')

@section('title', 'Masuk')

@section('container')
    <div class="flex items-center justify-center">
        <div class="flex w-full max-w-4xl flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none">
            <h5 class="text-center tracking-tight text-gray-900">Jadilah bagian dari</h5>
            <h2 class="text-center text-4xl font-bold leading-[2] tracking-tight text-indigo-600">Purmasagi</h2>

            @if (session('error'))
                <div class="mb-4 rounded-lg bg-red-50 px-4 py-2 text-red-800 sm:text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="*: mt-6 grid grid-cols-1 gap-4 px-8 md:grid-cols-2 md:gap-y-12 lg:grid-cols-3 lg:px-0">
                <a href="/login/siswa"
                    class="course-card mx-auto mb-6 flex h-fit w-full flex-col justify-between rounded-lg border border-gray-200 bg-white shadow transition duration-500 ease-in-out hover:-translate-y-4 hover:shadow-lg md:mb-0">
                    <img class="h-48 w-full rounded-t-lg object-cover" src="{{ asset('assets/img/client/siswa.jpg') }}"
                        alt="Siswa" />

                    <div class="flex flex-grow flex-col p-5">
                        <h5 class="mb-2 text-xl font-semibold tracking-tight text-gray-900 lg:text-2xl">
                            Siswa</h5>
                        <p class="text-justify text-gray-600 lg:text-base">
                            Masuk sebagai siswa </p>
                    </div>
                </a>
                <a href="/admin/login"
                    class="course-card mx-auto mb-6 flex h-fit w-full flex-col justify-between rounded-lg border border-gray-200 bg-white shadow transition duration-500 ease-in-out hover:-translate-y-4 hover:shadow-lg md:mb-0">
                    <img class="h-48 w-full rounded-t-lg object-cover" src="{{ asset('assets/img/client/guru2.jpg') }}"
                        alt="Guru" />

                    <div class="flex flex-grow flex-col p-5">
                        <h5 class="mb-2 text-xl font-semibold tracking-tight text-gray-900 lg:text-2xl">
                            Guru</h5>
                        <p class="text-justify text-gray-600 lg:text-base">
                            Masuk sebagai guru </p>
                    </div>
                </a>
                <a href="/admin/login"
                    class="course-card mx-auto mb-6 flex h-fit w-full flex-col justify-between rounded-lg border border-gray-200 bg-white shadow transition duration-500 ease-in-out hover:-translate-y-4 hover:shadow-lg md:mb-0">
                    <img class="h-48 w-full rounded-t-lg object-cover" src="{{ asset('assets/img/client/admin.webp') }}"
                        alt="Admin" />

                    <div class="flex flex-grow flex-col p-5">
                        <h5 class="mb-2 text-xl font-semibold tracking-tight text-gray-900 lg:text-2xl">
                            Admin</h5>
                        <p class="text-justify text-gray-600 lg:text-base">
                            Masuk sebagai admin </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
