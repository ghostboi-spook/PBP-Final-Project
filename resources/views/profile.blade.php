@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - IMIX</title>

    <script>
        window.AUTH_USER = @json(auth()->user());
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <script src="{{ asset('js/common.js') }}"></script>
</head>

<body class="bg-black text-white">
    <header id="main-header"></header>

    <main class="max-w-5xl mx-auto px-6 py-10">

        <a href="{{ request('back', route('home')) }}"
            class="inline-flex items-center gap-2 px-4 py-2 mb-6 rounded-lg border border-neutral-800 text-sm text-neutral-300 hover:border-green-500 hover:text-green-400 hover:bg-neutral-900 transition">
            ← Kembali
        </a>

        <h1 class="text-3xl font-bold mb-6">
            {{ $isOwner ? 'My Profile' : 'Profile' }}
        </h1>

        @if (session('success') && $isOwner)
            <div class="mb-4 p-3 bg-green-600 text-black rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-[240px_1fr] gap-6 md:gap-8">

            <div class="flex flex-col items-center md:items-start">
                <div class="w-32 h-32 sm:w-48 sm:h-48 rounded-full overflow-hidden border border-neutral-800 mb-4">
                    @if ($user->avatar_path)
                        <img src="{{ Storage::url($user->avatar_path) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-neutral-800 text-4xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <p class="text-xl font-semibold">{{ $user->name }}</p>

                @if ($user->username)
                    <p class="text-neutral-400 text-sm">{{ $user->username }}</p>
                @endif

                @if ($isOwner)
                    <p class="text-neutral-500 text-xs mt-1">{{ $user->email }}</p>
                @endif

                @if(count($badges) > 0)
                    <div class="mt-4">
                        <p class="text-xs text-neutral-500 mb-2">Badges</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($badges as $badge)
                                <div class="group relative">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-gradient-to-r {{ $badge['color'] }} {{ $badge['text'] }} cursor-default">
                                        {{ $badge['icon'] }} {{ $badge['name'] }}
                                    </span>
                                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-neutral-800 text-neutral-200 text-xs rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap pointer-events-none z-10">
                                        {{ $badge['description'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($isOwner)
                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-neutral-800 text-sm text-red-400 hover:bg-red-500/10 hover:border-red-500 hover:text-red-300 transition">
                            Logout
                        </button>
                    </form>
                @endif
            </div>

            <div class="space-y-8">

                @if ($isOwner)
                    <div class="bg-neutral-900 p-6 rounded-lg border border-neutral-800">
                        <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                            class="space-y-4">
                            @csrf

                            <div>
                                <label class="text-sm text-neutral-400">Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full px-3 py-2 bg-black border border-neutral-800 rounded">
                            </div>

                            <div>
                                <label class="text-sm text-neutral-400">Username</label>
                                <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                    class="w-full px-3 py-2 bg-black border border-neutral-800 rounded">
                            </div>

                            <div>
                                <label class="text-sm text-neutral-400">Avatar</label>
                                <input type="file" name="avatar" class="block text-sm text-neutral-400">
                            </div>

                            <button class="px-4 py-2 bg-green-500 text-black rounded">
                                Simpan
                            </button>
                        </form>
                    </div>
                @endif

                <div class="bg-neutral-900 p-6 rounded-lg border border-neutral-800">
                    <h2 class="text-xl font-semibold mb-4">
                        {{ $isOwner ? 'Aktor yang Anda Ikuti' : 'Aktor yang Diikuti' }}
                    </h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @forelse($user->followedActors as $actor)
                            <a href="{{ route('actor.show', $actor) }}?back={{ url()->current() }}"
                                class="bg-neutral-800 p-3 rounded-lg hover:bg-neutral-700 transition">

                                <div class="aspect-square rounded overflow-hidden mb-2">
                                    <img src="{{ $actor->photo_path
                                        ? (Str::startsWith($actor->photo_path, ['http', 'https'])
                                            ? $actor->photo_path
                                            : asset('storage/' . $actor->photo_path))
                                        : asset('images/default-actor.png') }}"
                                        class="w-full h-full object-cover">
                                </div>

                                <div class="text-sm font-semibold text-white truncate">
                                    {{ $actor->name }}
                                </div>
                            </a>
                        @empty
                            <p class="text-neutral-400 text-sm">
                                Belum mengikuti aktor manapun.
                            </p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-neutral-900 p-6 rounded-lg border border-neutral-800">
                    <h2 class="text-xl font-semibold mb-4">
                        {{ $isOwner ? 'Review Saya' : 'Review' }}
                    </h2>

                    @forelse($user->reviews as $review)
                        <div class="border-b border-neutral-800 pb-3 mb-3">
                            <div class="flex items-center justify-between">
                                <a href="{{ route('konten', $review->movie) }}?back={{ url()->current() }}"
                                    class="font-semibold hover:text-green-400 transition">
                                    {{ $review->movie->title }}
                                </a>
                                <div class="text-yellow-400 text-sm">
                                    ★ {{ $review->rating }}
                                </div>
                            </div>

                            <p class="text-sm text-neutral-300 mt-1">
                                {{ Str::limit($review->content, 120) }}
                            </p>
                        </div>
                    @empty
                        <p class="text-neutral-400">
                            Belum menulis review.
                        </p>
                    @endforelse
                </div>

                @if ($isOwner && auth()->user()?->role === 'admin')
                    <div class="p-4 rounded-lg bg-neutral-900 border border-neutral-800">
                        <h3 class="text-sm font-semibold text-neutral-400 mb-3 uppercase tracking-wide">
                            Admin Panel
                        </h3>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('admin.movies.index') }}"
                                class="px-4 py-2 bg-green-500/90 hover:bg-green-500 text-black rounded text-sm font-semibold transition">
                                🎬 Movie Index
                            </a>
                            <a href="{{ route('admin.actors.index') }}"
                                class="px-4 py-2 bg-sky-500/90 hover:bg-sky-500 text-black rounded text-sm font-semibold transition">
                                🎭 Actor Index
                            </a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </main>

    <footer id="main-footer"></footer>
</body>
</html>
