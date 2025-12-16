@php
    use Illuminate\Support\Str;
@endphp

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>IMIX - {{ $actor->name ?? 'Actor' }}</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/global.css', 'resources/css/components.css', 'resources/css/layout.css', 'resources/js/common.js'])

    <style>
        /* Custom styles for actor page */
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        .glass {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.65));
            backdrop-filter: blur(4px);
        }
    </style>
</head>

<body class="bg-black text-white antialiased flex flex-col min-h-screen">
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto px-6 pt-6">
            <a href="{{ request('back', route('home')) }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-800 text-sm text-neutral-300 hover:border-green-500 hover:text-green-400 hover:bg-neutral-900 transition">
                ← Kembali
            </a>

        </div>
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="flex flex-col md:flex-row gap-12">

                <!-- Sidebar / Photo -->
                <div class="w-full md:w-80 flex-none">
                    <div class="rounded-xl overflow-hidden shadow-2xl border-2 border-neutral-800 mb-6">
                        <!-- Actor photo (storage path fallback) -->
                        <img
                            src="{{ $actor->photo_path
                                ? (Str::startsWith($actor->photo_path, ['http://', 'https://'])
                                    ? $actor->photo_path
                                    : asset('storage/' . $actor->photo_path))
                                : asset('images/default-actor.png') }}"
                        alt="{{ $actor->name }}" class="w-full h-auto object-cover">
                    </div>

                    <h3 class="text-xl font-bold text-white mb-4">Informasi Pribadi</h3>

                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-bold text-neutral-400">Jenis Kelamin</h4>
                            <p class="text-white">{{ ucfirst($actor->gender ?? '—') }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-neutral-400">Tanggal Lahir</h4>
                            <p class="text-white">
                                {{ $actor->birth_date ? $actor->birth_date->format('d F Y') . ' (' . $actor->birth_date->age . ' tahun)' : '—' }}
                            </p>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-neutral-400">Tempat Lahir</h4>
                            <p class="text-white">{{ $actor->birth_place ?? '—' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="flex-1">
                    <h1 class="text-5xl font-black text-white mb-6 tracking-tight">{{ $actor->name }}</h1>

                    <div class="flex items-center gap-4 mb-6">
                        @auth
                            <form action="{{ route('actor.follow', $actor) }}" method="POST">
                                @csrf
                                <button
                                    class="px-4 py-2 rounded-lg text-sm font-semibold transition
                                  {{ $isFollowing ? 'bg-green-500 text-black' : 'bg-neutral-800 text-neutral-300 hover:bg-neutral-700' }}">
                                    Ikuti
                                </button>
                            </form>
                        @else
                            <span class="text-xs text-neutral-400">
                                Login untuk mengikuti actor
                            </span>
                        @endauth

                        <div class="text-sm text-neutral-400">
                            {{ $actor->followers->count() }} pengikut
                        </div>
                    </div>

                    <div class="mb-10">
                        <h3 class="text-green-400 font-bold mb-3 uppercase text-sm tracking-wider">Biografi</h3>
                        <div class="text-neutral-300 leading-relaxed space-y-4">
                            {!! nl2br(e($actor->bio ?? 'Biografi belum tersedia.')) !!}
                        </div>
                    </div>

                    <div>
                        <h3 class="text-green-400 font-bold mb-6 uppercase text-sm tracking-wider">
                            Known As
                        </h3>

                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                            @forelse($actor->movies as $movie)
                                <a href="{{ route('konten', $movie) }}?back={{ url()->current() }}"
                                    class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition group">
                                    <div class="aspect-[2/3] bg-neutral-800 relative">
                                        <img src="{{ $movie->poster_path
                                            ? (Str::startsWith($movie->poster_path, ['http://', 'https://'])
                                                ? $movie->poster_path
                                                : asset('storage/' . $movie->poster_path))
                                            : asset('images/poster.jpg') }}"
                                            class="w-full h-full object-cover">
                                    </div>

                                    <div class="p-3">
                                        <h4 class="font-bold text-white text-sm truncate">
                                            {{ $movie->title }}
                                        </h4>
                                        <p class="text-xs text-neutral-500">
                                            {{ $movie->pivot->character_name ?? '—' }}
                                        </p>
                                    </div>

                                </a>
                            @empty
                                <div class="text-neutral-400">
                                    No known credits available.
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer id="main-footer"></footer>

    <!-- Watchlist Alert Modal -->
    <div id="watchlist-alert-modal"></div>


</body>

</html>
