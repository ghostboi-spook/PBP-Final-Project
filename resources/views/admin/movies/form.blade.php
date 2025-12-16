<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">
        {{ $movie->exists ? 'Edit' : 'Create' }} Movie
    </h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-600 text-white rounded">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $movie->exists ? route('admin.movies.update', $movie->id) : route('admin.movies.store') }}"
        method="POST">

        @csrf
        @if ($movie->exists)
            @method('PUT')
        @endif

        {{-- Title --}}
        <div class="mb-3">
            <label class="block text-sm text-neutral-400">Judul</label>
            <input type="text" name="title" value="{{ old('title', $movie->title) }}"
                class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800">
        </div>

        {{-- Year & Runtime --}}
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm text-neutral-400">Tahun</label>
                <input type="number" name="year" value="{{ old('year', $movie->year) }}"
                    class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800">
            </div>
            <div>
                <label class="block text-sm text-neutral-400">Durasi Tayang (menit)</label>
                <input type="number" name="runtime" value="{{ old('runtime', $movie->runtime) }}"
                    class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800">
            </div>
        </div>

        {{-- Certificate --}}
        <div class="mt-3">
            <label class="block text-sm text-neutral-400">Sertifikasi</label>
            <input type="text" name="certificate" value="{{ old('certificate', $movie->certificate) }}"
                class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800">
        </div>

        {{-- Poster & Backdrop --}}
        <div class="grid grid-cols-2 gap-3 mt-3">
            <div>
                <label class="block text-sm text-neutral-400">Poster Path</label>
                <input type="text" name="poster_path" value="{{ old('poster_path', $movie->poster_path) }}"
                    class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800">
            </div>
            <div>
                <label class="block text-sm text-neutral-400">Backdrop Path</label>
                <input type="text" name="backdrop_path" value="{{ old('backdrop_path', $movie->backdrop_path) }}"
                    class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800">
            </div>
        </div>

        {{-- Trailer --}}
        <div class="mt-3">
            <label class="block text-sm text-neutral-400">Trailer URL</label>
            <input type="text" name="trailer_url" value="{{ old('trailer_url', $movie->trailer_url) }}"
                class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800">
        </div>

        {{-- Genres --}}
        <div class="mt-3">
            <label class="block text-sm text-neutral-400">Genres (koma sebagai pemisah)</label>
            <input type="text" name="genres"
                value="{{ old('genres', is_array($movie->genres) ? implode(', ', $movie->genres) : '') }}"
                class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800">
        </div>

        {{-- Description --}}
        <div class="mt-3">
            <label class="block text-sm text-neutral-400">Deskripsi</label>
            <textarea name="description" rows="5" class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800">{{ old('description', $movie->description) }}</textarea>
        </div>

        {{-- Production & Filming --}}
        <div class="grid grid-cols-2 gap-3 mt-3">
            <div>
                <label class="block text-sm text-neutral-400">
                    Perusahaan Produksi
                </label>
                <input type="text" name="production_companies"
                    value="{{ old('production_companies', $movie->production_companies) }}"
                    class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800"
                    placeholder="Walt Disney Pictures">
            </div>

            <div>
                <label class="block text-sm text-neutral-400">
                    Lokasi Syuting
                </label>
                <input type="text" name="filming_locations"
                    value="{{ old('filming_locations', $movie->filming_locations) }}"
                    class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800"
                    placeholder="Burbank, California">
            </div>
        </div>


        {{-- Tagline --}}
        <div class="mt-3">
            <label class="block text-sm text-neutral-400">Tagline</label>
            <input type="text" name="tagline" value="{{ old('tagline', $movie->tagline) }}"
                class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800">
        </div>

        {{-- Release Date --}}
        <div class="mt-3">
            <label class="block text-sm text-neutral-400">Tanggal Rilis</label>
            <input type="date" name="release_date"
                value="{{ old('release_date', optional($movie->release_date)->format('Y-m-d')) }}"
                class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800">
        </div>


        {{-- Crew --}}
        <div class="grid grid-cols-2 gap-3 mt-3">
            <div>
                <label class="block text-sm text-neutral-400">Sutradara</label>
                <input type="text" name="director" value="{{ old('director', $movie->director) }}"
                    class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800">
            </div>
            <div>
                <label class="block text-sm text-neutral-400">Penulis</label>
                <input type="text" name="writer" value="{{ old('writer', $movie->writer) }}"
                    class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800">
            </div>
        </div>

        {{-- Extra --}}
        <div class="grid grid-cols-2 gap-3 mt-3">
            <div>
                <label class="block text-sm text-neutral-400">Bahasa</label>
                <input type="text" name="language" value="{{ old('language', $movie->language) }}"
                    class="w-full px-3 py-2 bg-black/40 rounded border border-neutral-800">
            </div>
        </div>

        {{-- Cast --}}
        <div class="mt-6">
            <h3 class="text-sm font-semibold mb-2 text-neutral-300">
                Cast
            </h3>
            <div class="space-y-2">
                @foreach ($actors as $actor)
                    @php
                        $existing = $movie->actors->firstWhere('id', $actor->id);
                    @endphp
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="actors[{{ $actor->id }}][attach]" value="1"
                            {{ $existing ? 'checked' : '' }}>
                        <span class="text-sm text-neutral-300 w-40">
                            {{ $actor->name }}
                        </span>
                        <input type="text" name="actors[{{ $actor->id }}][character_name]"
                            placeholder="Character name" value="{{ $existing?->pivot?->character_name }}"
                            class="flex-1 px-2 py-1 bg-black/40 border border-neutral-800 rounded text-sm">
                    </div>
                @endforeach
            </div>
        </div>


        {{-- Buttons --}}
        <div class="flex gap-2 mt-5">
            <button class="px-4 py-2 bg-green-500 text-black rounded">
                Save
            </button>
            <a href="{{ route('admin.movies.index') }}" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded">
                Cancel
            </a>
        </div>

    </form>
</div>
