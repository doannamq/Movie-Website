@props(['anime'])
<div class="mt-8 mb-12">
    <a href="{{route("animes.show", $anime['slug'])}}">
        <img src="{{$anime['poster_url']}}" alt="poster" class="hover:opacity-75 transition ease-in-out duration-150 h-96">
    </a>
    <div class="mt-2">
        <a href="#">{{$anime['name']}}</a>
    </div>
    <div class="mt2">
        <p class="text-sm text-gray-400">Năm chiếu: {{$anime['year']}}</p>
    </div>
</div>