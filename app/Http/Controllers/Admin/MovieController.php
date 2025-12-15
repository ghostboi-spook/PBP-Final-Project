<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use App\Models\Actor;

class MovieController extends Controller
{
    protected function ensureAdmin()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            abort(403);
        }
    }

    public function index()
    {
        $this->ensureAdmin();
        $movies = Movie::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        $this->ensureAdmin();
        $movie = new Movie();
        $actors = Actor::orderBy('name')->get();

        return view('admin.movies.form', compact('movie', 'actors'));
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'nullable|integer',
            'runtime' => 'nullable|integer',
            'certificate' => 'nullable|string|max:10',
            'tagline' => 'nullable|string|max:255',

            'poster_path' => 'nullable|string|max:255',
            'backdrop_path' => 'nullable|string|max:255',
            'trailer_url' => 'nullable|url',

            'genres' => 'nullable|string',
            'description' => 'nullable|string',

            'language' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:100',
            'release_date' => 'nullable|date',

            'director' => 'nullable|string|max:255',
            'writer' => 'nullable|string|max:255',
            'production_companies' => 'nullable|string|max:255',
            'filming_locations' => 'nullable|string|max:255',
        ]);

        $data['genres'] = !empty($data['genres'])
            ? array_values(array_filter(array_map('trim', explode(',', $data['genres']))))
            : null;

        $movie = Movie::create($data);

        if ($request->has('actors')) {
            $syncData = [];

            foreach ($request->actors as $actorId => $actorData) {
                if (isset($actorData['attach'])) {
                    $syncData[$actorId] = [
                        'character_name' => $actorData['character_name'] ?? null,
                    ];
                }
            }

            $movie->actors()->sync($syncData);
        }

        return redirect()
            ->route('admin.movies.index')
            ->with('success', 'Movie created');
    }

    public function edit($id)
    {
        $this->ensureAdmin();
        $movie = Movie::with('actors')->findOrFail($id);
        $actors = Actor::orderBy('name')->get();
        return view('admin.movies.form', compact('movie', 'actors'));
    }

    public function update(Request $request, $id)
    {
        $this->ensureAdmin();

        $movie = Movie::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'nullable|integer',
            'runtime' => 'nullable|integer',
            'certificate' => 'nullable|string|max:10',
            'tagline' => 'nullable|string|max:255',

            'poster_path' => 'nullable|string|max:255',
            'backdrop_path' => 'nullable|string|max:255',
            'trailer_url' => 'nullable|url',

            'genres' => 'nullable|string',
            'description' => 'nullable|string',

            'language' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:100',
            'release_date' => 'nullable|date',

            'director' => 'nullable|string|max:255',
            'writer' => 'nullable|string|max:255',
            'production_companies' => 'nullable|string|max:255',
            'filming_locations' => 'nullable|string|max:255',
        ]);

        $data['genres'] = !empty($data['genres'])
            ? array_values(array_filter(array_map('trim', explode(',', $data['genres']))))
            : null;

        $movie->update($data);

        if ($request->has('actors')) {
            $syncData = [];

            foreach ($request->actors as $actorId => $actorData) {
                if (isset($actorData['attach'])) {
                    $syncData[$actorId] = [
                        'character_name' => $actorData['character_name'] ?? null,
                    ];
                }
            }

            $movie->actors()->sync($syncData);
        } else {
            $movie->actors()->detach();
        }

        return redirect()
            ->route('admin.movies.index')
            ->with('success', 'Movie updated');
    }


    public function destroy($id)
    {
        $this->ensureAdmin();
        Movie::findOrFail($id)->delete();

        return redirect()
            ->route('admin.movies.index')
            ->with('success', 'Movie deleted');
    }
}
