@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-16">
    <div class="popular-movies">
        <h2 class="uppercase tracking-wider text-orange-500 font-bold">Phim hoạt hình</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($animes as $movie)
                <x-anime-card :movie="$movie"/>
            @endforeach
        </div>
        <div class="flex justify-center items-center mb-4">
            <div class="w-96 flex justify-around">
                <a href="{{ route('animes.index', ['page' => $previous]) }}">
                    <button class="bg-gray-500 text-white font-semibold px-4 py-2 rounded">Previous</button>
                </a>
                <a href="{{ route('animes.index', ['page' => $next]) }}">
                    <button class="bg-gray-500 text-white font-semibold px-4 py-2 rounded">Next</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection