<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $actor->exists ? 'Edit' : 'Create' }} Actor - Admin Panel</title>

    <script>
        window.AUTH_USER = @json(auth()->user());
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/global.css', 'resources/css/components.css', 'resources/css/layout.css', 'resources/js/common.js'])
</head>

<body class="bg-[#070707] text-white min-h-screen">

    <main class="max-w-3xl mx-auto px-6 py-8">
        <div class="mb-6">
            <a href="{{ route('admin.actors.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-800 text-sm text-neutral-300 hover:border-green-500 hover:text-green-400 hover:bg-neutral-900 transition">
                ← Kembali ke Actor List
            </a>
        </div>

        <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6 mb-6">
            <h1 class="text-3xl font-bold text-white">
                {{ $actor->exists ? 'Edit Aktor' : 'Tambah Aktor Baru' }}
            </h1>
            <p class="text-neutral-400 mt-1">
                {{ $actor->exists ? 'Ubah informasi aktor' : 'Isi detail aktor baru' }}
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

        <form action="{{ $actor->exists ? route('admin.actors.update', $actor->id) : route('admin.actors.store') }}"
            method="POST">

            @csrf
            @if ($actor->exists)
                @method('PUT')
            @endif

            <div class="space-y-6">
                <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6">
                    <h2 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                        Informasi Dasar
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Nama Aktor *</label>
                            <input type="text" name="name" value="{{ old('name', $actor->name) }}" required
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition">
                        </div>

                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Photo URL</label>
                            <input type="text" name="photo_path" value="{{ old('photo_path', $actor->photo_path) }}"
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition"
                                placeholder="https://... atau path lokal">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm text-neutral-400 mb-2">Jenis Kelamin</label>
                                <select name="gender"
                                    class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition">
                                    <option value="">Pilih...</option>
                                    <option value="male" {{ old('gender', $actor->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="female" {{ old('gender', $actor->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm text-neutral-400 mb-2">Tanggal Lahir</label>
                                <input type="date" name="birth_date"
                                    value="{{ old('birth_date', optional($actor->birth_date)->format('Y-m-d')) }}"
                                    class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm text-neutral-400 mb-2">Tempat Lahir</label>
                            <input type="text" name="birth_place" value="{{ old('birth_place', $actor->birth_place) }}"
                                class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition"
                                placeholder="Jakarta, Indonesia">
                        </div>
                    </div>
                </div>

                <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6">
                    <h2 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                        Biografi
                    </h2>

                    <textarea name="bio" rows="6"
                        class="w-full px-4 py-3 bg-black/40 rounded-lg border border-neutral-800 focus:border-green-500 focus:outline-none transition resize-none"
                        placeholder="Tuliskan biografi aktor...">{{ old('bio', $actor->bio) }}</textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 px-6 py-4 bg-green-500 hover:bg-green-400 text-black font-bold rounded-lg transition text-lg">
                        Simpan Aktor
                    </button>
                    <a href="{{ route('admin.actors.index') }}"
                        class="px-6 py-4 bg-neutral-800 hover:bg-neutral-700 text-neutral-300 font-semibold rounded-lg transition text-center">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </main>
</body>

</html>
