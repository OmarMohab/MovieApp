<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('TV Shows') }}
        </h2>
    </x-slot>

    <!-- Popular Shows -->
    <div class="container mx-auto px-4 pt-16">
        <h2 class="uppercase tracking-wider text-lg font-semibold">Popular Shows</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
            @foreach ($popularShows as $popularShow)
                <x-tv-card :tvshow="$popularShow"/>
            @endforeach
        </div>
    </div>
    <!-- End Popular Shows -->

    <!-- Top Rated Shows -->
    <div class="container mx-auto px-4 pt-16">
        <h2 class="uppercase tracking-wider text-lg font-semibold">Top Rated Showss</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
            @foreach ($topRatedShows as $topRatedShow)
                <x-tv-card :tvshow="$topRatedShow"/>
            @endforeach
        </div>
    </div>
    <!-- End Top Rated Shows -->
    
</x-app-layout>