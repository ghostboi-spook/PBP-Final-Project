<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class WatchlistController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $movies = $user->watchlists()->with('actors')->get();

        return view('watchlist', compact('movies'));
    }

    public function toggle(Movie $movie)
    {
        $user = auth()->user();

        if ($user->watchlists()->where('movie_id', $movie->id)->exists()) {
            $user->watchlists()->detach($movie->id);
            return back()->with('success', 'Removed from Watchlist.');
        }

        $user->watchlists()->attach($movie->id, ['added_at' => now()]);
        return back()->with('success', 'Added to Watchlist.');
    }
}
