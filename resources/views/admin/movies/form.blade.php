@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->exists ? 'Edit' : 'Create' }} Movie - Admin Panel</title>

    <script>
        window.AUTH_USER = @json(auth()->user());
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <script src="{{ asset('js/common.js') }}"></script>

    <style>
        .modal-overlay {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(4px);
        }
        .actor-card {
            transition: all 0.2s;
        }
        .actor-card:hover {
            transform: translateY(-2px);
        }
        .actor-card.selected {
            border-color: #22c55e;
            background: rgba(34, 197, 94, 0.1);
        }
        .search-actors:focus {
            border-color: #22c55e;
            outline: none;
        }
    </style>
</head>

<body class="bg-[#070707] text-white min-h-screen">

    <main class="max-w-4xl mx-auto px-6 py-8">
        <div class="mb-6">
            <a href="{{ route('admin.movies.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-800 text-sm text-neutral-300 hover:border-green-500 hover:text-green-400 hover:bg-neutral-900 transition">
                ← Kembali ke Movie List
            </a>
        </div>

        <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6 mb-6">
            <h1 class="text-3xl font-bold text-white">
                {{ $movie->exists ? 'Edit Film' : 'Tambah Film Baru' }}
            </h1>
            <p class="text-neutral-400 mt-1">
                {{ $movie->exists ? 'Ubah informasi film' : 'Isi detail film baru' }}
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500/20 border border-red-500 rounded-lg text-red-400">
                <div class="font-semibold mb-2">Terjadi kesalahan:</div>
                <ul class="list-disc ml-4 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ $movie->exists ? route('admin.movies.update', $movie->id) : route('admin.movies.store') }}"
            method="POST" id="movieForm">

            @csrf
            @if ($movie->exists)
                @method('PUT')
            @endif

            <div class="space-y-6">
                <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6">
                    <h2 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                        Informasi Dasar
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Judul Film *</label>
                            <input type="text" name="title" value="{{ old('title', $movie->title) }}" required
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition">
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm text-neutral-400 mb-2">Tahun</label>
                                <input type="number" name="year" value="{{ old('year', $movie->year) }}"
                                    class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm text-neutral-400 mb-2">Durasi (menit)</label>
                                <input type="number" name="runtime" value="{{ old('runtime', $movie->runtime) }}"
                                    class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm text-neutral-400 mb-2">Sertifikasi</label>
                                <input type="text" name="certificate" value="{{ old('certificate', $movie->certificate) }}"
                                    class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition"
                                    placeholder="PG-13, R, dsb.">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Tagline</label>
                            <input type="text" name="tagline" value="{{ old('tagline', $movie->tagline) }}"
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition">
                        </div>

                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Deskripsi</label>
                            <textarea name="description" rows="4"
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition resize-none">{{ old('description', $movie->description) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Genres (pisahkan dengan koma)</label>
                            <input type="text" name="genres"
                                value="{{ old('genres', is_array($movie->genres) ? implode(', ', $movie->genres) : '') }}"
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition"
                                placeholder="Action, Drama, Comedy">
                        </div>
                    </div>
                </div>

                <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6">
                    <h2 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                        Media
                    </h2>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Poster URL</label>
                            <input type="text" name="poster_path" value="{{ old('poster_path', $movie->poster_path) }}"
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition"
                                placeholder="https://... atau path lokal">
                        </div>
                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Backdrop URL</label>
                            <input type="text" name="backdrop_path" value="{{ old('backdrop_path', $movie->backdrop_path) }}"
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition"
                                placeholder="https://... atau path lokal">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm text-neutral-400 mb-2">Trailer URL (YouTube)</label>
                        <input type="url" name="trailer_url" value="{{ old('trailer_url', $movie->trailer_url) }}"
                            class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition"
                            placeholder="https://youtube.com/...">
                    </div>
                </div>

                <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6">
                    <h2 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                        Detail Produksi
                    </h2>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Tanggal Rilis</label>
                            <input type="date" name="release_date"
                                value="{{ old('release_date', optional($movie->release_date)->format('Y-m-d')) }}"
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Bahasa</label>
                            <input type="text" name="language" value="{{ old('language', $movie->language) }}"
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition"
                                placeholder="English, Indonesian, dsb.">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Sutradara</label>
                            <input type="text" name="director" value="{{ old('director', $movie->director) }}"
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Penulis</label>
                            <input type="text" name="writer" value="{{ old('writer', $movie->writer) }}"
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Perusahaan Produksi</label>
                            <input type="text" name="production_companies" value="{{ old('production_companies', $movie->production_companies) }}"
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Lokasi Syuting</label>
                            <input type="text" name="filming_locations" value="{{ old('filming_locations', $movie->filming_locations) }}"
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition">
                        </div>
                    </div>
                </div>

                <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-white flex items-center gap-2">
                            Cast (Pemeran)
                        </h2>
                        <button type="button" id="openActorPicker"
                            class="px-4 py-2 bg-green-500 hover:bg-green-400 text-black font-semibold rounded-lg transition text-sm">
                            + Pilih Aktor
                        </button>
                    </div>

                    <div id="selectedActorsContainer" class="space-y-3">
                        @php
                            $existingActors = old('actors', []);
                            if (empty($existingActors) && $movie->exists) {
                                foreach ($movie->actors as $actor) {
                                    $existingActors[$actor->id] = [
                                        'attach' => '1',
                                        'character_name' => $actor->pivot->character_name ?? ''
                                    ];
                                }
                            }
                        @endphp

                        @if(empty($existingActors))
                            <div id="noActorsMessage" class="text-neutral-500 text-sm py-4 text-center border border-dashed border-neutral-700 rounded-lg">
                                Belum ada aktor yang dipilih. Klik "Pilih Aktor" untuk menambahkan.
                            </div>
                        @else
                            <div id="noActorsMessage" class="text-neutral-500 text-sm py-4 text-center border border-dashed border-neutral-700 rounded-lg hidden">
                                Belum ada aktor yang dipilih. Klik "Pilih Aktor" untuk menambahkan.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 px-6 py-4 bg-green-500 hover:bg-green-400 text-black font-bold rounded-lg transition text-lg">
                        Simpan Film
                    </button>
                    <a href="{{ route('admin.movies.index') }}"
                        class="px-6 py-4 bg-neutral-800 hover:bg-neutral-700 text-neutral-300 font-semibold rounded-lg transition text-center">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </main>

    <div id="actorPickerModal" class="fixed inset-0 modal-overlay z-50 hidden flex items-center justify-center p-4">
        <div class="bg-neutral-900 border border-neutral-800 rounded-2xl w-full max-w-4xl max-h-[85vh] overflow-hidden flex flex-col">
            <div class="p-6 border-b border-neutral-800">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-white">🎭 Pilih Aktor</h3>
                    <button type="button" id="closeActorPicker"
                        class="w-10 h-10 bg-neutral-800 hover:bg-neutral-700 rounded-lg flex items-center justify-center transition">
                        ✕
                    </button>
                </div>
                <input type="text" id="searchActors" placeholder="Cari aktor..."
                    class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 search-actors transition">
            </div>

            <div class="flex-1 overflow-y-auto p-6">
                <div id="actorGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($actors as $actor)
                        @php
                            $isSelected = isset($existingActors[$actor->id]);
                            $characterName = $existingActors[$actor->id]['character_name'] ?? '';
                        @endphp
                        <div class="actor-card cursor-pointer rounded-xl border border-neutral-800 overflow-hidden {{ $isSelected ? 'selected' : '' }}"
                            data-actor-id="{{ $actor->id }}"
                            data-actor-name="{{ $actor->name }}"
                            data-actor-photo="{{ $actor->photo_path
                                ? (Str::startsWith($actor->photo_path, ['http://', 'https://'])
                                    ? $actor->photo_path
                                    : asset('storage/' . $actor->photo_path))
                                : asset('images/default-actor.png') }}">
                            <div class="aspect-square bg-neutral-800 relative">
                                <img src="{{ $actor->photo_path
                                    ? (Str::startsWith($actor->photo_path, ['http://', 'https://'])
                                        ? $actor->photo_path
                                        : asset('storage/' . $actor->photo_path))
                                    : asset('images/default-actor.png') }}"
                                    class="w-full h-full object-cover">
                                <div class="absolute top-2 right-2 w-6 h-6 rounded-full bg-green-500 flex items-center justify-center text-black text-sm font-bold check-indicator {{ $isSelected ? '' : 'hidden' }}">
                                    ✓
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="font-semibold text-white text-sm truncate">{{ $actor->name }}</div>
                                <div class="text-xs text-neutral-500">{{ $actor->gender ?? 'Aktor' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="p-6 border-t border-neutral-800 bg-neutral-900/50">
                <button type="button" id="confirmActorSelection"
                    class="w-full px-6 py-3 bg-green-500 hover:bg-green-400 text-black font-bold rounded-lg transition">
                    Konfirmasi Pilihan
                </button>
            </div>
        </div>
    </div>

    <footer id="main-footer"></footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('actorPickerModal');
            const openBtn = document.getElementById('openActorPicker');
            const closeBtn = document.getElementById('closeActorPicker');
            const confirmBtn = document.getElementById('confirmActorSelection');
            const searchInput = document.getElementById('searchActors');
            const actorCards = document.querySelectorAll('.actor-card');
            const selectedContainer = document.getElementById('selectedActorsContainer');
            const noActorsMessage = document.getElementById('noActorsMessage');

            let selectedActors = new Map();

            @foreach ($existingActors as $actorId => $data)
                @php
                    $actorData = $actors->firstWhere('id', $actorId);
                @endphp
                @if($actorData)
                    selectedActors.set({{ $actorId }}, {
                        name: @json($actorData->name),
                        photo: @json($actorData->photo_path
                            ? (Str::startsWith($actorData->photo_path, ['http://', 'https://'])
                                ? $actorData->photo_path
                                : asset('storage/' . $actorData->photo_path))
                            : asset('images/default-actor.png')),
                        character: @json($data['character_name'] ?? '')
                    });
                @endif
            @endforeach

            renderSelectedActors();

            openBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });

            closeBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });

            function closeModal() {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }

            actorCards.forEach(card => {
                card.addEventListener('click', function() {
                    const actorId = parseInt(this.dataset.actorId);
                    const actorName = this.dataset.actorName;
                    const actorPhoto = this.dataset.actorPhoto;
                    const checkIndicator = this.querySelector('.check-indicator');

                    if (selectedActors.has(actorId)) {
                        selectedActors.delete(actorId);
                        this.classList.remove('selected');
                        checkIndicator.classList.add('hidden');
                    } else {
                        selectedActors.set(actorId, {
                            name: actorName,
                            photo: actorPhoto,
                            character: ''
                        });
                        this.classList.add('selected');
                        checkIndicator.classList.remove('hidden');
                    }
                });
            });

            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                actorCards.forEach(card => {
                    const name = card.dataset.actorName.toLowerCase();
                    card.style.display = name.includes(query) ? '' : 'none';
                });
            });

            confirmBtn.addEventListener('click', function() {
                renderSelectedActors();
                closeModal();
            });

            function renderSelectedActors() {
                const existingInputs = selectedContainer.querySelectorAll('.selected-actor-item');
                existingInputs.forEach(el => el.remove());

                if (selectedActors.size === 0) {
                    noActorsMessage.classList.remove('hidden');
                } else {
                    noActorsMessage.classList.add('hidden');

                    selectedActors.forEach((data, actorId) => {
                        const div = document.createElement('div');
                        div.className = 'selected-actor-item flex items-center gap-4 bg-neutral-800/50 p-4 rounded-xl border border-neutral-700';
                        div.innerHTML = `
                            <img src="${data.photo}" class="w-12 h-12 rounded-full object-cover">
                            <div class="flex-1">
                                <div class="font-semibold text-white">${data.name}</div>
                                <input type="hidden" name="actors[${actorId}][attach]" value="1">
                                <input type="text" name="actors[${actorId}][character_name]"
                                    value="${data.character}"
                                    placeholder="Nama karakter..."
                                    class="mt-2 w-full px-3 py-2 bg-black/40 rounded-lg border border-neutral-700 text-sm focus:border-green-500 focus:outline-none transition">
                            </div>
                            <button type="button" class="remove-actor w-8 h-8 bg-red-500/20 hover:bg-red-500/40 text-red-400 rounded-lg flex items-center justify-center transition" data-actor-id="${actorId}">
                                ✕
                            </button>
                        `;
                        selectedContainer.appendChild(div);
                    });

                    document.querySelectorAll('.remove-actor').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const actorId = parseInt(this.dataset.actorId);
                            selectedActors.delete(actorId);

                            const card = document.querySelector(`.actor-card[data-actor-id="${actorId}"]`);
                            if (card) {
                                card.classList.remove('selected');
                                card.querySelector('.check-indicator').classList.add('hidden');
                            }

                            renderSelectedActors();
                        });
                    });

                    document.querySelectorAll('.selected-actor-item input[type="text"]').forEach(input => {
                        input.addEventListener('input', function() {
                            const actorId = parseInt(this.name.match(/actors\[(\d+)\]/)[1]);
                            if (selectedActors.has(actorId)) {
                                selectedActors.get(actorId).character = this.value;
                            }
                        });
                    });
                }
            }
        });
    </script>
</body>

</html>
