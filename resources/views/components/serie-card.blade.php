@props(['movie'])
<div class="mt-8 mb-12">
    <a href="{{route("series.show", $movie['slug'])}}">
        <img src="{{$movie['poster_url']}}" alt="poster" class="hover:opacity-75 transition ease-in-out duration-150 h-96">
    </a>
    <div class="mt-2">
        <a href="{{route("series.show", $movie['slug'])}}">{{$movie['name']}}</a>
    </div>
    <div class="mt2">
        <p class="text-sm text-gray-400">Năm chiếu: {{$movie['year']}}</p>
    </div>
</div>