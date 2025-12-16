document.addEventListener("DOMContentLoaded", () => {
    renderHeader();
    renderFooter();
});

/* =========================
   HEADER
========================= */

function renderHeader() {
    const header = document.getElementById("main-header");
    if (!header) return;

    const user = window.AUTH_USER ?? null;

    header.innerHTML = `
        <div class="bg-black border-b border-neutral-800">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center gap-6">
                
                <!-- Logo -->
                <a href="/" class="font-extrabold text-lg text-green-500">
                    IMIX
                </a>

                <!-- Search -->
                <form id="searchForm" action="/search" method="GET"
      class="flex-1 max-w-xl mx-auto relative flex items-center gap-2">

    <div class="relative w-full">
        <!-- Search Input -->
        <input
            name="q"
            id="searchInput"
            placeholder="Search movie, series, actor, director..."
            class="w-full rounded-md px-4 py-2 pl-10 pr-32
                   bg-neutral-900 border border-neutral-800
                   focus:border-green-500 focus:ring-1 focus:ring-green-500
                   focus:outline-none text-sm transition text-white"
        />

        <!-- Search Icon -->
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-4 h-4 absolute left-3 top-3 text-neutral-500"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"
                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>

        <!-- FILTER DROPDOWN -->
        <div class="absolute right-0 top-0 h-full flex items-center">
            <button type="button"
                id="searchFilterButton"
                class="h-full px-3 bg-neutral-900 border border-l-0 border-neutral-800
                       rounded-r-md text-neutral-400 hover:text-white
                       hover:bg-neutral-800 transition text-sm flex items-center">
                <span id="selectedFilterText">All</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1"
                     viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586
                             l3.293-3.293a1 1 0 111.414 1.414
                             l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd" />
                </svg>
            </button>

            <input type="hidden" id="searchType" name="type" value="all">

            <!-- OPTIONS -->
            <div id="filterOptions"
                 class="absolute right-0 top-full mt-1 w-48
                        bg-[#0f0f0f] border border-neutral-800
                        rounded-md shadow-lg z-50 hidden">

                <button type="button" class="filter-option" data-value="all">All</button>
                <button type="button" class="filter-option" data-value="movie">Movies</button>
                <button type="button" class="filter-option" data-value="series">Series</button>
                <button type="button" class="filter-option" data-value="actor">Actors</button>
                <button type="button" class="filter-option" data-value="director">Directors</button>
            </div>
        </div>
    </div>

    <!-- SUBMIT -->
    <button type="submit"
        class="bg-green-500 text-black font-bold px-4 py-2
               rounded-md text-sm hover:bg-green-400 transition">
        Search
    </button>
</form>


                <!-- Right menu -->
                <div class="flex items-center gap-6 ml-auto text-sm">
                    ${user ? renderUserMenu() : renderAuthButtons()}
                </div>
            </div>
        </div>
    `;
    document.addEventListener("click", (e) => {
        const btn = document.getElementById("searchFilterButton");
        const options = document.getElementById("filterOptions");

        if (!btn || !options) return;

        if (btn.contains(e.target)) {
            options.classList.toggle("hidden");
            return;
        }

        if (!options.contains(e.target)) {
            options.classList.add("hidden");
        }
    });

    document.querySelectorAll(".filter-option").forEach((opt) => {
        opt.className =
            "block w-full text-left px-4 py-2 text-sm text-neutral-300 hover:bg-neutral-800 hover:text-white transition";

        opt.addEventListener("click", () => {
            document.getElementById("selectedFilterText").textContent =
                opt.textContent;
            document.getElementById("searchType").value = opt.dataset.value;
            document.getElementById("filterOptions").classList.add("hidden");
        });
    });
}

/* =========================
   USER MENU (LOGIN)
========================= */

function renderUserMenu() {
    return `
        <a href="/watchlist" class="hover:text-green-400 transition">
            Watchlist
        </a>
        <a href="/profile" class="hover:text-green-400 transition">
            Profile
        </a>
    `;
}

/* =========================
   AUTH BUTTONS (GUEST)
========================= */

function renderAuthButtons() {
    return `
        <a href="/login" class="hover:text-green-400 transition">
            Login
        </a>
        <a href="/register"
           class="px-3 py-2 bg-green-500 text-black rounded-lg font-semibold hover:brightness-110 transition">
            Register
        </a>
    `;
}

/* =========================
   FOOTER
========================= */

function renderFooter() {
    const footer = document.getElementById("main-footer");
    if (!footer) return;

    footer.innerHTML = `
        <div class="bg-[#0f0f0f] border-t border-neutral-800 mt-16">
            <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-4 gap-10">

                <div>
                    <div class="bg-green-500 text-black font-black px-3 py-1 rounded w-fit text-lg mb-4">
                        IMIX
                    </div>
                    <p class="text-sm text-neutral-500">
                        Platform katalog film & serial lokal. Temukan rekomendasi,
                        simpan watchlist, dan ikuti update rilisan terbaru.
                    </p>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-neutral-400">
                        <li><a href="/" class="hover:text-green-400">Home</a></li>
                        <li><a href="#" class="hover:text-green-400">Browse</a></li>
                        <li><a href="#" class="hover:text-green-400">Top 10</a></li>
                        <li><a href="#" class="hover:text-green-400">New Releases</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm text-neutral-400">
                        <li><a href="#" class="hover:text-green-400">Help Center</a></li>
                        <li><a href="#" class="hover:text-green-400">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-green-400">Terms of Service</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm text-neutral-400">
                        <li>Email: support@imix.com</li>
                        <li>Phone: +62 123 4567 890</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-neutral-800 mt-8">
                <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between text-xs text-neutral-500">
                    <p>© ${new Date().getFullYear()} IMIX</p>
                    <p>Made with ♥ for Indonesian Cinema</p>
                </div>
            </div>
        </div>
    `;

    document.addEventListener("click", (e) => {
        const btn = document.getElementById("searchFilterButton");
        const options = document.getElementById("filterOptions");

        if (!btn || !options) return;

        if (btn.contains(e.target)) {
            options.classList.toggle("hidden");
            return;
        }

        if (!options.contains(e.target)) {
            options.classList.add("hidden");
        }
    });
}
