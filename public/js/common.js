document.addEventListener("DOMContentLoaded", () => {
    renderHeader();
    renderFooter();
});

function renderHeader() {
    const header = document.getElementById("main-header");
    if (!header) return;

    const user = window.AUTH_USER ?? null;

    header.innerHTML = `
        <div class="bg-black border-b border-neutral-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 sm:py-4">
                <div class="flex items-center justify-between gap-4">
                    <a href="/" class="font-extrabold text-lg text-green-500 flex-shrink-0">
                        IMIX
                    </a>

                    <form id="searchForm" action="/search" method="GET"
                        class="flex-1 max-w-xl flex items-center gap-2">
                        <div class="relative w-full">
                            <input
                                name="q"
                                id="searchInput"
                                placeholder="Cari film atau aktor..."
                                class="w-full rounded-md px-4 py-2 pl-10
                                       bg-neutral-900 border border-neutral-800
                                       focus:border-green-500 focus:ring-1 focus:ring-green-500
                                       focus:outline-none text-sm transition text-white"
                            />
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-neutral-500"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                        <button type="submit"
                            class="bg-green-500 text-black font-bold px-3 sm:px-4 py-2
                                   rounded-md text-sm hover:bg-green-400 transition flex-shrink-0">
                            <span class="hidden sm:inline">Search</span>
                            <svg class="w-4 h-4 sm:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </form>

                    <div class="flex items-center gap-3 sm:gap-6 text-sm flex-shrink-0">
                        ${user ? renderUserMenu() : renderAuthButtons()}
                    </div>
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

function renderFooter() {
    const footer = document.getElementById("main-footer");
    if (!footer) return;

    footer.innerHTML = `
        <div class="bg-[#0f0f0f] border-t border-neutral-800 mt-16">

            <!-- MAIN FOOTER -->
            <div class="max-w-7xl mx-auto px-6 py-14 flex flex-col items-center text-center gap-4">

                <!-- LOGO -->
                <button id="footerScrollTop"
                    class="bg-green-500 text-black font-black px-4 py-1.5 rounded
                           text-lg hover:brightness-110 transition">
                    IMIX
                </button>

                <!-- DESCRIPTION -->
                <p class="max-w-xl text-sm text-neutral-500 leading-relaxed">
                    Platform katalog film & serial lokal. Temukan rekomendasi,
                    simpan watchlist, dan ikuti update rilisan terbaru.
                </p>
            </div>

            <!-- BOTTOM BAR -->
            <div class="border-t border-neutral-800">
                <div
                    class="max-w-7xl mx-auto px-6 py-6
                           flex flex-col sm:flex-row justify-between items-center
                           gap-2 text-xs text-neutral-500">

                    <p>© ${new Date().getFullYear()} IMIX</p>
                    <p>Made with ♥ for Indonesian Cinema</p>
                </div>
            </div>
        </div>
    `;

    const scrollBtn = document.getElementById("footerScrollTop");
    if (scrollBtn) {
        scrollBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    }
}
