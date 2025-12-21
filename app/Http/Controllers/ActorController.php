<?php

namespace App\Http\Controllers;

use App\Models\Actor;

class ActorController extends Controller
{
    public function show(Actor $actor)
    {
        $actor->load(['movies', 'followers']);

        $isFollowing = auth()->check()
            ? auth()->user()->followedActors->contains($actor->id)
            : false;

        return view('actor', compact('actor', 'isFollowing'));
    }
}
