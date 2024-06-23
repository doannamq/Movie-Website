@extends('layouts.main')

@section('content')

<div x-data="{ 
    currentEpisode: '{{ $episodes[0]['link_embed'] }}',
    updateUrl(slug) {
        history.pushState(null, '', `?episode=${slug}`);
        this.currentEpisode = this.$refs[`episode_${slug}`].dataset.link;
    }
}" class="container mx-auto">
    <div class="my-4">
        <iframe x-bind:src="currentEpisode" width="100%" height="650" frameborder="0" allowfullscreen></iframe>
    </div>

    <div class="flex flex-wrap">
        @foreach ($episodes as $episode)
            <div>
                @if ($episode['link_embed'])
                    <div class="mt-4">
                        <button
                            x-ref="episode_{{ $episode['slug'] }}"
                            data-link="{{ $episode['link_embed'] }}"
                            @click="updateUrl('{{ $episode['slug'] }}')"
                            class="inline-block bg-gray-500 text-white rounded font-semibold mr-2 px-3 py-2 hover:bg-gray-600 transition ease-in-out duration-150"
                        >
                            <span>{{ $episode['name'] }}</span>
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>

@endsection