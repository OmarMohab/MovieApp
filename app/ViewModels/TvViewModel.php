<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularShows;
    public $topRatedShows;
    public $genres;

    public function __construct($popularShows, $topRatedShows, $genres)
    {
        $this->popularShows = $popularShows;
        $this->topRatedShows = $topRatedShows;
        $this->genres = $genres;
    }

    public function popularShows()
    {
        return $this->formatShows($this->popularShows);
    }

    public function topRatedShows()
    {
        return $this->formatShows($this->topRatedShows);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    public function formatShows($shows)
    {
        return collect($shows)->map(function($show){
            
            $genresFormatted = collect($show['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($show)->merge([
                'poster_path' => "https://image.tmdb.org/t/p/w500/" . $show['poster_path'],
                'vote_average' => $show['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($show['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted
            ]);
        });
    }
}
