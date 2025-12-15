<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Actor;

class ActorFollowController extends Controller
{
    public function toggle(Actor $actor)
    {
        $user = Auth::user();

        if (!$user) {
            return back();
        }

        if ($user->followedActors()->where('actor_id', $actor->id)->exists()) {
            $user->followedActors()->detach($actor->id);
        } else {
            $user->followedActors()->attach($actor->id);
        }

        return back();
    }
}
