@extends('client.layouts.app')

@section('title', 'Masuk')

@section('container')
    <div class="flex h-full">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">Masuk</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Belum punya akun?
                        <a href="/register" class="font-semibold text-indigo-600 hover:text-indigo-500">Daftar sekarang!</a>
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
                        <form action="{{ route('login') }}" method="POST" class="space-y-2">
                            @csrf
                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                    address</label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email" required
                                        class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:text-gray-900 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div>
                                <label for="password"
                                    class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                <div class="mt-2">
                                    <input id="password" name="password" type="password" autocomplete="current-password"
                                        required
                                        class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:text-gray-900 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox"
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                <label for="remember" class="ml-3 block text-sm leading-6 text-gray-700">Ingat saya
                                </label>
                            </div>

                            <div>
                                <button type="submit"
                                    class="mt-8 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Masuk</button>
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
@endsection
