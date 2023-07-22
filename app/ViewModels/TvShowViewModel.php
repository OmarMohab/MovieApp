<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tvshow;
    public $videos;

    public function __construct($tvshow, $videos)
    {
        $this->tvshow = $tvshow;
        $this->videos = $videos;
    }

    public function tvshow()
    {
        return collect($this->tvshow)->merge([
            'poster_path' => "https://image.tmdb.org/t/p/w500/" . $this->tvshow['poster_path'],
            'vote_average' => $this->tvshow['vote_average'] * 10 . '%',
            'first_air_date' => Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->tvshow['credits']['crew'])->take(2),
            'cast' => collect($this->tvshow['credits']['cast'])->take(5),
            'stills' => collect($this->tvshow['images']['backdrops'])->take(6)
        ]);
    }

    public function videos()
    {
        return $this->videos;
    }
}
