@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Watchlist Anda — IMIX</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        window.AUTH_USER = @json(auth()->user());
    </script>

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/watchlist.css') }}">
    <script src="{{ asset('js/common.js') }}"></script>
</head>

<body class="bg-[#070707] text-neutral-200">
    <header id="main-header"></header>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-8">

        <section class="bg-[#0d0d0d] border border-neutral-800 rounded-lg p-6 mb-6">
            <h1 class="text-3xl font-extrabold text-white">Watchlist Anda</h1>
            <p class="text-neutral-400 mt-2">Kelola Film yang Ingin Anda tonton.</p>
        </section>

        @if ($movies->count())
            <div class="space-y-4">
                @foreach ($movies as $movie)
                    <div class="flex items-center gap-4 bg-[#0f0f0f] border border-neutral-800 rounded-lg p-4">

                        <a href="{{ route('konten', $movie->id) }}">
                            <img src="{{ Str::startsWith($movie->poster_path, ['http://', 'https://'])
                                ? $movie->poster_path
                                : asset('storage/' . $movie->poster_path) }}"
                                alt="{{ $movie->title }}"
                                class="w-20 h-28 object-cover rounded hover:opacity-80 transition">
                        </a>

                        <div class="flex-1">
                            <a href="{{ route('konten', $movie->id) }}"
                                class="text-lg font-semibold text-white hover:text-green-400 transition">
                                {{ $movie->title }}
                            </a>

                            <p class="text-neutral-400 text-sm mt-1">
                                {{ $movie->release_date?->format('Y') ?? '—' }}
                            </p>
                        </div>

                        <form action="{{ route('watchlist.toggle', $movie->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="text-sm px-3 py-1 rounded bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition">
                                Remove
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-neutral-400 text-sm">
                No movies in your watchlist yet.
            </p>
        @endif

    </main>

    <footer id="main-footer"></footer>
</body>

</html>
