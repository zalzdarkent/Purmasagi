@extends('client.layouts.app')

@section('title', 'Profil')

@section('container')
    <div class="flex items-center justify-center">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Ubah Profil</h2>
                <div class="mt-2">
                    <div>
                        @if (session('success'))
                            <div class="mb-4 rounded-lg bg-green-50 px-4 py-3 text-green-800 sm:text-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-4 rounded-lg bg-red-50 px-4 py-2 text-red-800 sm:text-sm">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="" method="POST" class="space-y-6">
                            @csrf

                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                    Address</label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:text-gray-900 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        value="{{ $siswa->email }}">
                                    <span id="emailError" class="text-sm text-red-500"></span>
                                </div>
                            </div>

                            <div>
                                <label for="nama" class="block text-sm font-medium leading-6 text-gray-900">Nama
                                    Lengkap</label>
                                <div class="mt-2">
                                    <input id="nama" name="nama" type="text" autocomplete="email"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:text-gray-900 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        value="{{ $siswa->nama }}">
                                    <span id="namaError" class="text-sm text-red-500"></span>
                                </div>
                            </div>

                            <div>
                                <label for="kelas"
                                    class="block text-sm font-medium leading-6 text-gray-900">Kelas</label>
                                <div class="mt-2">
                                    <select id="kelas" name="kelas"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option value="" disabled>Pilih kelas</option>
                                        <option value="10" {{ $siswa->kelas == 10 ? 'selected' : '' }}>Kelas 10</option>
                                        <option value="11" {{ $siswa->kelas == 11 ? 'selected' : '' }}>Kelas 11</option>
                                        <option value="12" {{ $siswa->kelas == 12 ? 'selected' : '' }}>Kelas 12</option>
                                    </select>
                                    <span id="kelasError" class="text-sm text-red-500"></span>
                                </div>
                            </div>

                            <div>
                                <label for="password"
                                    class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                <div class="mt-2">
                                    <input id="password" name="password" type="password" autocomplete="current-password"
                                        placeholder="••••••••"
                                        class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:text-gray-900 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        onchange="validatePassword()">
                                    <span id="passwordError" class="text-sm text-red-500"></span>
                                </div>
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium leading-6 text-gray-900">Konfirmasi Password</label>
                                <div class="mt-2">
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        autocomplete="current-password" placeholder="••••••••"
                                        class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:text-gray-900 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        onchange="validatePasswordConfirmation()">
                                    <span id="passwordConfirmationError" class="text-sm text-red-500"></span>
                                </div>
                            </div>

                            <div>
                                <button type="submit"
                                    class="mt-6 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
