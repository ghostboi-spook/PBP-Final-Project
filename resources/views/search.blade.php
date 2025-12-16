@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>IMIX - Search Result</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        window.AUTH_USER = @json(auth()->user());
    </script>    

    @vite(['resources/css/global.css', 'resources/css/components.css', 'resources/css/layout.css', 'resources/css/search.css', 'resources/js/common.js', 'resources/js/search.js'])
</head>

<body class="bg-[#070707] text-slate-100 min-h-screen">

    <!-- HEADER (PAKAI COMMON.JS) -->
    <header id="main-header"></header>

    <!-- CONTENT -->
    <div class="search-container p-6 max-w-5xl mx-auto">

        <h1 class="text-xl font-semibold mb-6">
            Search "{{ $q }}"
        </h1>

        <!-- ================= MOVIES ================= -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">Film</h2>
                <span class="text-neutral-400 text-sm">
                    Found {{ $movies->count() }} results
                </span>
            </div>

            <div class="space-y-4">
                @forelse ($movies as $movie)
                    <a href="{{ route('konten', $movie) }}"
                        class="block p-4 bg-neutral-900 rounded flex gap-4 hover:bg-neutral-800 transition">

                        <!-- POSTER -->
                        <div class="w-20 shrink-0">
                            <img src="{{ $movie->poster_path
                                ? (Str::startsWith($movie->poster_path, ['http', 'https'])
                                    ? $movie->poster_path
                                    : asset('storage/' . $movie->poster_path))
                                : asset('images/poster.jpg') }}"
                                alt="{{ $movie->title }}" class="w-full rounded">
                        </div>

                        <!-- INFO -->
                        <div>
                            <h3 class="font-semibold text-base">
                                {{ $movie->title }}
                            </h3>

                            <p class="text-sm text-neutral-400 mt-1">
                                {{ Str::limit($movie->description, 120) }}
                            </p>

                            <p class="text-xs text-neutral-500 mt-2">
                                ⭐ {{ $movie->rating_avg ?? '—' }}
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

        <!-- ================= PEOPLE ================= -->
        <div>
            <h2 class="text-lg font-semibold mb-4">
                Aktor
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse ($actors as $actor)
                    <a href="{{ route('actor.show', $actor) }}"
                        class="bg-neutral-900 p-3 rounded text-center hover:bg-neutral-800 transition">

                        <div class="aspect-square rounded overflow-hidden mb-2 bg-neutral-800">
                            <img src="{{ $actor->photo_path
                                ? (Str::startsWith($actor->photo_path, ['http', 'https'])
                                    ? $actor->photo_path
                                    : asset('storage/' . $actor->photo_path))
                                : asset('images/default-actor.png') }}"
                                alt="{{ $actor->name }}" class="w-full h-full object-cover">
                        </div>

                        <p class="font-medium text-sm truncate">
                            {{ $actor->name }}
                        </p>
                    </a>
                @empty
                    <p class="text-neutral-400 col-span-full">
                        No people found.
                    </p>
                @endforelse
            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <footer id="main-footer"></footer>

</body>

</html>
