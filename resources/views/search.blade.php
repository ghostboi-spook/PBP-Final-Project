@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>IMIX - Search Result</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    @vite([
        'resources/css/global.css',
        'resources/css/components.css',
        'resources/css/layout.css',
        'resources/css/search.css',
        'resources/js/common.js',
        'resources/js/search.js'
    ])
</head>

<body class="bg-[#070707] text-slate-100 min-h-screen">

    <!-- Header -->
    <header class="flex items-center justify-between p-4 border-b border-neutral-800">
        <a href="{{ route('home') }}" class="font-bold text-lg">
            IMIX
        </a>

        <!-- Search Form -->
        <form action="{{ route('search') }}" method="GET" class="relative">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Search movies or people..."
                class="w-64 px-3 py-2 rounded bg-neutral-800 text-sm text-white focus:outline-none focus:ring-2 focus:ring-green-500"
            >
            <button
                type="submit"
                class="absolute right-2 top-1/2 -translate-y-1/2 text-neutral-400 hover:text-white"
            >
                🔍
            </button>
        </form>
    </header>

    <!-- Search Content -->
    <div class="search-container p-6 max-w-5xl mx-auto">
        <h1 class="text-xl font-semibold mb-6">
            Search "{{ $q }}"
        </h1>

        <!-- Movies Section -->
        <div class="mb-10">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">Movies & TV</h2>
                <span class="text-neutral-400 text-sm">
                    Found {{ $movies->count() }} results
                </span>
            </div>

            <div class="space-y-4">
                @forelse ($movies as $movie)
                    <a href="{{ route('konten', $movie) }}" class="block p-4 bg-neutral-900 rounded flex gap-4 hover:bg-neutral-800 transition">
                        @if ($movie->poster_path)
                            <img
                                src="{{ asset('storage/' . $movie->poster_path) }}"
                                alt="{{ $movie->title }}"
                                class="w-20 rounded"
                            >
                        @endif

                        <div>
                            <h3 class="font-semibold text-base">
                                {{ $movie->title }}
                            </h3>

                            <p class="text-sm text-neutral-400 mt-1">
                                {{ Str::limit($movie->description, 120) }}
                            </p>

                            <p class="text-xs text-neutral-500 mt-2">
                                ⭐ {{ $movie->rating_avg }}
                                @if ($movie->year)
                                    · {{ $movie->year }}
                                @endif
                            </p>
                        </div>
                    </a>
                @empty
                    <p class="text-neutral-400">
                        No movies found.
                    </p>
                @endforelse
            </div>
        </div>

        <!-- People Section -->
        <div>
            <h2 class="text-lg font-semibold mb-4">
                People
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse ($actors as $actor)
                    <div class="p-3 bg-neutral-900 rounded text-center">
                        <p class="font-medium">
                            {{ $actor->name }}
                        </p>
                    </div>
                @empty
                    <p class="text-neutral-400 col-span-full">
                        No people found.
                    </p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="main-footer" class="mt-10 p-4 text-center text-neutral-500 text-sm">
        © {{ date('Y') }} IMIX
    </footer>

</body>
</html>
