<div class="max-w-6xl mx-auto p-6">
    <a href="{{ route('profile.show') }}"
        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-800 text-sm text-neutral-300 hover:border-blue-500 hover:text-blue-400 hover:bg-neutral-900 transition">
        ← Profile
    </a>

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Actors (Admin)</h1>
        <a href="{{ route('admin.actors.create') }}" class="px-3 py-2 bg-green-500 text-black rounded">
            Create Actor
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
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($actors as $actor)
                <tr class="border-b border-neutral-800">
                    <td class="py-2">{{ $actor->id }}</td>

                    <td class="font-medium">
                        {{ $actor->name }}
                    </td>

                    <td>
                        {{ ucfirst($actor->gender ?? '—') }}
                    </td>

                    <td>
                        {{ $actor->birth_date?->format('d M Y') ?? '—' }}
                    </td>

                    <td class="space-x-3">

                        {{-- EDIT --}}
                        <a href="{{ route('admin.actors.edit', $actor->id) }}" class="text-green-400">
                            Edit
                        </a>

                        {{-- VIEW (PUBLIC PAGE) --}}
                        <a href="{{ route('actor.show', $actor) }}?back={{ route('admin.actors.index') }}">
                            View
                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('admin.actors.destroy', $actor->id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Delete this actor?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-4 text-center text-neutral-400">
                        No actors found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $actors->links() }}
    </div>
</div>
