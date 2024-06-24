<div class="relative mt-3 md:mt-0" x-data="{isOpen: true}" @click.away="isOpen = false">
    <input 
        wire:model.live.debounce.500ms="search" 
        type="text" 
        class="bg-gray-800 rounded-full w-64 md:w-64 lg:w-96 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline" 
        placeholder="Nhấn / để tìm kiếm"
        x-ref="search"
        @keydown.window="
            if(event.keyCode === 191){
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab = "isOpen = false"
    >
    <div class="absolute top-0">
        <i class="fa-solid fa-magnifying-glass text-gray-500 w-4 mt-2 ml-2 text-sm"></i>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>

    @if (strlen($search) >= 2)
        <div class="absolute bg-gray-800 text-sm rounded w-64 mt-4 z-50" 
        x-show.opacity="isOpen"
        @keydown.escape.window="isOpen = false"
        >    
            @if (count($searchResults) > 0)    
                <ul> 
                    @foreach ($searchResults as $result)
                        <li class="border-b border-gray-700">
                            <a 
                                href="{{route('movies.show', $result['slug'])}}" 
                                class=" hover:bg-gray-700 px-3 py-3 flex items-center"
                                @if ($loop->last)
                                    @keydown.tab="isOpen = false"
                                @endif
                            >
                                @if ($result['poster_url'])
                                    <img src="{{'https://img.phimapi.com/'.$result['poster_url']}}" alt="poster" class="w-8">
                                @else
                                    <img src="https://via.placeholder.com/50x75" alt="" class="w-8">
                                @endif
                                
                                <span class="ml-4">{{ $result['name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="px-4 py-6 text-lg">Không tìm thấy phim</p>
            @endif
        </div>
    @endif
</div>

