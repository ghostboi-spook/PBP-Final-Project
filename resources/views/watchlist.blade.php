<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Your Watchlist — IMIX</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite([
      'resources/css/global.css',
      'resources/css/components.css',
      'resources/css/layout.css',
      'resources/css/watchlist.css',
      'resources/js/common.js',
      'resources/js/watchlist.js'])
</head>
<body class="bg-[#070707] text-neutral-200">
    <header id="main-header"></header>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-8">
        <!-- Header -->
        <section class="header-wrap bg-[#0d0d0d] border border-neutral-800 rounded-lg p-6 mb-6">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white">Your Watchlist</h1>
            <p class="text-neutral-400 mt-2">Track and manage your movie lists.</p>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Main content -->
            <section class="lg:col-span-2 space-y-4">
                <h2 class="text-xl font-semibold text-white mb-3">Watch list</h2>
                @php
                    $user = auth()->user();
                    $movies = $user?->watchlists;
                @endphp

                @if($movies && $movies->count() > 0)
                    @foreach($movies as $movie)
                        <div class="flex items-center gap-4 bg-[#0f0f0f] border border-neutral-800 rounded-lg p-4 mb-3">
                            <img 
                                src="{{ $movie->poster_path 
                                    ? asset('storage/' . $movie->poster_path) 
                                    : 'https://via.placeholder.com/100x150' }}" 
                                alt="{{ $movie->title }}" 
                                class="w-20 h-28 object-cover rounded"
                            >

                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-white">
                                    {{ $movie->title }}
                                </h3>
                                <p class="text-neutral-400 text-sm">
                                    {{ $movie->year }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-neutral-400 text-sm">
                        No movies in your watchlist yet.
                    </p>
                @endif
            </section>
        </div>
    </main>

    <footer id="main-footer"></footer>
</body>
</html>
