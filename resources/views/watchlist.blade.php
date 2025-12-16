<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Your Watchlist — IMIX</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/global.css', 'resources/css/components.css', 'resources/css/layout.css', 'resources/css/watchlist.css', 'resources/js/common.js', 'resources/js/watchlist.js'])
</head>

<body class="bg-[#070707] text-neutral-200">
    <!-- Header -->
    <header id="main-header"></header>
    @if (Auth::check())
        <div class="p-3 bg-green-800 text-sm text-white rounded mb-4">
            Logged in as: {{ Auth::user()->name }} (ID: {{ Auth::id() }})
        </div>
    @else
        <div class="p-3 bg-red-800 text-sm text-white rounded mb-4">
            You are NOT logged in!
        </div>
    @endif

    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-8">
        <!-- Watchlist Header -->
        <section class="header-wrap bg-[#0d0d0d] border border-neutral-800 rounded-lg p-6 mb-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-white leading-tight">Your Watchlist</h1>
                <p class="text-neutral-400 mt-2 max-w-xl">
                    Your Watchlist is the place to track the titles you want to watch. You can sort, reorder, and manage
                    your list here.
                </p>
                <p class="text-sm text-neutral-400 mt-3">by <span class="text-blue-400">rizqi-0</span> • Created 2
                    minutes ago • Modified 43 seconds ago</p>
            </div>
        </section>

        <!-- Watchlist Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Main Watchlist -->
            <section class="lg:col-span-2 space-y-4">
                <!-- Controls -->
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div id="countText" class="text-sm text-neutral-300">2 titles</div>
                        <div class="flex items-center gap-2">
                            <label class="text-sm text-neutral-300">Sort by</label>
                            <select id="sortSelect"
                                class="bg-[#0b0b0b] border border-neutral-800 text-sm rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="list">List order</option>
                                <option value="title">Title (A–Z)</option>
                                <option value="year">Year (new–old)</option>
                                <option value="rating">Rating (high–low)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <div>
                        <button id="editBtn"
                            class="edit-btn px-4 py-2 rounded text-neutral-200 border border-neutral-800 bg-transparent hover:bg-neutral-900 transition-colors">
                            Edit
                        </button>
                    </div>
                </div>

                <!-- Watchlist Items -->
                <div id="listWrapper" class="space-y-4">
                    <!-- Items will be loaded here -->
                </div>
            </section>

            <!-- Sidebar -->
            <aside class="right-col">
                <div class="sticky top-24 space-y-6">
                    <!-- Create List Button -->
                    <div class="flex justify-center">
                        <button id="openCreateTop" class="create-pill-small">
                            <span class="icon-plus">＋</span>
                            <span class="text-content">
                                <div class="title">Create a new list</div>
                                <div class="subtitle">Movie, TV & celebrity picks</div>
                            </span>
                        </button>
                    </div>

                    <!-- User Lists -->
                    <div class="bg-[#0f0f0f] border border-neutral-800 rounded-lg p-4">
                        <h4 class="text-lg font-semibold text-white mb-4">Your lists</h4>
                        <div id="user-lists" class="space-y-3">
                            @forelse($watchlists as $list)
                                <div
                                    class="flex justify-between items-center bg-[#121212] p-2 rounded hover:bg-[#1a1a1a] transition">
                                    <a href="{{ route('watchlist.show', $list->id) }}"
                                        class="{{ isset($activeWatchlist) && $activeWatchlist->id == $list->id ? 'text-blue-400 font-semibold' : 'text-neutral-300 hover:text-white' }}">
                                        {{ $list->name }}
                                    </a>

                                    <form action="{{ route('watchlist.destroy', $list->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this list?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-600 text-sm">✕</button>
                                    </form>
                                </div>
                            @empty
                                <p class="text-neutral-400 text-sm">You haven’t created any lists yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </aside>
        </div>

        <!-- Create List Modal -->
        <div id="create-list-modal" class="modal-overlay hidden">
            <div class="modal-content">
                <form action="{{ route('watchlist.store') }}" method="POST">
                    @csrf
                    <h3 class="text-lg font-semibold mb-4">Create new list</h3>
                    <input type="text" name="name" id="newListName" class="modal-input mb-4"
                        placeholder="List name" required>
                    <div class="flex justify-end gap-2">
                        <button type="button" id="cancelCreate" class="modal-btn-cancel">Cancel</button>
                        <button type="submit" class="modal-btn-confirm">Create</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Modal -->
        <div id="info-modal" class="modal-overlay hidden">
            <div class="modal-content max-w-lg">
                <h3 id="infoTitle" class="text-lg font-semibold mb-2"></h3>
                <div id="infoBody" class="text-neutral-300 mb-4"></div>
                <button id="closeInfo" class="modal-btn-confirm">Close</button>
            </div>
        </div>

        <!-- Modal for Add Review -->
        <div id="reviewModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50 p-3">
            <div class="bg-neutral-900 rounded w-full max-w-sm overflow-hidden">
                <div class="p-2 flex justify-between items-center border-b border-neutral-800">
                    <div class="font-semibold text-xs">Add Your Review</div>
                    <button id="closeReviewModal"
                        class="text-neutral-400 hover:text-white p-1 rounded-full hover:bg-neutral-800 transition text-xs">✕</button>
                </div>
                <div class="p-3">
                    <form id="reviewForm" class="space-y-2">
                        <div>
                            <label class="block text-xs font-medium text-neutral-300 mb-1">Rating</label>
                            <div class="flex items-center space-x-0.5">
                                <button type="button" class="rating-star text-lg" data-value="1">☆</button>
                                <button type="button" class="rating-star text-lg" data-value="2">☆</button>
                                <button type="button" class="rating-star text-lg" data-value="3">☆</button>
                                <button type="button" class="rating-star text-lg" data-value="4">☆</button>
                                <button type="button" class="rating-star text-lg" data-value="5">☆</button>
                                <button type="button" class="rating-star text-lg" data-value="6">☆</button>
                                <button type="button" class="rating-star text-lg" data-value="7">☆</button>
                                <button type="button" class="rating-star text-lg" data-value="8">☆</button>
                                <button type="button" class="rating-star text-lg" data-value="9">☆</button>
                                <button type="button" class="rating-star text-lg" data-value="10">☆</button>
                                <span id="ratingValue" class="ml-1.5 text-xs text-neutral-400">Select rating</span>
                            </div>
                            <input type="hidden" id="selectedRating" name="rating" value="0">
                        </div>

                        <div>
                            <label for="reviewTitle" class="block text-xs font-medium text-neutral-300 mb-1">Review
                                Title</label>
                            <input type="text" id="reviewTitle" name="title"
                                class="w-full px-2 py-1 bg-neutral-800 border border-neutral-700 rounded text-xs focus:ring-1 focus:ring-[var(--imdb-yellow)] focus:border-transparent">
                        </div>

                        <div>
                            <label for="reviewContent" class="block text-xs font-medium text-neutral-300 mb-1">Review
                                Content</label>
                            <textarea id="reviewContent" name="content" rows="3"
                                class="w-full px-2 py-1 bg-neutral-800 border border-neutral-700 rounded text-xs focus:ring-1 focus:ring-[var(--imdb-yellow)] focus:border-transparent"></textarea>
                        </div>

                        <div class="flex justify-end space-x-1.5 pt-2">
                            <button type="button" id="cancelReview"
                                class="px-2 py-1 bg-neutral-800 text-neutral-300 rounded text-xs hover:bg-neutral-700 transition">Cancel</button>
                            <button type="submit"
                                class="px-2 py-1 bg-[var(--imdb-yellow)] text-neutral-900 font-semibold rounded text-xs hover:brightness-110 transition">Submit
                                Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer id="main-footer"></footer>

    <!-- Watchlist Alert Modal -->
    <div id="watchlist-alert-modal"></div>

</body>

</html>
