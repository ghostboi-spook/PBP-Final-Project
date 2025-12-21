@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies - Admin Panel</title>

    <script>
        window.AUTH_USER = @json(auth()->user());
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/global.css', 'resources/css/components.css', 'resources/css/layout.css', 'resources/js/common.js'])
</head>

<body class="bg-[#070707] text-white min-h-screen">

    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-8">
        <div class="mb-6">
            <a href="{{ route('profile.show') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-800 text-sm text-neutral-300 hover:border-green-500 hover:text-green-400 hover:bg-neutral-900 transition">
                ← Kembali
            </a>
        </div>

        <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-4 sm:p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white">Movie Management</h1>
                    <p class="text-neutral-400 mt-1 text-sm">Kelola semua film dalam database</p>
                </div>
                <a href="{{ route('admin.movies.create') }}"
                    class="px-4 py-2.5 sm:px-5 sm:py-3 bg-green-500 hover:bg-green-400 text-black font-bold rounded-lg transition text-center text-sm sm:text-base">
                    + Tambah Film
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-400 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="hidden md:block bg-neutral-900 border border-neutral-800 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-neutral-800/50 text-left text-neutral-400 text-sm uppercase tracking-wide">
                            <th class="px-6 py-4 font-semibold">Film</th>
                            <th class="px-6 py-4 font-semibold">Tahun</th>
                            <th class="px-6 py-4 font-semibold">Rating</th>
                            <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-neutral-800">
                        @forelse($movies as $m)
                            <tr class="hover:bg-neutral-800/30 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-16 rounded overflow-hidden bg-neutral-800 flex-shrink-0">
                                            @if($m->poster_path)
                                                <img src="{{ Str::startsWith($m->poster_path, ['http://', 'https://'])
                                                    ? $m->poster_path
                                                    : asset('storage/' . $m->poster_path) }}"
                                                    class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-semibold text-white">{{ $m->title }}</div>
                                            <div class="text-xs text-neutral-500">ID: {{ $m->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-neutral-300">{{ $m->year ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-yellow-500/20 text-yellow-400 rounded text-sm font-medium">
                                        {{ $m->rating_avg ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('konten', $m) }}?back={{ route('admin.movies.index') }}"
                                            class="px-3 py-2 bg-neutral-800 hover:bg-neutral-700 text-neutral-300 rounded-lg text-sm transition">
                                            Lihat
                                        </a>
                                        <a href="{{ route('admin.movies.edit', $m->id) }}"
                                            class="px-3 py-2 bg-blue-500/20 hover:bg-blue-500/30 text-blue-400 rounded-lg text-sm transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.movies.destroy', $m->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus film ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-3 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-400 rounded-lg text-sm transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="text-neutral-500">
                                        <div>Belum ada film.</div>
                                        <a href="{{ route('admin.movies.create') }}" class="text-green-400 hover:underline mt-2 inline-block">
                                            Tambahkan film pertama →
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($movies->hasPages())
                <div class="px-6 py-4 border-t border-neutral-800">
                    {{ $movies->links() }}
                </div>
            @endif
        </div>

        <div class="md:hidden space-y-4">
            @forelse($movies as $m)
                <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-4">
                    <div class="flex gap-3 mb-3">
                        <div class="w-16 h-20 rounded overflow-hidden bg-neutral-800 flex-shrink-0">
                            @if($m->poster_path)
                                <img src="{{ Str::startsWith($m->poster_path, ['http://', 'https://'])
                                    ? $m->poster_path
                                    : asset('storage/' . $m->poster_path) }}"
                                    class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-white truncate">{{ $m->title }}</h3>
                            <div class="text-sm text-neutral-400 mt-1">{{ $m->year ?? '—' }}</div>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-yellow-500/20 text-yellow-400 rounded text-xs font-medium mt-1">
                                {{ $m->rating_avg ?? '—' }}
                            </span>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('konten', $m) }}?back={{ route('admin.movies.index') }}"
                            class="flex-1 px-3 py-2 bg-neutral-800 hover:bg-neutral-700 text-neutral-300 rounded-lg text-sm text-center transition">
                            Lihat
                        </a>
                        <a href="{{ route('admin.movies.edit', $m->id) }}"
                            class="flex-1 px-3 py-2 bg-blue-500/20 hover:bg-blue-500/30 text-blue-400 rounded-lg text-sm text-center transition">
                            Edit
                        </a>
                        <form action="{{ route('admin.movies.destroy', $m->id) }}" method="POST"
                            onsubmit="return confirm('Hapus film ini?')" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button class="w-full px-3 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-400 rounded-lg text-sm transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-8 text-center">
                    <div class="text-neutral-500">Belum ada film.</div>
                    <a href="{{ route('admin.movies.create') }}" class="text-green-400 hover:underline mt-2 inline-block">
                        Tambahkan film pertama →
                    </a>
                </div>
            @endforelse

            @if($movies->hasPages())
                <div class="mt-4">
                    {{ $movies->links() }}
                </div>
            @endif
        </div>
    </main>
</body>

</html>
