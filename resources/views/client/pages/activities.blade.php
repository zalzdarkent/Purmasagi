@extends('client.layouts.app')

@section('title', 'Aktivitas')

@section('container')
    {{-- Hero --}}
    @include('client.components.hero', [
        'title' => 'Galeri Aktivitas',
        'description' =>
            'Jelajahi galeri aktivitas kami dan temukan berbagai momen berharga yang telah kami abadikan.',
    ])

    {{-- Activities Gallery --}}
    <div class="mx-auto my-16 max-w-screen-xl px-10 lg:px-20">
        @if ($activities->count() > 0)
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-y-4 lg:grid-cols-3">
                @foreach ($activities as $activity)
                    <div
                        class="group relative mx-auto mb-6 w-full max-w-md rounded-lg border border-gray-200 bg-white shadow md:mb-0">
                        <img class="h-60 w-full rounded-lg object-cover"
                            src="{{ $activity->gambar_kegiatan ? asset('storage/' . $activity->gambar_kegiatan) : asset('assets/img/contents/image-not-found.png') }}"
                            alt="{{ $activity->deskripsi_kegiatan }}" />
                        <div
                            class="absolute inset-0 bottom-0 flex h-full flex-col justify-end bg-black bg-opacity-50 opacity-0 transition-opacity duration-300 hover:rounded-lg group-hover:opacity-100">
                            <div class="m-4">
                                <h2 class="text-xl font-semibold text-white">{{ $activity->deskripsi_kegiatan }}</h2>
                                <h3 class="text-white">{{ $activity->waktu }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="my-12">
                {{ $activities->links() }}
            </div>
        @else
            <h2 class="text-center text-gray-500">Mohon maaf, belum ada aktivitas yang tersedia saat ini</h2>
        @endif
    </div>

@endsection
