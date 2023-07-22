<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

use function PHPSTORM_META\map;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $socials;
    public $credits;

    public function __construct($actor, $socials, $credits)
    {
        $this->actor = $actor;
        $this->socials = $socials;
        $this->credits = $credits;
    }

    public function actor()
    {
        return collect($this->actor)->merge([
            'birthday' => Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->actor['birthday'])->age,
            'profile_path' => "https://image.tmdb.org/t/p/w500/" . $this->actor['profile_path'], 
        ]);
    }

    public function socials(){
        return collect($this->socials)->merge([
            'facebook' => 'https://www.facebook.com/' . '/' . $this->socials['facebook_id'],
            'twitter' => 'https://www.twitter.com/' . '/' . $this->socials['twitter_id'],
            'instagram' => 'https://www.instagram.com' . '/' . $this->socials['instagram_id']
        ]);
    }

    public function knownForMovies()
    {
        $castMovies = collect($this->credits)->get('cast');

        
        return collect($castMovies)->sortByDesc('popularity')->take(5)->map(function($movie){
            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else{
                $title = 'Untitled';
            }
            return collect($movie)->merge([
                'poster_path' => $movie['poster_path']
                    ? 'https://image.tmdb.org/t/p/w185' . $movie['poster_path']
                    : 'https://via.placeholder.com/185x278',
                'title' => $title,
                'linkToPage' => $movie['media_type'] == 'movie' ? route('movies.show', $movie['id']) : route('tv.show', $movie['id'])
            ]);
        });
    }

    public function credits()
    {
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)->map(function($movie){

            if (isset($movie['release_date'])) {
                $releaseDate = $movie['release_date'];
            } elseif (isset($movie['first_air_date'])){
                $releaseDate = $movie['first_air_date'];
            } else {
                $releaseDate = '';
            } 

            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])){
                $title = $movie['name'];
            } else {
                $releaseDate = '';
            } 

            return collect($movie)->merge([
                'release_date' => $releaseDate,
                'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                'title'=> $title,
                'character' => isset($movie['character']) ? $movie['character'] : ''
            ]);

        })->sortByDesc('release_date');
    }
}
