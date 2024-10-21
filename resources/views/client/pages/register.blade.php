@extends('client.layouts.app')

@section('title', 'Daftar')

@section('container')
    <div class="flex h-full">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">Daftar</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Sudah punya akun?
                        <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Masuk di sini!</a>
                    </p>
                </div>

                <div class="mt-10">
                    <div>
                        @if ($errors->any())
                            <div class="mb-4">
                                @foreach ($errors->all() as $error)
                                    <div class="text-sm text-red-500">{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('register') }}" method="POST" class="space-y-6">
                            @csrf

                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                    address</label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email" required
                                        class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:text-gray-900 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <span id="emailError" class="text-sm text-red-500"></span>
                                </div>
                            </div>

                            <div>
                                <label for="nama" class="block text-sm font-medium leading-6 text-gray-900">Nama
                                    Lengkap</label>
                                <div class="mt-2">
                                    <input id="nama" name="nama" type="text" autocomplete="email" required
                                        class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:text-gray-900 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <span id="namaError" class="text-sm text-red-500"></span>
                                </div>
                            </div>

                            <div>
                                <label for="kelas"
                                    class="block text-sm font-medium leading-6 text-gray-900">Kelas</label>
                                <div class="mt-2">
                                    <input id="kelas" name="kelas" type="text" autocomplete="email" required
                                        class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:text-gray-900 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <span id="kelasError" class="text-sm text-red-500"></span>
                                </div>
                            </div>

                            <div>
                                <label for="password"
                                    class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                <div class="mt-2">
                                    <input id="password" name="password" type="password" autocomplete="current-password"
                                        required
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
                                        autocomplete="current-password" required
                                        class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:text-gray-900 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        onchange="validatePasswordConfirmation()">
                                    <span id="passwordConfirmationError" class="text-sm text-red-500"></span>
                                </div>
                            </div>

                            <div>
                                <button type="submit"
                                    class="mt-4 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover"
                src="https://images.unsplash.com/photo-1663247455660-4f05e0926aa6?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="">
        </div>
    </div>

    <script>
        function validatePassword() {
            const password = document.getElementById('password').value;
            const passwordError = document.getElementById('passwordError');
            if (password.length < 6) {
                passwordError.textContent = 'Password harus memiliki minimal 6 karakter.';
            } else {
                passwordError.textContent = '';
            }
        }

        function validatePasswordConfirmation() {
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            const passwordConfirmationError = document.getElementById('passwordConfirmationError');
            if (password !== passwordConfirmation) {
                passwordConfirmationError.textContent = 'Konfirmasi password tidak sesuai.';
            } else {
                passwordConfirmationError.textContent = '';
            }
        }
    </script>
@endsection
