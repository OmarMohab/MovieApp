<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_the_main_page_shows_correct_info(): void
    {
        $response = $this->get(route('movies.index'));

        $response->assertStatus(200);
    }
}
