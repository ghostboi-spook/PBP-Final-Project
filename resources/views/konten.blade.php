@php
    use Illuminate\Support\Str;
@endphp

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>IMIX — {{ $movie->title }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/global.css', 'resources/css/components.css', 'resources/css/layout.css', 'resources/css/konten.css', 'resources/js/common.js', 'resources/js/konten.js'])
</head>

<body class="bg-black text-white">

    <!-- BACK -->
    <div class="max-w-5xl mx-auto px-3 mt-4 mb-4">
        <a href="{{ request('back', route('home')) }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-800 text-sm text-neutral-300
                   hover:border-green-500 hover:text-green-400 hover:bg-neutral-900 transition">
            ← Kembali
        </a>
    </div>

    <div class="max-w-5xl mx-auto p-3">

        <!-- HERO -->
        <div class="grid lg:grid-cols-[180px_1fr_200px] gap-3 items-start mb-4">

            <!-- POSTER -->
            <div class="rounded-lg overflow-hidden bg-neutral-800 h-56">
                <img src="{{ $movie->poster_path
                    ? (Str::startsWith($movie->poster_path, ['http', 'https'])
                        ? $movie->poster_path
                        : asset('storage/' . $movie->poster_path))
                    : asset('images/poster.jpg') }}"
                    class="w-full h-full object-cover">
            </div>

            <!-- BACKDROP -->
            <div class="rounded-lg bg-neutral-800 overflow-hidden relative h-56">
                <img src="{{ $movie->backdrop_path
                    ? (Str::startsWith($movie->backdrop_path, ['http', 'https'])
                        ? $movie->backdrop_path
                        : asset('storage/' . $movie->backdrop_path))
                    : asset('images/visual.jpg') }}"
                    class="w-full h-full object-cover">

                @if ($movie->trailer_url)
                    <a href="{{ $movie->trailer_url }}" target="_blank"
                        class="absolute left-3 bottom-3 bg-black/40 px-3 py-1.5 rounded-full text-xs hover:bg-black/60">
                        ▶ Trailer
                    </a>
                @endif
            </div>

            <!-- Side actions -->
            <div class="flex flex-col gap-2">
                <button
                    class="bg-[var(--imdb-yellow)] text-neutral-900 font-bold px-3 py-2 rounded-lg shadow hover:brightness-110 transition text-xs">
                    + Add to Watchlist
                </button>
            </div>
        </div>

        <!-- TITLE -->
        <div class="mb-3">
            <h1 class="text-2xl font-bold">{{ $movie->title }}</h1>
            <div class="text-xs text-neutral-400 mt-1">
                {{ $movie->release_date?->format('Y') ?? '—' }}
                · {{ $movie->certificate ?? '—' }}
                · {{ $movie->runtime ? $movie->runtime . 'm' : '—' }}
            </div>

            <div class="flex gap-1.5 mt-2">
                @foreach ($movie->genres ?? [] as $genre)
                    <span class="px-2 py-0.5 bg-neutral-800 rounded-full text-xs text-neutral-300">
                        {{ $genre }}
                    </span>
                @endforeach
            </div>
        </div>

        <hr class="border-neutral-800 my-3">

        <!-- GRID -->
        <div class="grid lg:grid-cols-[1fr_250px] gap-3">

            <!-- LEFT -->
            <div class="space-y-3">

                <!-- DESCRIPTION -->
                <div class="bg-neutral-800 p-3 rounded-lg">
                    <h2 class="font-semibold mb-1">Deskripsi</h2>
                    <p class="text-xs text-neutral-300">
                        {{ $movie->description ?? 'No description available.' }}
                    </p>
                </div>

                <!-- REVIEWS -->
                <div class="bg-neutral-800 p-3 rounded-lg">

                    <div class="mb-3">
                        <div class="text-2xl font-bold">
                            {{ $movie->rating_avg > 0 ? number_format($movie->rating_avg, 1) : '—' }}
                        </div>
                        <div class="text-xs text-neutral-400">
                            User reviews · {{ $movie->reviews->count() }}
                        </div>
                    </div>

                    <!-- REVIEW FORM -->
                    @auth
                        <div class="bg-neutral-900 p-3 rounded-lg mb-4">

                            <form
                                action="{{ $userReview ? route('reviews.update', [$movie, $userReview]) : route('reviews.store', $movie) }}"
                                method="POST" class="space-y-2">

                                @csrf
                                @if ($userReview)
                                    @method('PUT')
                                    <div class="text-xs text-yellow-400 font-semibold">
                                        Edit Review Anda
                                    </div>
                                @endif

                                <input type="number" name="rating" min="1" max="10" required
                                    value="{{ old('rating', $userReview->rating ?? '') }}"
                                    class="w-16 bg-black border border-neutral-700 rounded px-2 py-1 text-sm">

                                <input type="text" name="title" value="{{ old('title', $userReview->title ?? '') }}"
                                    class="w-full bg-black border border-neutral-700 rounded px-2 py-1 text-sm"
                                    placeholder="Judul review (opsional)">

                                <textarea name="content" rows="3" class="w-full bg-black border border-neutral-700 rounded px-2 py-1 text-sm"
                                    placeholder="Tulis review...">{{ old('content', $userReview->content ?? '') }}</textarea>

                                <button class="bg-yellow-400 text-black text-xs px-3 py-1 rounded">
                                    {{ $userReview ? 'Update Review' : 'Submit Review' }}
                                </button>
                            </form>

                            @if ($userReview)
                                <form action="{{ route('reviews.destroy', [$movie, $userReview]) }}" method="POST"
                                    class="mt-2" onsubmit="return confirm('Hapus review ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="bg-red-500/80 hover:bg-red-500 text-white text-xs px-3 py-1 rounded">
                                        Delete Review
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endauth

                    <!-- REVIEW LIST -->
                    <div class="flex gap-2 overflow-x-auto pb-2">
                        @forelse ($movie->reviews->take(8) as $review)
                            <div class="min-w-[180px] bg-neutral-900 p-2 rounded">
                                <div class="flex justify-between text-xs">
                                    <span class="font-bold">{{ $review->rating }}</span>

                                    @if ($review->user?->username)
                                        <a href="{{ route('users.byUsername', $review->user->username) }}?back={{ url()->current() }}"
                                            class="text-neutral-400 hover:text-green-400">
                                            {{ $review->user->username }}
                                        </a>
                                    @else
                                        <span class="text-neutral-500">
                                            {{ $review->user->name }}
                                        </span>
                                    @endif
                                </div>

                                @if ($review->title)
                                    <div class="font-semibold text-xs mt-1">
                                        {{ $review->title }}
                                    </div>
                                @endif

                                <p class="text-xs text-neutral-400 mt-1">
                                    {{ Str::limit($review->content, 120) }}
                                </p>
                            </div>
                        @empty
                            <div class="text-xs text-neutral-400">
                                No reviews yet.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- CAST -->
                <div class="bg-neutral-800 p-3 rounded-lg">
                    <h2 class="font-semibold mb-2">Cast</h2>
                    <div class="grid sm:grid-cols-2 gap-2">
                        @foreach ($movie->actors as $actor)
                            <a href="{{ route('actor.show', $actor) }}?back={{ url()->current() }}"
                                class="flex gap-2 items-center bg-neutral-900 p-2 rounded hover:bg-neutral-800">
                                <img src="{{ $actor->photo_path ? asset('storage/' . $actor->photo_path) : asset('images/default-actor.png') }}"
                                    class="w-8 h-8 rounded-full object-cover">
                                <div>
                                    <div class="text-sm">{{ $actor->name }}</div>
                                    <div class="text-xs text-neutral-400">
                                        {{ $actor->pivot->character_name ?? '—' }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- RIGHT -->
            <div class="space-y-3">
                <div class="bg-neutral-800 p-3 rounded-lg text-xs">
                    <h3 class="font-semibold mb-2">Details</h3>
                    <div>Tanggal Rilis: {{ $movie->release_date?->format('M d, Y') ?? '—' }}</div>
                    <div>Bahasa: {{ $movie->language ?? '—' }}</div>
                    <div>Lokasi: {{ $movie->filming_locations ?? '—' }}</div>
                    <div>Produksi: {{ $movie->production_companies ?? '—' }}</div>
                </div>

                <div class="bg-neutral-800 p-3 rounded-lg text-center text-xs">
                    <div class="text-neutral-400">Tagline</div>
                    <div class="font-semibold">{{ $movie->tagline ?? '—' }}</div>
                </div>

                <div class="bg-neutral-800 p-3 rounded-lg text-center">
                    <div class="text-neutral-400 text-xs">Sertifikasi</div>
                    <div class="font-bold">{{ $movie->certificate ?? '—' }}</div>
                </div>

                <div class="bg-neutral-800 p-3 rounded-lg text-xs">
                    <h3 class="font-semibold mb-2">Crew Utama</h3>
                    <div>Sutradara: {{ $movie->director ?? '—' }}</div>
                    <div>Penulis: {{ $movie->writer ?? '—' }}</div>
                    <div>Genres: {{ $movie->genres ? implode(', ', $movie->genres) : '—' }}</div>
                </div>
            </div>

        </div>
    </div>

    <footer id="main-footer"></footer>
</body>

</html>
