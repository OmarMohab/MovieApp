<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movies') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 pt-16">
        <!-- Popular Movies -->
        <h2 class="uppercase tracking-wider text-lg font-semibold">Popular Movies</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
            @foreach ($popularMovies as $popularMovie)
                <x-movie-card :movie="$popularMovie" :genres="$genres" />
            @endforeach
        </div>
    </div>

    <!-- Now Playing Movies -->
    <div class="container mx-auto px-4 pt-16">
        <h2 class="uppercase tracking-wider text-lg font-semibold">Now Playing</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
            @foreach ($nowPlayingMovies as $nowPlayingMovie)
                <x-movie-card :movie="$nowPlayingMovie" :genres="$genres" />
            @endforeach
        </div>
    </div>
</x-app-layout>