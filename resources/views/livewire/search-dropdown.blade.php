<div class="relative" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <div class="hidden sm:flex sm:items-center sm:ml-auto">
        <div class="relative">
            <input
                wire:model.debounce.500ms="search"
                class="rounded-full w-64 px-4 py-1 text-black"
                type="search"
                placeholder="Search"
                x-ref = "search"
                @keydown.window="
                    if (event.keyCode == 191)
                    {
                        $refs.search.focus();
                    }
                "
                @focus= "isOpen = true"
                @keydown="isOpen = true"
                @keydown.escape.window="isOpen = false"
                @keydown.shift.tab="isOpen = false"
            >
        </div>
    </div>

    
    @if (strlen($search) >= 2)
        <div class="z-50 absolute w-64 text-sm bg-gray-400 rounded mt-4" x-show="isOpen">
            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                        <li class="border-b border-gray-300">
                            <a
                                 href="{{ route('movies.show', $result['id']) }}" class="block hover:bg-gray-300 px-3 py-3 transiontion ease-in-out flex items-center">
                                <img class="w-8 mx-2" src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="movie-_poster">
                                <span>{{ $result['title'] }}</span>
                            </a>
                        </li>                
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No Results for {{$search}}</div>
            @endif
        </div>
    @endif
</div>
