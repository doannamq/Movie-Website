@extends('layouts.main')
@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{ $movie['poster_url'] }}" alt="parasite" class="w-64 md:w-96">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $movie['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                    <span class="mt-2">Ngày công chiếu: {{ $movie['created'] }}</span>
                    <span class="mx-2">|</span>
                    <span class="mt-2">Cập nhật: {{ $movie['modified'] }}</span>
                </div>

                <p class="my-4">{{ $movie['content'] }}</p>

                <div class="flex flex-col text-gray-400 mt-1">
                    <span class="mb-2">Trạng thái: {{ $movie['status'] }}</span>
                    <div class="mb-2 flex">
                        <p>{{ $movie['episode_current'] }}</p>
                        <p class="mx-2">|</p>
                        <p>{{ $movie['time'] }}</p>
                    </div>
                    <span class="mb-2">Thể loại: {{ $movie['category'] }}</span>
                    <span class="mb-2">Quốc gia: {{ $movie['country'] }}</span>
                    <span class="mb-2">Đạo diễn: {{ $movie['director'] }}</span>
                    <span class="mb-2">Diễn viên: {{ $movie['actor'] }}</span>
                </div>

                <div class="mt-12 w-56 flex justify-between">
                    @if ($movie['trailer_url'])
                        <a href="{{ $movie['trailer_url'] }}" class="bg-gray-500 px-6 py-3 font-semibold rounded"
                            target="blank"><button>Trailer</button></a>
                    @endif
                    <a href="{{ route('movies.play', $movie['slug']) }}"
                        class="bg-orange-500 px-6 py-3 font-semibold rounded"><button>Xem phim</button></a>
                </div>
            </div>
        </div>
    </div>
    @include('shared.comments-box')
@endsection
