<div class="max-w-6xl mx-auto p-6">
    <a href="{{ route('profile.show') }}"
        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-800 text-sm text-neutral-300 hover:border-blue-500 hover:text-blue-400 hover:bg-neutral-900 transition">
        ← Profile
    </a>

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Movies (Admin)</h1>
        <a href="{{ route('admin.movies.create') }}" class="px-3 py-2 bg-green-500 text-black rounded">
            Create Movie
        </a>
    </div>

    @if (session('success'))
        <div class="p-3 bg-green-600 text-black rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full text-sm border-collapse">
        <thead>
            <tr class="text-left text-neutral-400 border-b border-neutral-800">
                <th class="py-2">ID</th>
                <th>Title</th>
                <th>Year</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($movies as $m)
                <tr class="border-b border-neutral-800">
                    <td class="py-2">{{ $m->id }}</td>
                    <td class="font-medium">{{ $m->title }}</td>
                    <td>{{ $m->year ?? '—' }}</td>
                    <td>{{ $m->rating_avg }}</td>
                    <td>
                        <a href="{{ route('admin.movies.edit', $m->id) }}" class="text-green-400 mr-3">
                            Edit
                        </a>

                        <a href="{{ route('konten', $m) }}?back={{ route('admin.movies.index') }}"
                            class="text-blue-400 mr-3">
                            View
                        </a>


                        <form action="{{ route('admin.movies.destroy', $m->id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Delete this movie?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-4 text-center text-neutral-500">
                        No movies found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $movies->links() }}
    </div>
</div>
