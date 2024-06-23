@extends('layouts.main')
@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{$anime['poster_url']}}" alt="parasite" class="w-64 md:w-96">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{$anime['name']}}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                    <span class="mt-2">Ngày công chiếu: {{$anime['created']}}</span>
                    <span class="mx-2">|</span>
                    <span class="mt-2">Cập nhật: {{$anime['modified']}}</span>
                </div>

                <p class="my-4">{{$anime['content']}}</p>

                <div class="flex flex-col text-gray-400 mt-1" >
                    <span class="mb-2">Trạng thái: {{$anime['status']}}</span>
                    <div class="mb-2 flex">
                        <p>{{$anime['episode_current']}}</p>
                        <p class="mx-2">|</p>
                        <p>{{$anime['time']}}</p>
                    </div>
                    <span class="mb-2">Thể loại: {{$anime['category']}}</span>
                    <span class="mb-2">Quốc gia: {{$anime['country']}}</span>
                    <span class="mb-2">Đạo diễn: {{$anime['director']}}</span>
                    <span class="mb-2">Diễn viên: {{$anime['actor']}}</span>
                </div>

                <div class="mt-12 w-56 flex justify-between">
                    @if ($anime['trailer_url'])
                        <a href="{{$anime['trailer_url']}}" class="bg-gray-500 px-6 py-3 font-semibold rounded" target="blank"><button>Trailer</button></a>
                    @endif
                    <a href="{{route('movies.play', $anime['slug'])}}" class="bg-orange-500 px-6 py-3 font-semibold rounded"><button>Xem phim</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
