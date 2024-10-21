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

@endsection
