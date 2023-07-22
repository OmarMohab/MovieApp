<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show') }}
        </h2>
    </x-slot>

    <!-- Show Info -->
    <div class="show-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{ $tvshow['poster_path'] }}" alt="Once Upon a Time in America Poster" class="w-96" style="width: 24rem">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $tvshow['name'] }}</h2>
                <div class="flex items-center text-gray:400 mt-1">
                    <svg id="star" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                        <style>#star{fill:#d1d100}</style> <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                    </svg>
                    <span class="ml-1">{{ $tvshow['vote_average'] }}</span>
                    <span class="mx-2s">|</span>
                    <span class="ml-1">{{ $tvshow['first_air_date'] }}</span>
                    <span class="mx-2s">|</span>
                    <span class="ml-2">
                        {{ $tvshow['genres'] }}
                    </span>
                </div>

                <p class="mt-8">
                    {{ $tvshow['overview'] }}
                </p>

                <div class="mt-12">
                    <div class="flex mt-4">
                        @foreach ($tvshow['created_by'] as $creator)
                            <div class="mr-8">
                                <div>{{$creator['name']}}</div>
                                <div class="text-sm text-gray-400">Creator</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div x-data="{ isOpen: false }">
                    @if ($videos)
                        <div class="mt-12">
                            <button
                                @click="isOpen = true" 
                                class="flex inline-flex items-center bg-blue-500 text-gray-500 rounded font-semibold  px-5 py-4 hover:bg-blue-600 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" height="0.75em" viewBox="0 0 384 512">
                                    <path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/>
                                </svg>
                                <span class="ml-2 text-black">Play Trailer</span>
                            </button>
                        </div>
                    @endif
                    <!-- Trailer Modal -->
                    <div
                        style="background-color: rgba(0, 0, 0, .5)"
                        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                        x-show.transition.opacity="isOpen"
                    >
                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                            <div class="bg-gray-900 rounded">
                                <div class="flex justify-end pr-4 pt-2">
                                    <button @click="isOpen = false" class="text-3xl leading-none hover:text-gray-300" style="color: red">&times;</button>
                                </div>
                                <div class="modal-body px-8 py-8">
                                    <div class="responsive-container overflow-hidden relative" style="padding-top:56%">
                                        <iframe
                                            class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                            width="560"
                                            height="315"
                                            @if ($videos)
                                                src="https://www.youtube.com/embed/{{$videos[0]['key'] }}"  
                                            @endif
                                            style="border: 0"
                                            allow="autoplay; encrypt-media"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Show Info -->

    <!-- Cast -->
    <div class="show-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($tvshow['cast'] as $actor)
                        <div class="mt-8">
                            <a href="{{ route('actors.show', $actor['id']) }}">
                                <img src="{{ "https://image.tmdb.org/t/p/w500/" . $actor['profile_path'] }}"" alt="Movie Poster" class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                            <div class="mt-2 text-sm">
                                <a href="{{ route('actors.show', $actor['id']) }}" class="txt-lg mt-2 hover:text-gray:300">{{ $actor['name'] }}</a>
                            </div>
                            <div class="mt-2 text-sm">
                                <a href="#" class="txt-lg text-gray-400 mt-2 hover:text-gray:300">{{ $actor['character'] }}</a>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Cast -->

    <!-- Movie Stills -->
    <div x-data="{ isOpen: false, image: '' }">
        <div class="movie-stills border-b border-gray-800" @click.away="isOpen=false">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-4xl font-semibold">Stills</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach ($tvshow['stills'] as $still)
                        <div class="mt-8">
                            <a href="#" 
                                @click.prevent="isOpen = true
                                                image='{{ "https://image.tmdb.org/t/p/original/" . $still['file_path'] }}'"
                            >
                                <img src="{{ "https://image.tmdb.org/t/p/w500/" . $still['file_path'] }}" alt="Movie Backdrop" class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div
                    style="background-color: rgba(0, 0, 0, .5)"
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    x-show.transition.opacity="isOpen"
                >
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button 
                                    @click="isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300 color-red"
                                    style="color: red"
                                >   &times;
                                </button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <img :src="image" alt="Movie still">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>