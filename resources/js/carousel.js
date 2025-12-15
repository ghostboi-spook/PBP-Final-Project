// ===== CAROUSEL FUNCTIONALITY =====

document.addEventListener('DOMContentLoaded', function() {
    // Initialize main hero carousel
    initializeMainCarousel();
    
    // Initialize celebrities carousel
    initializeCelebritiesCarousel();
    
    // Initialize movie cards watchlist buttons
    if (typeof Common !== 'undefined' && Common.initializeWatchlistButtons) {
        Common.initializeWatchlistButtons();
    }
});

// ===== MAIN HERO CAROUSEL =====

function initializeMainCarousel() {
    const carouselWrapper = document.getElementById('carousel-wrapper');
    if (!carouselWrapper) return;
    
    // Carousel data
    const carouselData = [
        {
            image: 'https://images.unsplash.com/photo-1535016120720-40c646be5580?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
            title: 'Pengabdi Setan',
            description: 'Sebuah keluarga menghadapi teror dari masa lalu yang kelam'
        },
        {
            image: 'https://images.unsplash.com/photo-1518709268805-4e9042af2176?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1468&q=80',
            title: 'Dilan 1990',
            description: 'Kisah cinta remaja di tahun 90-an yang penuh kenangan'
        },
        {
            image: 'https://images.unsplash.com/photo-1518709268805-4e9042af2176?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1468&q=80',
            title: 'KKN di Desa Penari',
            description: 'Terror mistis mengintai sekelompok mahasiswa KKN'
        }
    ];
    
    // Recommendations data
    const recommendationsData = [
        {
            image: 'https://images.unsplash.com/photo-1536323760109-ca8c07450053?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1467&q=80',
            title: 'The Hunger Games: Sunrise on the Reaping'
        },
        {
            image: 'https://images.unsplash.com/photo-1519681393784-d120267933ba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
            title: 'Wicked Hidden Gems'
        },
        {
            image: 'https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80',
            title: 'Stranger Things Cast Q&A'
        }
    ];
    
    // Render carousel
    renderCarousel(carouselData, carouselWrapper);
    
    // Render recommendations
    renderRecommendations(recommendationsData);
}

function renderCarousel(data, wrapper) {
    let carouselHTML = '';
    let dotsHTML = '';
    
    data.forEach((item, index) => {
        carouselHTML += `
            <div class="carousel-item ${index === 0 ? 'active' : ''}">
                <img 
                    src="${item.image}"
                    class="carousel-image"
                    alt="${item.title}"
                >
                <div class="carousel-overlay">
                    <h2 class="text-2xl font-bold mb-2">${item.title}</h2>
                    <p class="text-neutral-300">${item.description}</p>
                </div>
            </div>
        `;
        
        dotsHTML += `
            <div class="carousel-dot ${index === 0 ? 'active' : ''}" data-index="${index}"></div>
        `;
    });
    
    wrapper.innerHTML = `
        ${carouselHTML}
        <button id="prevBtn" class="carousel-nav-button carousel-nav-prev">
            ❮
        </button>
        <button id="nextBtn" class="carousel-nav-button carousel-nav-next">
            ❯
        </button>
        <div class="carousel-dots">
            ${dotsHTML}
        </div>
    `;
    
    // Initialize carousel controls
    initializeCarouselControls();
}

function renderRecommendations(data) {
    const recommendationsContainer = document.getElementById('recommendations');
    if (!recommendationsContainer) return;
    
    let recommendationsHTML = '';
    
    data.forEach(item => {
        recommendationsHTML += `
            <div class="flex gap-4 items-center bg-neutral-900 p-4 rounded-lg border border-neutral-800 hover:bg-neutral-800 transition cursor-pointer">
                <div class="w-20 h-28 rounded overflow-hidden flex-none">
                    <img src="${item.image}" alt="${item.title}" class="w-full h-full object-cover" />
                </div>
                <div class="flex-1 text-center">
                    <h3 class="font-semibold">${item.title}</h3>
                </div>
            </div>
        `;
    });
    
    recommendationsContainer.innerHTML = recommendationsHTML;
}

