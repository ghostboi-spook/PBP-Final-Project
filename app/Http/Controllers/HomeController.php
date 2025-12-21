<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Actor;

class HomeController extends Controller
{
    public function index()
    {
        $carouselMovies = Movie::inRandomOrder()
            ->whereNotNull('poster_path')
            ->take(5)
            ->get();

        $latestMovies = Movie::orderBy('release_date', 'desc')
            ->take(5)
            ->get();

        $popularActors = Actor::withCount('followers')
            ->orderByDesc('followers_count')
            ->take(8)
            ->get();

        $topMovies = Movie::orderByDesc('rating_avg')
            ->take(10)
            ->get();

        return view('welcome', compact(
            'carouselMovies',
            'latestMovies',
            'popularActors',
            'topMovies'
        ));
    }

    public function home()
    {
        return $this->index();
    }
}
