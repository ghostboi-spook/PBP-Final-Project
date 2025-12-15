<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actor;
use Illuminate\Support\Facades\Auth;

class ActorController extends Controller
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

        $actors = Actor::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.actors.index', compact('actors'));
    }

    public function create()
    {
        $this->ensureAdmin();

        $actor = new Actor();
        return view('admin.actors.form', compact('actor'));
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'photo_path' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'gender' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'known_for' => 'nullable|string',
        ]);

        // known_for → array
        if (!empty($data['known_for'])) {
            $data['known_for'] = array_values(
                array_filter(array_map('trim', explode(',', $data['known_for'])))
            );
        } else {
            $data['known_for'] = null;
        }

        Actor::create($data);

        return redirect()
            ->route('admin.actors.index')
            ->with('success', 'Actor created');
    }

    public function edit($id)
    {
        $this->ensureAdmin();

        $actor = Actor::findOrFail($id);
        return view('admin.actors.form', compact('actor'));
    }

    public function update(Request $request, $id)
    {
        $this->ensureAdmin();

        $actor = Actor::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'photo_path' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'gender' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'known_for' => 'nullable|string',
        ]);

        if (!empty($data['known_for'])) {
            $data['known_for'] = array_values(
                array_filter(array_map('trim', explode(',', $data['known_for'])))
            );
        } else {
            $data['known_for'] = null;
        }

        $actor->update($data);

        return redirect()
            ->route('admin.actors.index')
            ->with('success', 'Actor updated');
    }

    public function destroy($id)
    {
        $this->ensureAdmin();

        $actor = Actor::findOrFail($id);
        $actor->delete();

        return redirect()
            ->route('admin.actors.index')
            ->with('success', 'Actor deleted');
    }
}
