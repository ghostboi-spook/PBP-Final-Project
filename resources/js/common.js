// ===== COMMON FUNCTIONALITY FOR ALL PAGES =====

document.addEventListener('DOMContentLoaded', function() {
    console.log('Common.js loaded');
    
    // Load reusable components
    loadHeader();
    loadFooter();
    loadWatchlistAlert();
    
    // Initialize common functionality
    initializeProfileDropdown();
    initializeBackToTop();
    initializeCurrentYear();
    
    // Search functionality (if search input exists on page)
    initializeSearch();
    initializeSearchFilters();
});

// ===== LOAD REUSABLE COMPONENTS =====

function loadHeader() {
    const headerElement = document.getElementById('main-header');
    if (!headerElement) {
        console.log('Header element not found');
        return;
    }
    
    // Cek jika header sudah di-load (untuk menghindari duplikasi)
    if (headerElement.innerHTML.trim() !== '') {
        console.log('Header already loaded');
        return;
    }
    
    headerElement.innerHTML = `
        <div class="bg-[#0f0f0f] border-b border-neutral-800 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 py-3 flex items-center gap-6">
                
                <!-- Logo -->
                <div class="flex items-center gap-4">
                    <a href="index.html" class="bg-green-500 text-black font-black px-3 py-1 rounded text-lg tracking-tighter hover:bg-green-400 transition">IMIX</a>
                    <button class="md:hidden p-2 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>

                <!-- Search Bar -->
                <div class="flex-1">
                    <form id="searchForm" action="search.html" method="GET" class="max-w-xl mx-auto relative flex items-center gap-2">
                        <div class="relative w-full">
                            <!-- Search Input -->
                            <input 
                                name="q"
                                id="searchInput"
                                placeholder="Search movie, series, actor, director..."
                                class="w-full rounded-md px-4 py-2 pl-10 pr-32 bg-neutral-900 border border-neutral-800 focus:border-green-500 focus:ring-1 focus:ring-green-500 focus:outline-none text-sm transition text-white"
                            />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 absolute left-3 top-3 text-neutral-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            
                            <!-- Search Filter Dropdown (di sebelah kanan) -->
                            <div id="searchFilterDropdown" class="absolute right-0 top-0 h-full flex items-center">
                                <button type="button" id="searchFilterButton" class="h-full px-3 bg-neutral-900 border border-l-0 border-neutral-800 rounded-r-md text-neutral-400 hover:text-white hover:bg-neutral-800 transition-colors text-sm flex items-center">
                                    <span id="selectedFilterText">All</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <input type="hidden" id="searchType" name="type" value="all">
                                
                                <!-- Filter Options -->
                                <div id="filterOptions" class="absolute right-0 top-full mt-1 w-48 bg-[#0f0f0f] border border-neutral-800 rounded-md shadow-lg z-50 hidden">
                                    <div class="py-1">
                                        <button type="button" class="filter-option w-full text-left px-4 py-2 text-sm text-neutral-300 hover:bg-neutral-800 hover:text-white transition-colors" data-value="all" data-text="All">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                                </svg>
                                                All Categories
                                            </div>
                                        </button>
                                        <button type="button" class="filter-option w-full text-left px-4 py-2 text-sm text-neutral-300 hover:bg-neutral-800 hover:text-white transition-colors" data-value="movie" data-text="Movies">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                                </svg>
                                                Movies
                                            </div>
                                        </button>
                                        <button type="button" class="filter-option w-full text-left px-4 py-2 text-sm text-neutral-300 hover:bg-neutral-800 hover:text-white transition-colors" data-value="series" data-text="Series">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z" clip-rule="evenodd" />
                                                </svg>
                                                Series
                                            </div>
                                        </button>
                                        <div class="border-t border-neutral-800 my-1"></div>
                                        <button type="button" class="filter-option w-full text-left px-4 py-2 text-sm text-neutral-300 hover:bg-neutral-800 hover:text-white transition-colors" data-value="actor" data-text="Actors">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                </svg>
                                                Actors
                                            </div>
                                        </button>
                                        <button type="button" class="filter-option w-full text-left px-4 py-2 text-sm text-neutral-300 hover:bg-neutral-800 hover:text-white transition-colors" data-value="director" data-text="Directors">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                                </svg>
                                                Directors
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="bg-green-500 text-black font-bold px-4 py-2 rounded-md text-sm hover:bg-green-400 transition">
                            Search
                        </button>
                    </form>
                </div>

                <!-- User Actions -->
                <div class="hidden md:flex items-center gap-6 text-sm font-medium text-neutral-300">
                    <a href="watchlist.html" class="hover:text-green-400 transition">Watchlist</a>
                    <div class="relative group">
                        <button id="profileBtn" class="flex items-center gap-2 hover:text-green-400 transition">
                            Profile
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-[#0f0f0f] border border-neutral-800 rounded-lg shadow-lg hidden">
                            <div class="p-4">
                                <p class="text-sm text-neutral-400 mb-3">Kamu belum masuk</p>
                                <a href="login.html" class="w-full block text-center mb-2 px-4 py-2 bg-green-500 text-black font-semibold rounded hover:bg-green-400 transition">
                                    Sign up
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    console.log('Header loaded successfully');
}

function loadFooter() {
    const footerElement = document.getElementById('main-footer');
    if (!footerElement) {
        console.log('Footer element not found');
        return;
    }
    
    // Cek jika footer sudah di-load
    if (footerElement.innerHTML.trim() !== '') {
        console.log('Footer already loaded');
        return;
    }
    
    const currentYear = new Date().getFullYear();
    
    footerElement.innerHTML = `
        <div class="bg-[#0f0f0f] border-t border-neutral-800 py-12">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="bg-green-500 text-black font-black px-3 py-1 rounded w-fit text-lg tracking-tighter mb-4">IMIX</div>
                    <p class="text-neutral-500 text-sm leading-relaxed">
                        Platform katalog film & serial lokal. Temukan rekomendasi, simpan watchlist, dan ikuti update rilisan terbaru.
                    </p>
                    <div class="flex gap-6 mt-6">
                        <!-- Twitter -->
                        <a href="#" class="text-white hover:text-green-500 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#" class="text-white hover:text-green-500 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.904 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.9 2.4c.636-.247 1.363-.416 2.427-.465C9.373 2.013 9.73 2 12.18 2h.165zm0 1.981h.166c-2.403 0-2.698.01-3.647.053-.86.04-1.326.185-1.638.307-.413.16-.708.35-.998.64-.29.29-.48.585-.64.998-.122.312-.267.778-.307 1.638-.043.949-.053 1.244-.053 3.647s.01 2.698.053 3.647c.04.86.185 1.326.307 1.638.16.413.35.708.64.998.29.29.585.48.998.64.312.122.778.267 1.638.307.949.043 1.244.053 3.647.053s2.698-.01 3.647-.053c.86-.04 1.326-.185 1.638-.307.413-.16.708-.35.998-.64.29-.29.48-.585.64-.998.122-.312.267-.778.307-1.638.043-.949.053-1.244.053-3.647s-.01-2.698-.053-3.647c-.04-.86-.185-1.326-.307-1.638-.16-.413-.35-.708-.64-.998-.29-.29-.585-.48-.998-.64-.312-.122-.778-.267-1.638-.307-.949-.043-1.244-.053-3.647-.053zM12.316 6.878a5.438 5.438 0 110 10.875 5.438 5.438 0 010-10.875zm0 1.982a3.456 3.456 0 100 6.911 3.456 3.456 0 000-6.911zm5.784-3.57a1.32 1.32 0 110 2.64 1.32 1.32 0 010-2.64z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <!-- Facebook -->
                        <a href="#" class="text-white hover:text-green-500 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-bold text-white mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-neutral-400">
                        <li><a href="index.html" class="hover:text-green-400 transition">Home</a></li>
                        <li><a href="#" class="hover:text-green-400 transition">Browse</a></li>
                        <li><a href="#" class="hover:text-green-400 transition">Top 10</a></li>
                        <li><a href="#" class="hover:text-green-400 transition">New Releases</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-4">Support</h4>
                    <ul class="space-y-2 text-sm text-neutral-400">
                        <li><a href="#" class="hover:text-green-400 transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-green-400 transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-green-400 transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-green-400 transition">Cookie Preferences</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-sm text-neutral-400">
                        <li>Email: support@imix.com</li>
                        <li>Phone: +62 123 4567 890</li>
                    </ul>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-6 mt-12 pt-8 border-t border-neutral-800 flex flex-col md:flex-row justify-between items-center text-xs text-neutral-600">
                <p>&copy; 2025 IMIX. All rights reserved.</p>
                <p>Made with &hearts; for Indonesian Cinema</p>
            </div>
        </div>
    `;
    
    console.log('Footer loaded successfully');
}

// ===== SEARCH FILTER FUNCTIONALITY =====

function initializeSearchFilters() {
    const filterButton = document.getElementById('searchFilterButton');
    const filterOptions = document.getElementById('filterOptions');
    const selectedFilterText = document.getElementById('selectedFilterText');
    const searchTypeInput = document.getElementById('searchType');
    
    if (!filterButton || !filterOptions) return;
    
    // Toggle filter dropdown
    filterButton.addEventListener('click', (e) => {
        e.stopPropagation();
        filterOptions.classList.toggle('hidden');
    });
    
    // Handle filter selection
    const filterOptionsList = filterOptions.querySelectorAll('.filter-option');
    filterOptionsList.forEach(option => {
        option.addEventListener('click', () => {
            const value = option.getAttribute('data-value');
            const text = option.getAttribute('data-text');
            
            // Update selected filter text
            selectedFilterText.textContent = text;
            
            // Update hidden input value
            searchTypeInput.value = value;
            
            // Update placeholder based on selected filter
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                switch(value) {
                    case 'movie':
                        searchInput.placeholder = 'Search movies...';
                        break;
                    case 'series':
                        searchInput.placeholder = 'Search series...';
                        break;
                    case 'actor':
                        searchInput.placeholder = 'Search actors...';
                        break;
                    case 'director':
                        searchInput.placeholder = 'Search directors...';
                        break;
                    case 'genre':
                        searchInput.placeholder = 'Search genres...';
                        break;
                    default:
                        searchInput.placeholder = 'Search movie, series, actor, director...';
                }
            }
            
            // Close dropdown
            filterOptions.classList.add('hidden');
            
            // Show notification (optional)
            console.log(`Filter selected: ${text}`);
        });
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!filterButton.contains(e.target) && !filterOptions.contains(e.target)) {
            filterOptions.classList.add('hidden');
        }
    });
    
    // Close on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            filterOptions.classList.add('hidden');
        }
    });
    
    // Add visual feedback on form submission
    const searchForm = document.getElementById('searchForm');
    if (searchForm) {
        searchForm.addEventListener('submit', (e) => {
            const searchInput = document.getElementById('searchInput');
            const searchTerm = searchInput.value.trim();
            const searchType = searchTypeInput.value;
            
            if (!searchTerm) {
                e.preventDefault();
                showNotification('Please enter a search term');
                searchInput.focus();
                return;
            }
            
            // Log search for analytics (demo purposes)
            console.log(`Search submitted - Term: "${searchTerm}", Type: ${searchType}`);
            
            // You could add AJAX search here if needed
            // For now, let the form submit naturally
        });
    }
}

// ===== PROFILE DROPDOWN =====

function initializeProfileDropdown() {
    const profileBtn = document.getElementById('profileBtn');
    const profileDropdown = document.getElementById('profileDropdown');
    
    if (profileBtn && profileDropdown) {
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle('hidden');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
        
        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                profileDropdown.classList.add('hidden');
            }
        });
    }
}

// ===== OTHER FUNCTIONS =====

function loadWatchlistAlert() {
    const modalElement = document.getElementById('watchlist-alert-modal');
    if (!modalElement) return;
    
    modalElement.innerHTML = `
        <div class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60">
            <div class="bg-neutral-900 border border-neutral-800 rounded-lg w-full max-w-sm p-5 mx-4">
                <div class="flex items-start justify-between mb-3">
                    <h3 class="text-lg font-semibold">Anda belum login</h3>
                    <button id="watchlistCloseX" class="text-neutral-400 hover:text-white">&times;</button>
                </div>
                <p class="text-sm text-neutral-400 mb-4">Untuk melihat Watchlist, silakan daftar terlebih dahulu.</p>
                <div class="flex gap-2">
                    <a href="login.html" class="flex-1 px-3 py-2 rounded bg-green-500 text-black font-semibold hover:opacity-95 text-center">
                        Sign up
                    </a>
                    <button id="watchlistCancel" class="flex-1 px-3 py-2 rounded border border-neutral-700 text-neutral-200 hover:bg-neutral-800">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    `;
    
    // Initialize watchlist alert functionality
    initializeWatchlistAlert();
}

function initializeWatchlistAlert() {
    const watchlistAlert = document.querySelector('#watchlist-alert-modal > div');
    const watchlistCloseX = document.getElementById('watchlistCloseX');
    const watchlistCancel = document.getElementById('watchlistCancel');
    
    if (watchlistAlert) {
        // Show alert when clicking watchlist buttons
        const watchlistButtons = document.querySelectorAll('.watchlist-btn');
        watchlistButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                watchlistAlert.classList.remove('hidden');
                watchlistAlert.classList.add('flex');
            });
        });
    }
    
    if (watchlistCloseX) {
        watchlistCloseX.addEventListener('click', () => {
            const alert = document.querySelector('#watchlist-alert-modal > div');
            alert.classList.add('hidden');
            alert.classList.remove('flex');
        });
    }
    
    if (watchlistCancel) {
        watchlistCancel.addEventListener('click', () => {
            const alert = document.querySelector('#watchlist-alert-modal > div');
            alert.classList.add('hidden');
            alert.classList.remove('flex');
        });
    }
}

function initializeBackToTop() {
    // Create back to top button
    const backToTopBtn = document.createElement('button');
    backToTopBtn.id = 'backToTop';
    backToTopBtn.className = 'hidden fixed bottom-6 right-6 z-40 bg-green-500 text-black p-3 rounded-full shadow-lg hover:scale-105 transition';
    backToTopBtn.innerHTML = '↑';
    backToTopBtn.setAttribute('aria-label', 'Back to top');
    document.body.appendChild(backToTopBtn);
    
    function handleScroll() {
        if (window.scrollY > 300) {
            backToTopBtn.classList.remove('hidden');
        } else {
            backToTopBtn.classList.add('hidden');
        }
    }
    
    window.addEventListener('scroll', handleScroll);
    handleScroll();
    
    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

function initializeCurrentYear() {
    const yearElements = document.querySelectorAll('#currentYear');
    const currentYear = new Date().getFullYear();
    
    yearElements.forEach(element => {
        element.textContent = currentYear;
    });
}

function initializeSearch() {
    // Initialize search input auto-focus on certain pages
    const searchInput = document.getElementById('searchInput');
    if (searchInput && window.location.pathname.includes('search.html')) {
        searchInput.focus();
        
        // Populate search input with URL parameter if exists
        const urlParams = new URLSearchParams(window.location.search);
        const searchQuery = urlParams.get('q');
        if (searchQuery) {
            searchInput.value = decodeURIComponent(searchQuery);
        }
    }
}

// ===== NOTIFICATION HELPER =====

function showNotification(message) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 bg-[#0f0f0f] border border-neutral-800 text-white px-4 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-y-[-20px] opacity-0';
    notification.textContent = message;
    notification.style.maxWidth = '300px';
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateY(0)';
        notification.style.opacity = '1';
    }, 10);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateY(-20px)';
        notification.style.opacity = '0';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// ===== EXPORT FUNCTIONS =====

window.Common = {
    loadHeader,
    loadFooter,
    loadWatchlistAlert,
    initializeProfileDropdown,
    initializeBackToTop,
    initializeCurrentYear,
    initializeSearch,
    initializeSearchFilters,
    showNotification
};