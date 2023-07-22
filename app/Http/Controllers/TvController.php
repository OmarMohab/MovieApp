<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\TvViewModel;
use App\ViewModels\TvShowViewModel;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $popularShows = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/popular')
            ->json()['results'];

        $topRatedShows = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/top_rated')
            ->json()['results'];
        
        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json()['genres'];

        $viewModel = new TvViewModel($popularShows, $topRatedShows, $genres);
        
            return view('tv.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tvshow = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/' . $id . '?append_to_response=credits,images')
            ->json();

        $videos = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/' . $id . '/videos')
            ->json(['results']);

        $viewModel = new TvShowViewModel(
            $tvshow,
            $videos
        );

        return view('tv.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
