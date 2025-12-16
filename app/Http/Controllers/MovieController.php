<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\Actor;

class MovieController extends Controller
{
    /**
     * Movie detail page
     */
    public function show(Movie $movie)
    {
        $movie->load(['actors', 'reviews.user']);

        $userReview = auth()->check()
            ? $movie->reviews()->where('user_id', auth()->id())->first()
            : null;

        return view('konten', compact('movie', 'userReview'));
    }

    /**
     * Search movies & actors
     */
    public function search(Request $request)
    {
        $q = $request->query('q');

        if (!$q) {
            return redirect()->route('home');
        }

        $movies = Movie::where('title', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->orderByDesc('rating_avg')
            ->get();

        $actors = Actor::where('name', 'like', "%{$q}%")->get();

        return view('search', compact('q', 'movies', 'actors'));
    }
}
