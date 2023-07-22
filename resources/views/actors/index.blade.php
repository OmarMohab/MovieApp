<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Actors') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 pt-16">
        <!-- Popular Actors -->
        <h2 class="uppercase tracking-wider text-lg font-semibold">Popular Actors</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
            @foreach ($popularActors as $actor)
                <div class="actor mt-8">
                    <a href="{{route('actors.show', $actor['id'])}}">
                        <img class="hover:opacity-75 transition ease-in-out duration-150" src="{{ $actor['profile_path']}}" alt="profile_image">
                    </a>
                    <div class="mt2">
                        <a class="text-lg hover:text-gray-300" href="{{route('actors.show', $actor['id'])}}">{{ $actor['name'] }}</a>
                        <div class="text-sm truncate text-gray-400">
                            {{ $actor['known_for'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="page-load-status my-8">
        <div class="flex justify-center">
            <p class="infinite-scroll-request">Loading...</p>
        </div>
        <p class="infinite-scroll-last">End of Content</p>
        <p class="infinite-scroll-error">Error</p>
    </div>

    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        let elem = document.querySelector('.grid');
        let infScroll = new InfiniteScroll( elem, {
        // options
        path: '/actors/page/@{{#}}',
        append: '.actor',
        history: false,
        status: '.page-load-status'
        });
    
        // element argument can be a selector string
        //   for an individual element
        //let infScroll = new InfiniteScroll( '.container', {
        // options
        //});
    </script>
</x-app-layout>
