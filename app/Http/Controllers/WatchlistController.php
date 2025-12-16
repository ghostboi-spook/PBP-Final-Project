<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;

class WatchlistController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $watchlists = $user->watchlists()->get();

        $activeWatchlist = $watchlists->first();

        return view('watchlist', compact('watchlists', 'activeWatchlist'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        auth()->user()->watchlists()->create(['name' => $request->name]);
        return redirect()->route('watchlist.index');
    }

    public function show(Watchlist $watchlist)
    {
        $user = auth()->user();

        abort_if($watchlist->user_id !== $user->id, 403);

        $watchlists = $user->watchlists()->get();
        $activeWatchlist = $watchlist;

        return view('watchlist', compact('watchlists', 'activeWatchlist'));
    }

    public function destroy(Watchlist $watchlist)
    {
        $user = auth()->user();
        abort_if($watchlist->user_id !== $user->id, 403);

        $watchlist->delete();

        return redirect()->route('watchlist.index');
    }
}
