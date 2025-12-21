@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actors - Admin Panel</title>

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
                    <h1 class="text-2xl sm:text-3xl font-bold text-white">Actor Management</h1>
                    <p class="text-neutral-400 mt-1 text-sm">Kelola semua aktor dalam database</p>
                </div>
                <a href="{{ route('admin.actors.create') }}"
                    class="px-4 py-2.5 sm:px-5 sm:py-3 bg-green-500 hover:bg-green-400 text-black font-bold rounded-lg transition text-center text-sm sm:text-base">
                    + Tambah Aktor
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-400 flex items-center gap-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
            @forelse($actors as $actor)
                <div class="bg-neutral-900 border border-neutral-800 rounded-xl overflow-hidden hover:border-neutral-700 transition group">
                    <div class="aspect-square bg-neutral-800 relative overflow-hidden">
                        @if($actor->photo_path)
                            <img src="{{ Str::startsWith($actor->photo_path, ['http://', 'https://'])
                                ? $actor->photo_path
                                : asset('storage/' . $actor->photo_path) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-neutral-600">
                            </div>
                        @endif

                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/90 to-transparent p-4">
                            <div class="text-sm text-neutral-400">ID: {{ $actor->id }}</div>
                        </div>
                    </div>

                    <div class="p-4">
                        <h3 class="font-bold text-lg text-white truncate mb-1">{{ $actor->name }}</h3>
                        <div class="text-sm text-neutral-400 space-y-1">
                            <div>{{ ucfirst($actor->gender ?? 'Tidak diketahui') }}</div>
                            <div>{{ $actor->birth_date?->format('d M Y') ?? 'Tanggal lahir tidak diketahui' }}</div>
                        </div>

                        <div class="flex gap-2 mt-4">
                            <a href="{{ route('actor.show', $actor) }}?back={{ route('admin.actors.index') }}"
                                class="flex-1 px-3 py-2 bg-neutral-800 hover:bg-neutral-700 text-neutral-300 rounded-lg text-sm text-center transition">
                                Lihat
                            </a>
                            <a href="{{ route('admin.actors.edit', $actor->id) }}"
                                class="flex-1 px-3 py-2 bg-blue-500/20 hover:bg-blue-500/30 text-blue-400 rounded-lg text-sm text-center transition">
                                Edit
                            </a>
                        </div>

                        <form action="{{ route('admin.actors.destroy', $actor->id) }}" method="POST"
                            onsubmit="return confirm('Hapus aktor ini?')" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button class="w-full px-3 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-400 rounded-lg text-sm transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-12 text-center">
                        <div class="text-6xl mb-4"></div>
                        <div class="text-neutral-500 mb-4">Belum ada aktor.</div>
                        <a href="{{ route('admin.actors.create') }}" class="text-green-400 hover:underline">
                            Tambahkan aktor pertama →
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        @if($actors->hasPages())
            <div class="mt-8">
                {{ $actors->links() }}
            </div>
        @endif
    </main>
</body>

</html>
