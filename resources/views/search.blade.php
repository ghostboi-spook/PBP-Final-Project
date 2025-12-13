<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Search Result - IMIX</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite([
      'resources/css/global.css',
      'resources/css/components.css',
      'resources/css/layout.css',
      'resources/css/search.css',
      'resources/js/common.js',
      'resources/js/search.js'])
</head>
<body class="bg-[#070707] text-slate-100 min-h-screen">
    <!-- Header -->
    <header id="main-header"></header>

    <!-- Search Content -->
    <div class="search-container">
        <h1 class="search-title" id="search-query">Search "zoo"</h1>
        <div class="content-wrapper">
            <!-- Search Results -->
            <div class="w-full">
                <!-- Titles Section -->
                <div class="titles-header">
                    <h2 class="section-title">Movies & TV</h2>
                    <span class="text-neutral-400 text-sm">
                        Found <span id="result-count">3</span> results
                    </span>
                </div>
                
                <!-- Search Results List -->
                <div id="search-results" class="space-y-4">
                    <!-- Results will be loaded here -->
                </div>

                <!-- People Section -->
                <div class="mt-8">
                    <div class="titles-header">
                        <h2 class="section-title">People</h2>
                    </div>
                    <div id="people-results" class="people-grid">
                        <!-- People results will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="main-footer"></footer>

    <!-- Watchlist Alert Modal -->
    <div id="watchlist-alert-modal"></div>

    <!-- Modal for Add Review -->
    <div id="reviewModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50 p-3">
        <div class="bg-neutral-900 rounded w-full max-w-sm overflow-hidden">
            <div class="p-2 flex justify-between items-center border-b border-neutral-800">
                <div class="font-semibold text-xs">Add Your Review</div>
                <button id="closeReviewModal" class="text-neutral-400 hover:text-white p-1 rounded-full hover:bg-neutral-800 transition text-xs">✕</button>
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
                        <label for="reviewTitle" class="block text-xs font-medium text-neutral-300 mb-1">Review Title</label>
                        <input type="text" id="reviewTitle" name="title" class="w-full px-2 py-1 bg-neutral-800 border border-neutral-700 rounded text-xs focus:ring-1 focus:ring-[var(--imdb-yellow)] focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="reviewContent" class="block text-xs font-medium text-neutral-300 mb-1">Review Content</label>
                        <textarea id="reviewContent" name="content" rows="3" class="w-full px-2 py-1 bg-neutral-800 border border-neutral-700 rounded text-xs focus:ring-1 focus:ring-[var(--imdb-yellow)] focus:border-transparent"></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-1.5 pt-2">
                        <button type="button" id="cancelReview" class="px-2 py-1 bg-neutral-800 text-neutral-300 rounded text-xs hover:bg-neutral-700 transition">Cancel</button>
                        <button type="submit" class="px-2 py-1 bg-[var(--imdb-yellow)] text-neutral-900 font-semibold rounded text-xs hover:brightness-110 transition">Submit Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>