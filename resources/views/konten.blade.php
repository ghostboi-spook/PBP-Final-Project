<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Zootopia 2 — Movie Content</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  @vite([
      'resources/css/global.css',
      'resources/css/components.css',
      'resources/css/layout.css',
      'resources/css/konten.css',
      'resources/js/common.js',
      'resources/js/konten.js'])
</head>
<body>
  <!-- Header -->
  <header id="main-header"></header>

  <div class="max-w-5xl mx-auto p-3">
    <!-- Top hero: poster | visual | side actions -->
    <div class="grid lg:grid-cols-[180px_1fr_200px] gap-3 items-start mb-4">
      <!-- Poster -->
      <div class="rounded-lg overflow-hidden shadow bg-neutral-800 h-56">
        <img src="images/poster.jpg" alt="poster" class="w-full h-full object-cover">
      </div>

      <!-- Main visual -->
      <div class="rounded-lg bg-neutral-800 overflow-hidden relative shadow h-56">
        <img src="images/visual.jpg" alt="visual" class="w-full h-full object-cover">
        <button id="playBtn" class="absolute left-3 bottom-3 flex items-center gap-1.5 bg-black/40 px-2.5 py-1 rounded-full shadow-lg hover:bg-black/50 text-xs">
          <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center border border-white/10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M4 2v20l18-10z"/></svg>
          </span>
          <span class="font-medium">Trailer <span class="text-xs text-neutral-300">2:15</span></span>
        </button>
      </div>

      <!-- Side actions -->
      <div class="flex flex-col gap-2">
        <button id="watchlist" class="bg-[var(--imdb-yellow)] text-neutral-900 font-bold px-3 py-2 rounded-lg shadow hover:brightness-110 transition text-xs">+ Add to Watchlist</button>
        <button class="bg-neutral-800 text-neutral-300 px-3 py-2 rounded-lg hover:bg-neutral-700 transition text-xs">Mark as watched</button>
        <div class="bg-neutral-800 p-2 rounded-lg text-center">
          <div class="text-xs text-neutral-400">IN THEATERS</div>
          <div class="mt-1 p-3 bg-neutral-900 rounded text-lg">🎟️</div>
        </div>
      </div>
    </div>

    <!-- Title, meta, tags -->
    <div class="mb-3">
      <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
        <h1 class="text-xl sm:text-2xl font-bold">Zootopia 2</h1>
        <div class="text-xs text-neutral-400 font-medium">2025 · SU · 1h 48m</div>
        <div class="sm:ml-auto flex items-center gap-2">
          <div class="flex items-center gap-1">
            <svg class="w-4 h-4 text-[var(--imdb-yellow)]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L23.327 9.5l-5.658 5.516L18.995 24 12 20.013 5.005 24l1.326-9.0L.673 9.5l7.659-1.482L12 .587z"/></svg>
            <div class="text-xl font-bold">7.7</div>
            <div class="text-xs text-neutral-400">22.7K</div>
          </div>
        </div>
      </div>

      <div class="flex flex-wrap gap-1.5 mt-2">
        <span class="px-2 py-0.5 bg-neutral-800 rounded-full text-neutral-300 text-xs">Animal Adventure</span>
        <span class="px-2 py-0.5 bg-neutral-800 rounded-full text-neutral-300 text-xs">Buddy Comedy</span>
        <span class="px-2 py-0.5 bg-neutral-800 rounded-full text-neutral-300 text-xs">Animation</span>
        <span class="px-2 py-0.5 bg-neutral-800 rounded-full text-neutral-300 text-xs">Adventure</span>
      </div>
    </div>

    <hr class="border-neutral-800 my-3">

    <!-- Content grid: storyline | sidebar -->
    <div class="grid lg:grid-cols-[1fr_250px] gap-3">
      <div class="space-y-3">
        <!-- Storyline with read more toggle -->
        <div class="bg-neutral-800 p-3 rounded-lg">
          <h2 class="text-base font-semibold mb-1.5">Storyline</h2>
          <div id="storylineContent" class="text-neutral-300 leading-snug text-xs storyline-content">
            <p>Officers Judy Hopps and Nick Wilde are still fighting to be taken seriously as detectives - a struggle that gets worse when their off-the-books smuggling probe turns into a public disaster. With Chief Bogo threatening to split them up, the pair chase one last lead...</p>
          </div>
          
          <button id="readMoreBtn" class="mt-2 px-2.5 py-1 bg-neutral-700 hover:bg-neutral-600 rounded text-xs font-medium transition">Read full storyline</button>

          <div class="mt-3 flex flex-wrap gap-1">
            <span class="text-xs px-1.5 py-0.5 bg-neutral-900 rounded-full text-neutral-400">animal</span>
            <span class="text-xs px-1.5 py-0.5 bg-neutral-900 rounded-full text-neutral-400">animation</span>
            <span class="text-xs px-1.5 py-0.5 bg-neutral-900 rounded-full text-neutral-400">sequel</span>
            <span class="text-xs px-1.5 py-0.5 bg-neutral-900 rounded-full text-neutral-400">comedy</span>
          </div>
        </div>

        <!-- Ratings & Featured Reviews -->
        <div class="bg-neutral-800 p-3 rounded-lg">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
            <div class="flex items-center gap-2">
              <div class="text-2xl font-bold">7.7</div>
              <div class="text-xs text-neutral-400">User reviews · 245</div>
            </div>
            
            <!-- Add Review Button -->
            <button id="addReviewBtn" class="px-2.5 py-1 bg-[var(--imdb-yellow)] text-neutral-900 font-semibold rounded hover:brightness-110 transition text-xs w-fit">
              + Add Review
            </button>
          </div>

          <div class="mb-3 space-y-1">
            <!-- simple histogram mockup -->
            <div class="flex items-center gap-1.5">
              <div class="w-5 text-xs text-neutral-400">8</div>
              <div class="flex-1 bg-neutral-900 rounded h-1.5 overflow-hidden relative">
                <div style="width:62%" class="absolute left-0 top-0 bottom-0 bg-gradient-to-r from-sky-600 to-emerald-400"></div>
              </div>
              <div class="w-7 text-right text-neutral-400 text-xs">7.8k</div>
            </div>
            <div class="flex items-center gap-1.5">
              <div class="w-5 text-xs text-neutral-400">9</div>
              <div class="flex-1 bg-neutral-900 rounded h-1.5 overflow-hidden relative">
                <div style="width:46%" class="absolute left-0 top-0 bottom-0 bg-gradient-to-r from-sky-600 to-emerald-400"></div>
              </div>
              <div class="w-7 text-right text-neutral-400 text-xs">5.6k</div>
            </div>
          </div>

          <!-- Scrollable Reviews Container -->
          <div>
            <h3 class="text-sm font-semibold mb-2">Featured Reviews</h3>
            <div class="reviews-scroll-container flex space-x-2 overflow-x-auto pb-2 px-1">
              <div class="min-w-[180px] p-2 rounded bg-neutral-900 hover:bg-neutral-850 transition flex-shrink-0">
                <div class="flex items-center gap-1"><span class="font-semibold text-xs">8</span> <span class="text-xs text-neutral-400">jeremy-916</span></div>
                <h3 class="mt-1 font-bold text-xs">Fun Disney movie</h3>
                <p class="mt-0.5 text-neutral-400 text-xs">I'm going to be honest, I haven't been impressed with Disney's performance lately...</p>
              </div>
              <div class="min-w-[180px] p-2 rounded bg-neutral-900 hover:bg-neutral-850 transition flex-shrink-0">
                <div class="flex items-center gap-1"><span class="font-semibold text-xs">8</span> <span class="text-xs text-neutral-400">anchitbaishya</span></div>
                <h3 class="mt-1 font-bold text-xs">A Solid Sequel</h3>
                <p class="mt-0.5 text-neutral-400 text-xs">Zootopia 2 is a BLAST!!! Honestly after being disappointed by Disney Animation's last three outings...</p>
              </div>
              <div class="min-w-[180px] p-2 rounded bg-neutral-900 hover:bg-neutral-850 transition flex-shrink-0">
                <div class="flex items-center gap-1"><span class="font-semibold text-xs">9</span> <span class="text-xs text-neutral-400">animation_lover</span></div>
                <h3 class="mt-1 font-bold text-xs">Animation at its finest</h3>
                <p class="mt-0.5 text-neutral-400 text-xs">The animation quality is stunning, every frame is a work of art...</p>
              </div>
              <div class="min-w-[180px] p-2 rounded bg-neutral-900 hover:bg-neutral-850 transition flex-shrink-0">
                <div class="flex items-center gap-1"><span class="font-semibold text-xs">7</span> <span class="text-xs text-neutral-400">critic_reviewer</span></div>
                <h3 class="mt-1 font-bold text-xs">Good but not great</h3>
                <p class="mt-0.5 text-neutral-400 text-xs">While entertaining, the plot feels somewhat recycled...</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Cast Section -->
        <div class="bg-neutral-800 p-3 rounded-lg">
          <h2 class="text-base font-semibold mb-2">Cast</h2>
          <div class="text-xs text-neutral-400 mb-2">(in credits order)</div>
          
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 max-h-36 overflow-y-auto pr-1 cast-scroll">
            <!-- Cast Member 1 -->
            <div class="flex items-start gap-1.5 p-1.5 bg-neutral-900 rounded hover:bg-neutral-850 transition">
              <div class="w-6 h-6 rounded-full bg-neutral-700 flex items-center justify-center text-xs font-bold flex-shrink-0">GG</div>
              <div>
                <div class="font-medium text-xs">Ginnifer Goodwin</div>
                <div class="text-xs text-neutral-400">Judy Hopps (voice)</div>
              </div>
            </div>
            
            <!-- Cast Member 2 -->
            <div class="flex items-start gap-1.5 p-1.5 bg-neutral-900 rounded hover:bg-neutral-850 transition">
              <div class="w-6 h-6 rounded-full bg-neutral-700 flex items-center justify-center text-xs font-bold flex-shrink-0">JB</div>
              <div>
                <div class="font-medium text-xs">Jason Bateman</div>
                <div class="text-xs text-neutral-400">Nick Wilde (voice)</div>
              </div>
            </div>
            
            <!-- Cast Member 3 -->
            <div class="flex items-start gap-1.5 p-1.5 bg-neutral-900 rounded hover:bg-neutral-850 transition">
              <div class="w-6 h-6 rounded-full bg-neutral-700 flex items-center justify-center text-xs font-bold flex-shrink-0">KQ</div>
              <div>
                <div class="font-medium text-xs">Ke Huy Quan</div>
                <div class="text-xs text-neutral-400">Gary De'Snake (voice)</div>
              </div>
            </div>
            
            <!-- Cast Member 4 -->
            <div class="flex items-start gap-1.5 p-1.5 bg-neutral-900 rounded hover:bg-neutral-850 transition">
              <div class="w-6 h-6 rounded-full bg-neutral-700 flex items-center justify-center text-xs font-bold flex-shrink-0">FF</div>
              <div>
                <div class="font-medium text-xs">Fortune Feimster</div>
                <div class="text-xs text-neutral-400">Nibbles Maplestick (voice)</div>
              </div>
            </div>
            
            <!-- Cast Member 5 -->
            <div class="flex items-start gap-1.5 p-1.5 bg-neutral-900 rounded hover:bg-neutral-850 transition">
              <div class="w-6 h-6 rounded-full bg-neutral-700 flex items-center justify-center text-xs font-bold flex-shrink-0">AS</div>
              <div>
                <div class="font-medium text-xs">Andy Samberg</div>
                <div class="text-xs text-neutral-400">Pawbert Lynxley (voice)</div>
              </div>
            </div>
            
            <!-- Cast Member 6 -->
            <div class="flex items-start gap-1.5 p-1.5 bg-neutral-900 rounded hover:bg-neutral-850 transition">
              <div class="w-6 h-6 rounded-full bg-neutral-700 flex items-center justify-center text-xs font-bold flex-shrink-0">DS</div>
              <div>
                <div class="font-medium text-xs">David Strathairn</div>
                <div class="text-xs text-neutral-400">Milton Lynxley (voice)</div>
              </div>
            </div>
            
            <!-- Cast Member 7 -->
            <div class="flex items-start gap-1.5 p-1.5 bg-neutral-900 rounded hover:bg-neutral-850 transition">
              <div class="w-6 h-6 rounded-full bg-neutral-700 flex items-center justify-center text-xs font-bold flex-shrink-0">IE</div>
              <div>
                <div class="font-medium text-xs">Idris Elba</div>
                <div class="text-xs text-neutral-400">Chief Bogo (voice)</div>
              </div>
            </div>
            
            <!-- Cast Member 8 -->
            <div class="flex items-start gap-1.5 p-1.5 bg-neutral-900 rounded hover:bg-neutral-850 transition">
              <div class="w-6 h-6 rounded-full bg-neutral-700 flex items-center justify-center text-xs font-bold flex-shrink-0">SH</div>
              <div>
                <div class="font-medium text-xs">Shakira</div>
                <div class="text-xs text-neutral-400">Gazelle (voice)</div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- right sidebar details -->
      <div class="space-y-3">
        <!-- Details Section -->
        <div class="bg-neutral-800 p-3 rounded-lg">
          <h3 class="text-sm font-semibold mb-2 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-[var(--imdb-yellow)]" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
            Details
          </h3>
          
          <div class="space-y-2">
            <!-- Details Information -->
            <div class="space-y-2 text-xs">
              <div>
                <div class="text-neutral-400 font-medium">Release date</div>
                <div class="text-neutral-300">Nov 26, 2025 (Indonesia)</div>
              </div>
              
              <div>
                <div class="text-neutral-400 font-medium">Country</div>
                <div class="text-neutral-300">United States</div>
              </div>
              
              <div>
                <div class="text-neutral-400 font-medium">Language</div>
                <div class="text-neutral-300">English</div>
              </div>
              
              <div>
                <div class="text-neutral-400 font-medium">Also known as</div>
                <div class="text-neutral-300">Phi Vụ Động Trời 2</div>
              </div>
              
              <div>
                <div class="text-neutral-400 font-medium">Filming locations</div>
                <div class="text-neutral-300">Walt Disney Animation Studios, Burbank, California</div>
              </div>
              
              <div>
                <div class="text-neutral-400 font-medium">Production companies</div>
                <div class="text-neutral-300">Walt Disney Animation Studios · Walt Disney Pictures</div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Taglines and Certificate -->
        <div class="bg-neutral-800 p-3 rounded-lg text-center">
          <div class="text-xs text-neutral-400">Taglines</div>
          <div class="font-semibold mt-0.5 text-xs">They're back with a twissst.</div>
        </div>

        <div class="bg-neutral-800 p-3 rounded-lg text-center">
          <div class="text-xs text-neutral-400">Certificate</div>
          <div class="font-semibold mt-0.5 text-base">SU</div>
        </div>
        
        <!-- Crew Info Sidebar -->
        <div class="bg-neutral-800 p-3 rounded-lg">
          <h3 class="text-sm font-semibold mb-2">Key Crew</h3>
          
          <div class="space-y-2 text-xs">
            <div>
              <div class="font-medium">Directors</div>
              <div class="text-neutral-400">Jared Bush · Byron Howard</div>
            </div>
            
            <div>
              <div class="font-medium">Writer</div>
              <div class="text-neutral-400">Jared Bush</div>
            </div>
            
            <div>
              <div class="font-medium">Stars</div>
              <div class="text-neutral-400">Ginnifer Goodwin · Jason Bateman · Ke Huy Quan</div>
            </div>
            
            <div>
              <div class="font-medium">Genres</div>
              <div class="text-neutral-300">Animation · Action · Adventure · Comedy · Crime</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer id="main-footer"></footer>

  <!-- Watchlist Alert Modal -->
  <div id="watchlist-alert-modal"></div>

  <!-- Modal for trailer -->
  <div id="modal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50 p-3">
    <div class="bg-neutral-900 rounded w-full max-w-2xl overflow-hidden">
      <div class="p-2 flex justify-between items-center border-b border-neutral-800">
        <div class="font-semibold text-xs">Trailer - Zootopia 2</div>
        <button id="closeModal" class="text-neutral-400 hover:text-white p-1 rounded-full hover:bg-neutral-800 transition text-xs">✕</button>
      </div>
      <div class="bg-black aspect-video">
        <iframe class="w-full h-full" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="trailer" allowfullscreen></iframe>
      </div>
    </div>
  </div>

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