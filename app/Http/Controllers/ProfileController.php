<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load([
            'reviews.movie',
            'followedActors'
        ]);

        return view('profile', [
            'user' => $user,
            'isOwner' => true,
            'badges' => $user->getBadges()
        ]);
    }

    public function showPublic(User $user)
    {
        $user->load(['reviews.movie', 'followedActors']);

        return view('profile', [
            'user' => $user,
            'isOwner' => auth()->check() && auth()->id() === $user->id,
            'badges' => $user->getBadges()
        ]);
    }

    public function showByUsername(string $username)
    {
        $user = User::where('username', $username)
            ->with(['reviews.movie', 'followedActors'])
            ->firstOrFail();

        return view('profile', [
            'user' => $user,
            'isOwner' => auth()->check() && auth()->id() === $user->id,
            'badges' => $user->getBadges()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'nullable|string|max:50|alpha_dash|unique:users,username,' . $user->id,
            'avatar'   => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            $data['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Profile updated');
    }
}
