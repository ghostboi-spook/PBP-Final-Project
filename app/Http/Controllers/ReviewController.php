<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'rating'  => 'required|integer|min:1|max:10',
            'title'   => 'nullable|string|max:255',
            'content' => 'nullable|string',
        ]);

        $existing = Review::where('user_id', Auth::id())
            ->where('movie_id', $movie->id)
            ->first();

        if ($existing) {
            return back()->with('error', 'You already reviewed this movie.');
        }

        Review::create([
            'user_id'  => Auth::id(),
            'movie_id' => $movie->id,
            'rating'   => $data['rating'],
            'title'    => $data['title'],
            'content'  => $data['content'],
        ]);

        $this->updateMovieRating($movie);

        return back()->with('success', 'Review added.');
    }

    public function update(Request $request, Movie $movie, Review $review)
    {
        abort_if($review->user_id !== Auth::id(), 403);

        $data = $request->validate([
            'rating'  => 'required|integer|min:1|max:10',
            'title'   => 'nullable|string|max:255',
            'content' => 'nullable|string',
        ]);

        $review->update($data);

        $this->updateMovieRating($movie);

        return back()->with('success', 'Review updated.');
    }

    protected function updateMovieRating(Movie $movie): void
    {
        $movie->update([
            'rating_avg' => round($movie->reviews()->avg('rating'), 1),
            'vote_count' => $movie->reviews()->count(),
        ]);
    }
}