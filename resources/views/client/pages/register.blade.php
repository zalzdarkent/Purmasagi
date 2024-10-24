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
                            <div class="mb-4 rounded-lg bg-red-50 px-4 py-2 text-red-800 sm:text-sm">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('register') }}" method="POST" class="space-y-6">
                            @csrf

                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Alamat Email
                                    <span class="text-red-500"> * </span></label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email" required
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        placeholder="Masukkan alamat email">
                                    <span id="emailError" class="text-sm text-red-500"></span>
                                </div>
                            </div>

                            <div>
                                <label for="nama" class="block text-sm font-medium leading-6 text-gray-900">Nama
                                    Lengkap<span class="text-red-500"> * </span></label>
                                <div class="mt-2">
                                    <input id="nama" name="nama" type="text" autocomplete="email" required
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        placeholder="Masukkan nama lengkap">
                                    <span id="namaError" class="text-sm text-red-500"></span>
                                </div>
                            </div>

                            <div>
                                <label for="kelas" class="block text-sm font-medium leading-6 text-gray-900">Kelas<span
                                        class="text-red-500"> * </span></label>
                                <div class="mt-2">
                                    <select id="kelas" name="kelas" required
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option value="" disabled selected>Pilih kelas</option>
                                        <option value="10">Kelas 10</option>
                                        <option value="11">Kelas 11</option>
                                        <option value="12">Kelas 12</option>
                                    </select>
                                    <span id="kelasError" class="text-sm text-red-500"></span>
                                </div>
                            </div>

                            <div>
                                <label for="password"
                                    class="block text-sm font-medium leading-6 text-gray-900">Password<span
                                        class="text-red-500"> * </span></label>
                                <div class="relative mt-2">
                                    <input id="password" name="password" type="password" autocomplete="current-password"
                                        placeholder="••••••••"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        onchange="validatePassword()">
                                    <button type="button" id="togglePassword"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <!-- Eye Icon (default hidden) -->
                                        <svg id="eye" viewBox="0 0 24 24" class="h-5 w-5 text-gray-400" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                        <!-- Eye-Slash Icon (default shown) -->
                                        <svg id="eyeSlash" viewBox="0 0 24 24" class="hidden h-5 w-5 text-gray-400"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                    <span id="passwordError" class="absolute left-0 mt-1 text-sm text-red-500"></span>
                                </div>
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium leading-6 text-gray-900">Konfirmasi Password<span
                                        class="text-red-500"> * </span></label>
                                <div class="relative mt-2">
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        autocomplete="current-password" placeholder="••••••••"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        onchange="validatePasswordConfirmation()">
                                    <button type="button" id="toggleConfirmPassword"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <!-- Eye Icon (default hidden) -->
                                        <svg id="eyeConfirm" viewBox="0 0 24 24" class="h-5 w-5 text-gray-400"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                        <!-- Eye-Slash Icon (default shown) -->
                                        <svg id="eyeSlashConfirm" viewBox="0 0 24 24"
                                            class="hidden h-5 w-5 text-gray-400" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                    <span id="passwordConfirmationError"
                                        class="absolute left-0 mt-1 text-sm text-red-500"></span>
                                </div>
                            </div>

                            <div>
                                <button type="submit"
                                    class="mt-12 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Daftar</button>
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
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eye = document.getElementById('eye');
        const eyeSlash = document.getElementById('eyeSlash');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eye.classList.toggle('hidden');
            eyeSlash.classList.toggle('hidden');
        });

        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const eyeConfirm = document.getElementById('eyeConfirm');
        const eyeSlashConfirm = document.getElementById('eyeSlashConfirm');

        toggleConfirmPassword.addEventListener('click', function() {
            const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmationInput.setAttribute('type', type);
            eyeConfirm.classList.toggle('hidden');
            eyeSlashConfirm.classList.toggle('hidden');
        });

        function validatePassword() {
            const password = document.getElementById('password').value;
            const passwordError = document.getElementById('passwordError');
            if (password.length < 6) {
                passwordError.textContent = 'Password harus memiliki minimal 8 karakter.';
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