function initializeCarouselControls() {
    const carouselItems = document.querySelectorAll('.carousel-item');
    const dots = document.querySelectorAll('.carousel-dot');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    if (carouselItems.length === 0) return;
    
    let currentIndex = 0;
    let autoSlideInterval;
    
    function showSlide(index) {
        carouselItems.forEach(item => item.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        carouselItems[index].classList.add('active');
        dots[index].classList.add('active');
        
        currentIndex = index;
    }
    
    function nextSlide() {
        let nextIndex = (currentIndex + 1) % carouselItems.length;
        showSlide(nextIndex);
    }
    
    function prevSlide() {
        let prevIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
        showSlide(prevIndex);
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetAutoSlide();
        });
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetAutoSlide();
        });
    }
    
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
            resetAutoSlide();
        });
    });
    
    function startAutoSlide() {
        autoSlideInterval = setInterval(nextSlide, 5000);
    }
    
    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }
    
    const carouselWrapper = document.getElementById('carousel-wrapper');
    if (carouselWrapper) {
        carouselWrapper.addEventListener('mouseenter', () => {
            clearInterval(autoSlideInterval);
        });
        
        carouselWrapper.addEventListener('mouseleave', () => {
            startAutoSlide();
        });
    }
    
    startAutoSlide();
}

// ===== CELEBRITIES CAROUSEL =====

function initializeCelebritiesCarousel() {
    const celebritiesContainer = document.getElementById('celebrities-carousel');
    if (!celebritiesContainer) return;
    
    const celebritiesData = [
        {
            image: 'https://i.imgur.com/ZpC4Ccx.jpeg',
            rank: '14 (▲ 9,210)',
            name: 'Catherine Laga\'aia'
        },
        {
            image: 'https://i.imgur.com/1B5AjQ6.jpeg',
            rank: '42 (▲ 7,918)',
            name: 'Tom Wozniczka'
        },
        {
            image: 'https://i.imgur.com/6oG5mXZ.jpeg',
            rank: '15 (▲ 5,210)',
            name: 'Claire Danes'
        },
        {
            image: 'https://i.imgur.com/7CiQnBM.jpeg',
            rank: '25 (▲ 4,918)',
            name: 'Matthew Rhys'
        },
        {
            image: 'https://i.imgur.com/8KxqLDT.jpeg',
            rank: '30 (▼ 2)',
            name: 'Jacob Elordi'
        },
        {
            image: 'https://i.imgur.com/Vn4u0FK.jpeg',
            rank: '35 (▼ 2)',
            name: 'Mia Goth'
        }
    ];
    
    renderCelebritiesCarousel(celebritiesData);
    
    // Featured Today section
    renderFeaturedToday();
}

function renderCelebritiesCarousel(data) {
    const celebritiesContainer = document.getElementById('celebrities-carousel');
    
    let celebritiesHTML = `
        <div class="flex items-center gap-3 mb-4">
            <span class="text-2xl font-bold">Most popular celebrities</span>
            <span class="text-yellow-300 text-3xl">›</span>
        </div>
        <h2 class="text-yellow-400 font-semibold mb-2">TOP RISING</h2>
        <div class="relative mb-8">
            <button id="btnPrev" class="horizontal-carousel-nav horizontal-carousel-nav-prev">
                ‹
            </button>
            <div id="celebritiesCarousel" class="horizontal-carousel">
    `;
    
    data.forEach(celebrity => {
        celebritiesHTML += `
            <div class="horizontal-carousel-item">
                <img src="${celebrity.image}" class="w-40 h-40 rounded-full object-cover" alt="${celebrity.name}" />
                <p class="mt-2">${celebrity.rank}</p>
                <p class="font-semibold">${celebrity.name}</p>
            </div>
        `;
    });
    
    celebritiesHTML += `
            </div>
            <button id="btnNext" class="horizontal-carousel-nav horizontal-carousel-nav-next">
                ›
            </button>
        </div>
    `;
    
    celebritiesContainer.innerHTML = celebritiesHTML;
    
    // Initialize celebrities carousel controls
    initializeCelebritiesControls();
}

function initializeCelebritiesControls() {
    const carousel = document.getElementById("celebritiesCarousel");
    const btnPrev = document.getElementById("btnPrev");
    const btnNext = document.getElementById("btnNext");

    if (carousel && btnPrev && btnNext) {
        const scrollAmount = 300;

        btnNext.addEventListener("click", () => {
            carousel.scrollBy({ left: scrollAmount, behavior: "smooth" });
        });

        btnPrev.addEventListener("click", () => {
            carousel.scrollBy({ left: -scrollAmount, behavior: "smooth" });
        });
    }
}

