@extends('client.layouts.app')

@section('title', 'Aktivitas')

@section('container')
    <div class="px-8 py-20 text-center md:py-10">
        <h1 class="text-6xl font-bold text-gray-900">404</h1>
        <p class="mt-4 text-base text-gray-600">Oops! Halaman yang Anda cari tidak ditemukan.</p>
        <a href="{{ url('/') }}"
            class="mt-6 inline-block rounded-lg bg-indigo-600 px-4 py-2 text-sm text-white hover:bg-indigo-500">
            Kembali ke Beranda
        </a>
    </div>
@endsection
