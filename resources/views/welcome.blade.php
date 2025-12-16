@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IMIX - Movie Platform</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources\css\global.css', 'resources/css/components.css', 'resources/css/layout.css', 'resources/css/carousel.css', 'resources/js/common.js', 'resources/js/carousel.js'])
    <script>
        window.AUTH_USER = @json(auth()->user());
        window.IMIX_DATA = {
            carouselMovies: @json($carouselMovies),
            latestMovies: @json($latestMovies),
            popularActors: @json($popularActors),
            topMovies: @json($topMovies)
        };
    </script>


</head>

<body class="bg-black text-white">

    <header id="main-header"></header>

    <main class="max-w-7xl mx-auto px-6 py-8">

        <!-- HERO + SIDEBAR -->
        <section id="hero-carousel" class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">

            <div id="carousel-wrapper"
                class="lg:col-span-2 relative w-full h-[500px] rounded-lg overflow-hidden bg-neutral-900">

                @if ($carouselMovies->count())
                    @foreach ($carouselMovies as $index => $movie)
                        <a href="{{ route('konten', $movie) }}?back={{ route('home') }}"
                            class="carousel-item absolute inset-0 {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ $movie->poster_path
                                ? (Str::startsWith($movie->poster_path, ['http://', 'https://'])
                                    ? $movie->poster_path
                                    : asset('storage/' . $movie->poster_path))
                                : asset('images/poster.jpg') }}"
                                class="w-full h-full object-cover" alt="{{ $movie->title }}">
                            <div class="carousel-overlay">
                                <h2 class="text-3xl font-bold">{{ $movie->title }}</h2>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="flex items-center justify-center h-full text-neutral-400">
                        Belum ada film ditambahkan
                    </div>
                @endif
                <button id="prevBtn" class="carousel-nav-button carousel-nav-prev">❮</button>
                <button id="nextBtn" class="carousel-nav-button carousel-nav-next">❯</button>

                <div class="carousel-dots">
                    @foreach ($carouselMovies as $index => $movie)
                        <div class="carousel-dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- FILM TERBARU -->
            <div class="lg:col-span-1">
                <h2 class="text-green-400 text-xl font-bold mb-6">
                    Film Terbaru
                </h2>

                <div class="space-y-4">
                    @if ($latestMovies->count())
                        @foreach ($latestMovies as $movie)
                            <a href="{{ route('konten', $movie) }}?back={{ route('home') }}"
                                class="flex gap-3 items-center bg-neutral-900 p-3 rounded-lg hover:bg-neutral-800 transition">
                                <img src="{{ $movie->poster_path
                                    ? (Str::startsWith($movie->poster_path, ['http://', 'https://'])
                                        ? $movie->poster_path
                                        : asset('storage/' . $movie->poster_path))
                                    : asset('images/poster.jpg') }}"
                                    class="w-12 h-16 object-cover rounded">
                                <span class="text-sm font-medium">
                                    {{ $movie->title }}
                                </span>
                            </a>
                        @endforeach
                    @else
                        <div class="text-neutral-400 text-sm">
                            Film belum ditambahkan
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- MOST POPULAR CELEBRITY -->
        <section id="celebrities-carousel" class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Aktor Paling Populer</h2>

            @if ($popularActors->count())
                <div class="flex gap-6 overflow-x-auto pb-2">
                    @foreach ($popularActors as $actor)
                        <a href="{{ route('actor.show', $actor) }}?back={{ route('home') }}"
                            class="flex-shrink-0 w-32 text-center">
                            <img src="{{ $actor->photo_path
                                ? (Str::startsWith($actor->photo_path, ['http://', 'https://'])
                                    ? $actor->photo_path
                                    : asset('storage/' . $actor->photo_path))
                                : asset('images/default-actor.png') }}"
                                class="w-32 h-32 object-cover rounded-full mb-2">
                            <div class="text-sm font-semibold">
                                {{ $actor->name }}
                            </div>
                            <div class="text-xs text-neutral-400">
                                {{ $actor->followers_count }} pengikut
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-neutral-400">
                    Belum ada aktor ditambahkan
                </div>
            @endif
        </section>

        <!-- TOP 10 MOVIES -->
        <section id="top-movies" class="mt-10">
            <h2 class="text-2xl font-bold text-white mb-6">
                Top 10 Film
            </h2>

            @if ($topMovies->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    @foreach ($topMovies as $movie)
                        <a href="{{ route('konten', $movie) }}?back={{ route('home') }}"
                            class="bg-neutral-900 rounded-lg overflow-hidden hover:scale-105 transition">
                            <img src="{{ $movie->poster_path
                                ? (Str::startsWith($movie->poster_path, ['http://', 'https://'])
                                    ? $movie->poster_path
                                    : asset('storage/' . $movie->poster_path))
                                : asset('images/poster.jpg') }}"
                                class="w-full h-72 object-cover">
                            <div class="p-2 text-sm font-semibold">
                                {{ $movie->title }}
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-neutral-400">
                    Film belum tersedia
                </div>
            @endif
        </section>

    </main>

    <footer id="main-footer"></footer>

    <div id="watchlist-alert-modal"></div>

</body>

</html>