// ===== FEATURED TODAY =====

function renderFeaturedToday() {
    const featuredContainer = document.getElementById('featured-today');
    if (!featuredContainer) return;
    
    const featuredData = [
        {
            title: 'FILM TERBARU',
            heading: 'Dilan 1991',
            description: 'Kisah cinta Dilan dan Milea berlanjut di tahun 1991'
        },
        {
            title: 'SERIES TERBARU',
            heading: 'Tira',
            description: 'Serial drama keluarga yang penuh dengan intrik'
        },
        {
            title: 'ANIMASI TERBARU',
            heading: 'Adit Sopo Jarwo',
            description: 'Petualangan seru Adit, Sopo dan Jarwo'
        }
    ];
    
    let featuredHTML = `
        <h2 class="text-2xl font-bold mb-6 text-green-400 text-center">Feature Today</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    `;
    
    featuredData.forEach(item => {
        featuredHTML += `
            <div class="bg-neutral-900 rounded-lg overflow-hidden border border-neutral-800 hover:border-green-400 transition cursor-pointer">
                <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-700 flex items-center justify-center">
                    <span class="text-white font-bold text-xl">${item.title}</span>
                </div>
                <div class="p-4 text-center">
                    <h3 class="font-semibold mb-2">${item.heading}</h3>
                    <p class="text-sm text-neutral-400">${item.description}</p>
                </div>
            </div>
        `;
    });
    
    featuredHTML += '</div>';
    
    featuredContainer.innerHTML = featuredHTML;
}

// ===== TOP MOVIES =====

function renderTopMovies() {
    const moviesContainer = document.getElementById('movies-grid');
    if (!moviesContainer) return;
    
    const moviesData = [
        {
            rank: 1,
            image: 'https://m.media-amazon.com/images/M/MV5BNTllYTRhZjMtYmMxNi00NGYyLWE3MGEtNjk3ZjU3ZDVmZmQzXkEyXkFqcGc@._V1_.jpg',
            rating: 7.5,
            title: 'Frankenstein'
        },
        {
            rank: 2,
            image: 'https://m.media-amazon.com/images/M/MV5BNjU4Y2ZmMjEtZGZhNi00MWUxLTkwZmEtYjIxMjM3NzdjNGFjXkEyXkFqcGc@._V1_.jpg',
            rating: 8.2,
            title: 'Interstellar'
        },
        {
            rank: 3,
            image: 'https://m.media-amazon.com/images/M/MV5BMTc5MDE2ODcwNV5BMl5BanBnXkFtZTgwMzI2NzQ2NzM@._V1_.jpg',
            rating: 8.4,
            title: 'Avengers: Endgame'
        },
        {
            rank: 4,
            image: 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_.jpg',
            rating: 8.8,
            title: 'Inception'
        },
        {
            rank: 5,
            image: 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_.jpg',
            rating: 9.0,
            title: 'The Dark Knight'
        }
    ];
    
    let moviesHTML = '';
    
    moviesData.forEach(movie => {
        moviesHTML += `
            <div class="movie-card">
                <div class="relative">
                    <img src="${movie.image}"
                        class="movie-card-image"
                        alt="${movie.title} Poster">
                    <div class="movie-card-rank">
                        <span class="text-white font-bold text-xl">${movie.rank}</span>
                    </div>
                </div>
                <div class="movie-card-content">
                    <div class="movie-card-rating">
                        <span class="text-yellow-400 text-xl">★</span>
                        <span class="text-white text-sm">${movie.rating}</span>
                    </div>
                    <h3 class="movie-card-title">${movie.title}</h3>
                    <button class="movie-card-button watchlist watchlist-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 5v14m-7-7h14"/>
                        </svg>
                        <span class="watchlist-text">Watchlist</span>
                    </button>
                    <button class="movie-card-button trailer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        Trailer
                    </button>
                </div>
            </div>
        `;
    });
    
    moviesContainer.innerHTML = moviesHTML;
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    renderTopMovies();
});

// Export functions for use in other modules
window.Carousel = {
    initializeMainCarousel,
    initializeCelebritiesCarousel,
    renderTopMovies,
    renderFeaturedToday
};