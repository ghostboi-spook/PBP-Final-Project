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

<body>
    <div class="max-w-5xl mx-auto px-3 mt-4 mb-4">
        <a href="{{ request('back', route('home')) }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-800 text-sm text-neutral-300 hover:border-green-500 hover:text-green-400 hover:bg-neutral-900 transition">
            ← Kembali
        </a>
    </div>


    <div class="max-w-5xl mx-auto p-3">
        <!-- Top hero -->
        <div class="grid lg:grid-cols-[180px_1fr_200px] gap-3 items-start mb-4">

            <!-- Poster -->
            <div class="rounded-lg overflow-hidden shadow bg-neutral-800 h-56">
                <img src="{{ $movie->poster_path
                    ? (Str::startsWith($movie->poster_path, ['http://', 'https://'])
                        ? $movie->poster_path
                        : asset('storage/' . $movie->poster_path))
                    : asset('images/poster.jpg') }}"
                    class="w-full h-full object-cover" alt="poster">
            </div>

            <!-- Backdrop -->
            <div class="rounded-lg bg-neutral-800 overflow-hidden relative shadow h-56">
                <img src="{{ $movie->backdrop_path
                    ? (Str::startsWith($movie->backdrop_path, ['http://', 'https://'])
                        ? $movie->backdrop_path
                        : asset('storage/' . $movie->backdrop_path))
                    : asset('images/visual.jpg') }}"
                    class="w-full h-full object-cover" alt="visual">

                <button id="playBtn"
                    class="absolute left-3 bottom-3 flex items-center gap-1.5 bg-black/40 px-2.5 py-1 rounded-full shadow-lg hover:bg-black/50 text-xs">
                    <span
                        class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center border border-white/10">
                        ▶
                    </span>
                    <span class="font-medium">
                        Trailer
                        <span class="text-xs text-neutral-300">—</span>
                    </span>
                </button>
            </div>

            <!-- Side actions -->
            <div class="flex flex-col gap-2">
                <!--  -->
            </div>
        </div>

        <!-- Title & meta -->
        <div class="mb-3">
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
                <h1 class="text-xl sm:text-2xl font-bold">{{ $movie->title }}</h1>

                <div class="text-xs text-neutral-400 font-medium">
                    {{ $movie->release_date?->format('Y') ?? ($movie->year ?? '—') }}
                    · {{ $movie->certificate ?? '—' }}
                    · {{ $movie->runtime ? $movie->runtime . 'm' : '—' }}
                </div>

                <div class="sm:ml-auto flex items-center gap-2">
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4 text-[var(--imdb-yellow)]" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 .587l3.668 7.431L23.327 9.5l-5.658 5.516L18.995 24 12 20.013 5.005 24l1.326-9L.673 9.5l7.659-1.482L12 .587z" />
                        </svg>
                        <div class="text-xl font-bold">
                            {{ $movie->rating_avg > 0 ? number_format($movie->rating_avg, 1) : '—' }}
                        </div>
                        <div class="text-xs text-neutral-400">
                            {{ number_format($movie->vote_count) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Genres -->
            <div class="flex flex-wrap gap-1.5 mt-2">
                @foreach ($movie->genres ?? [] as $genre)
                    <span class="px-2 py-0.5 bg-neutral-800 rounded-full text-neutral-300 text-xs">
                        {{ $genre }}
                    </span>
                @endforeach
            </div>
        </div>

        <hr class="border-neutral-800 my-3">

        <!-- Content grid -->
        <div class="grid lg:grid-cols-[1fr_250px] gap-3">

            <!-- LEFT -->
            <div class="space-y-3">

                <div class="bg-neutral-800 p-3 rounded-lg">
                    <h2 class="text-base font-semibold mb-1.5">Deskripsi</h2>
                    <div class="text-neutral-300 leading-snug text-xs">
                        {{ $movie->description ?? 'No description available.' }}
                    </div>
                </div>

                <!-- Ratings & Reviews -->
                <div class="bg-neutral-800 p-3 rounded-lg">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
                        <div class="flex items-center gap-2">
                            <div class="text-2xl font-bold">
                                {{ $movie->rating_avg > 0 ? number_format($movie->rating_avg, 1) : '—' }}
                            </div>
                            <div class="text-xs text-neutral-400">
                                User reviews · {{ $movie->reviews->count() }}
                            </div>
                        </div>

                        @auth
                            @if (!$userReview)
                                <form action="{{ route('reviews.store', $movie) }}" method="POST"
                                    class="bg-neutral-900 border border-neutral-800 rounded-lg p-3 space-y-2">
                                    @csrf

                                    <div class="flex items-center gap-2">
                                        <input type="number" name="rating" min="1" max="10" required
                                            class="w-16 px-2 py-1 bg-black border border-neutral-700 rounded text-sm"
                                            placeholder="★">

                                        <input type="text" name="title"
                                            class="flex-1 px-2 py-1 bg-black border border-neutral-700 rounded text-sm"
                                            placeholder="Review title">
                                    </div>

                                    <textarea name="content" rows="3" class="w-full px-2 py-1 bg-black border border-neutral-700 rounded text-sm"
                                        placeholder="Write your review..."></textarea>

                                    <button
                                        class="px-3 py-1 bg-[var(--imdb-yellow)] text-black rounded text-xs font-semibold">
                                        Submit Review
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('reviews.update', [$movie, $userReview]) }}" method="POST"
                                    class="bg-neutral-900 border border-yellow-500/30 rounded-lg p-3 space-y-2">
                                    @csrf
                                    @method('PUT')

                                    <div class="text-xs text-yellow-400 font-semibold">
                                        Edit your review
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <input type="number" name="rating" min="1" max="10" required
                                            value="{{ $userReview->rating }}"
                                            class="w-16 px-2 py-1 bg-black border border-neutral-700 rounded text-sm">

                                        <input type="text" name="title" value="{{ $userReview->title }}"
                                            class="flex-1 px-2 py-1 bg-black border border-neutral-700 rounded text-sm">
                                    </div>

                                    <textarea name="content" rows="3" class="w-full px-2 py-1 bg-black border border-neutral-700 rounded text-sm">{{ $userReview->content }}</textarea>

                                    <button class="px-3 py-1 bg-yellow-400 text-black rounded text-xs font-semibold">
                                        Update Review
                                    </button>
                                </form>
                            @endif
                        @else
                            <p class="text-xs text-neutral-400">
                                Login to write a review.
                            </p>
                        @endauth
                    </div>
                    <!-- Reviews -->
                    <div>
                        <h3 class="text-sm font-semibold mb-2">Featured Reviews</h3>

                        <div class="reviews-scroll-container flex space-x-2 overflow-x-auto pb-2 px-1">
                            @forelse($movie->reviews->take(8) as $review)
                                <div
                                    class="min-w-[180px] p-2 rounded bg-neutral-900 hover:bg-neutral-850 transition flex-shrink-0">
                                    <div class="flex items-center gap-1">
                                        <span class="font-semibold text-xs">{{ $review->rating }}</span>
                                        <span class="text-xs text-neutral-400">
                                            {{ $review->user->username ?? $review->user->name }}
                                        </span>
                                    </div>
                                    <h3 class="mt-1 font-bold text-xs">
                                        {{ $review->title ?? 'Untitled' }}
                                    </h3>
                                    <p class="mt-0.5 text-neutral-400 text-xs">
                                        {{ \Illuminate\Support\Str::limit($review->content, 120) }}
                                    </p>
                                </div>
                            @empty
                                <div
                                    class="min-w-[180px] p-2 rounded bg-neutral-900 text-neutral-400 flex items-center justify-center">
                                    No reviews yet
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="bg-neutral-800 p-3 rounded-lg">
                    <h2 class="text-base font-semibold mb-2">Cast</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @forelse($movie->actors as $actor)
                            <a href="{{ route('actor.show', $actor) }}?back={{ url()->current() }}"
                                class="flex items-center gap-2 p-2 bg-neutral-900 rounded hover:bg-neutral-800 transition">

                                <div class="w-8 h-8 rounded-full bg-neutral-700 overflow-hidden">
                                    <img
                                        src="{{ $movie->poster_path
                                            ? (Str::startsWith($movie->poster_path, ['http://', 'https://'])
                                                ? $movie->poster_path
                                                : asset('storage/' . $movie->poster_path))
                                            : asset('images/poster.jpg') }}"
                                    class="w-full h-full object-cover">
                                </div>

                                <div>
                                    <div class="text-sm font-medium text-white">
                                        {{ $actor->name }}
                                    </div>
                                    <div class="text-xs text-neutral-400">
                                        {{ $actor->pivot->character_name ?? '—' }}
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-xs text-neutral-400">
                                Cast data not available yet.
                            </div>
                        @endforelse
                    </div>
                </div>


            </div>

            <!-- RIGHT -->
            <div class="space-y-3">

                <!-- Details -->
                <div class="bg-neutral-800 p-3 rounded-lg">
                    <h3 class="text-sm font-semibold mb-2">Details</h3>
                    <div class="space-y-2 text-xs">
                        <div>
                            <div class="text-neutral-400 font-medium">Tanggal Rilis</div>
                            <div class="text-neutral-300">
                                {{ $movie->release_date?->format('M d, Y') ?? '—' }}
                            </div>
                        </div>
                        <div>
                            <div class="text-neutral-400 font-medium">Bahasa</div>
                            <div class="text-neutral-300">{{ $movie->language ?? '—' }}</div>
                        </div>
                        <div>
                            <div class="text-neutral-400 font-medium">Lokasi Syuting</div>
                            <div class="text-neutral-300">{{ $movie->filming_locations ?? '—' }}</div>
                        </div>
                        <div>
                            <div class="text-neutral-400 font-medium">Perusahaan Produksi</div>
                            <div class="text-neutral-300">{{ $movie->production_companies ?? '—' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Tagline -->
                <div class="bg-neutral-800 p-3 rounded-lg text-center">
                    <div class="text-xs text-neutral-400">Taglines</div>
                    <div class="font-semibold mt-0.5 text-xs">
                        {{ $movie->tagline ?? '—' }}
                    </div>
                </div>

                <!-- Certificate -->
                <div class="bg-neutral-800 p-3 rounded-lg text-center">
                    <div class="text-xs text-neutral-400">Sertifikasi</div>
                    <div class="font-semibold mt-0.5 text-base">
                        {{ $movie->certificate ?? '—' }}
                    </div>
                </div>

                <!-- Key Crew -->
                <div class="bg-neutral-800 p-3 rounded-lg">
                    <h3 class="text-sm font-semibold mb-2">Crew Utama</h3>
                    <div class="space-y-2 text-xs">
                        <div>
                            <div class="font-medium">Direktor</div>
                            <div class="text-neutral-400">{{ $movie->director ?? '—' }}</div>
                        </div>
                        <div>
                            <div class="font-medium">Penulis</div>
                            <div class="text-neutral-400">{{ $movie->writer ?? '—' }}</div>
                        </div>
                        <div>
                            <div class="font-medium">Genres</div>
                            <div class="text-neutral-300">
                                {{ $movie->genres ? implode(' · ', $movie->genres) : '—' }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="main-footer"></footer>

</body>

</html>
