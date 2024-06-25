@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-4">
    <div class="my-3" x-data="{ activeSlide: 1, slides: [1, 2, 3, 4, 5], changeSlide() { 
        this.activeSlide = this.activeSlide === this.slides.length ? 1 : this.activeSlide + 1 
    } }" x-init="setInterval(() => { changeSlide() }, 5000)">
        <div class="relative">
            <!-- Slides -->
            @php
                $slideIndex = 1;
            @endphp
    
            @foreach ($detailMovies as $movie)
                <div x-show="activeSlide === {{ $slideIndex }}" class="relative" style="height: 500px">
                    <img src="{{ $movie['thumb_url'] }}" alt="poster" class="w-full h-full object-cover object-top">
                    <div class="absolute top-0 bottom-0 left-0 right-1/2 bg-gray-700 bg-opacity-70 text-white">
                        <div class="px-5 py-4">
                            <p class="font-semibold text-3xl">{{$movie['name']}}</p>
                            <div class="flex w-1/2 justify-between mt-2 sm:flex-col md:flex-col lg:flex-row">
                                <p>{{$movie['episode_current']}}</p>
                                <p><i class="fa-solid fa-clock mr-2"></i>{{$movie['time']}}</p>
                                <p><i class="fa-solid fa-calendar-days mr-2"></i>{{$movie['year']}}</p>
                            </div>
                            <div class="flex mt-2">
                                <p>{{$movie['quality']}}</p>
                                <p class="mx-2">|</p>
                                <p>{{$movie['lang']}}</p>
                            </div>
                            <p class="mt-4 truncate">{{$movie['content']}}</p>
                            <div class="mt-4">
                                <a href="{{route("movies.show", $movie['slug'])}}"><button class="bg-orange-500 px-4 py-2 rounded">Xem thêm</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $slideIndex++;
                @endphp
            @endforeach
    
            <!-- Navigation buttons -->
            <div class="box flex flex-space-between flex-middle">
                <button 
                    class="b-0 unrounded btn-icon bg-color-transparent cursor-pointer font-bold absolute bottom-4 left-4 bg-gray-500 px-4 py-3 rounded-full" 
                    x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">←</button>
                <button 
                    class="b-0 unrounded btn-icon bg-color-transparent cursor-pointer absolute bottom-4 right-4 bg-gray-500 px-4 py-3 rounded-full" 
                    x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">→</button>
            </div>
        </div>
    
        <!-- Slide Indicators -->
        <div class="flex flex-center px-3">
            <template x-for="slide in slides" :key="slide">
                <button style="width: 2rem; height: 1rem" class="rounded-pill b-thin mx-1 cursor-pointer" :class="{
                    'bg-color-success': activeSlide === slide,
                    '': activeSlide !== slide
                }" x-on:click="activeSlide = slide"></button>
            </template>
        </div>
    </div>
    {{--End slide show --}}

    {{-- Phim mới cập nhật --}}
    <div class="new-movies">
        <h2 class="uppercase tracking-wider text-orange-500 font-bold">Phim mới cập nhật</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($newMovies as $movie)
                <x-movie-card :movie="$movie"/>
            @endforeach
        </div>
        {{-- <div class="flex justify-center items-center mb-4">
            <div class="w-96 flex justify-around">
                <a href="{{ route('movies.index', ['page' => $previous]) }}">
                    <button class="bg-gray-500 text-white font-semibold px-4 py-2 rounded">Previous</button>
                </a>
                <a href="{{ route('movies.index', ['page' => $next]) }}">
                    <button class="bg-gray-500 text-white font-semibold px-4 py-2 rounded">Next</button>
                </a>
            </div>
        </div> --}}
    </div>
</div>
@endsection