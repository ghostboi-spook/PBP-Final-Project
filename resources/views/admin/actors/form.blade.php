<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">
        {{ $actor->exists ? 'Edit' : 'Create' }} Actor
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

    <form action="{{ $actor->exists ? route('admin.actors.update', $actor->id) : route('admin.actors.store') }}"
        method="POST">

        @csrf
        @if ($actor->exists)
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="text-sm text-neutral-400">Nama</label>
            <input type="text" name="name" value="{{ old('name', $actor->name) }}"
                class="w-full px-3 py-2 bg-black/40 border border-neutral-800 rounded">
        </div>

        <div class="mb-3">
            <label class="text-sm text-neutral-400">Photo URL</label>
            <input type="text" name="photo_path" value="{{ old('photo_path', $actor->photo_path) }}"
                class="w-full px-3 py-2 bg-black/40 border border-neutral-800 rounded">
        </div>

        <div class="mb-3">
            <label class="text-sm text-neutral-400">Biografi</label>
            <textarea name="bio" rows="5" class="w-full px-3 py-2 bg-black/40 border border-neutral-800 rounded">{{ old('bio', $actor->bio) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-3 mb-3">
            <div>
                <label class="text-sm text-neutral-400">Jenis Kelamin</label>
                <input type="text" name="gender" value="{{ old('gender', $actor->gender) }}"
                    class="w-full px-3 py-2 bg-black/40 border border-neutral-800 rounded">
            </div>
            <div>
                <label class="text-sm text-neutral-400">Tanggal Lahir</label>
                <input type="date" name="birth_date"
                    value="{{ old('birth_date', optional($actor->birth_date)->format('Y-m-d')) }}"
                    class="w-full px-3 py-2 bg-black/40 border border-neutral-800 rounded">
            </div>
        </div>

        <div class="mb-3">
            <label class="text-sm text-neutral-400">Daerah Asal</label>
            <input type="text" name="birth_place" value="{{ old('birth_place', $actor->birth_place) }}"
                class="w-full px-3 py-2 bg-black/40 border border-neutral-800 rounded">
        </div>

        <div class="flex gap-2 mt-5">
            <button class="px-4 py-2 bg-green-500 text-black rounded">
                Save
            </button>
            <a href="{{ route('admin.actors.index') }}" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded">
                Cancel
            </a>
        </div>
    </form>
</div>
