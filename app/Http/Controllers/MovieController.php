<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Movie;

class MovieController extends Controller
{
    public function show(Movie $movie)
    {
        $movie->load(['actors', 'reviews.user']);

        $userReview = auth()->check()
            ? $movie->reviews()->where('user_id', auth()->id())->first()
            : null;

        return view('konten', compact('movie', 'userReview'));
    }
}
