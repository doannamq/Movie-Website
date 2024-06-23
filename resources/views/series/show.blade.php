@extends('layouts.main')
@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{$serie['poster_url']}}" alt="parasite" class="w-64 md:w-96">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{$serie['name']}}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                    <span class="mt-2">Ngày công chiếu: {{$serie['created']}}</span>
                    <span class="mx-2">|</span>
                    <span class="mt-2">Cập nhật: {{$serie['modified']}}</span>
                </div>

                <p class="my-4">{{$serie['content']}}</p>

                <div class="flex flex-col text-gray-400 mt-1" >
                    <span class="mb-2">Trạng thái: {{$serie['status']}}</span>
                    <div class="mb-2 flex">
                        <p>{{$serie['episode_current']}}</p>
                        <p class="mx-2">|</p>
                        <p>{{$serie['time']}}</p>
                    </div>
                    <span class="mb-2">Thể loại: {{$serie['category']}}</span>
                    <span class="mb-2">Quốc gia: {{$serie['country']}}</span>
                    <span class="mb-2">Đạo diễn: {{$serie['director']}}</span>
                    <span class="mb-2">Diễn viên: {{$serie['actor']}}</span>
                </div>

                <div class="mt-12 w-56 flex justify-between">
                    @if ($serie['trailer_url'])
                        <a href="{{$serie['trailer_url']}}" class="bg-gray-500 px-6 py-3 font-semibold rounded" target="blank"><button>Trailer</button></a>
                    @endif
                    <a href="{{route('movies.play', $serie['slug'])}}" class="bg-orange-500 px-6 py-3 font-semibold rounded"><button>Xem phim</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
