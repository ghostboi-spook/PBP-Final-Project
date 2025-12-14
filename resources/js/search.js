// ===== SEARCH PAGE FUNCTIONALITY =====

document.addEventListener('DOMContentLoaded', function() {
    // Initialize search functionality
    initializeSearchResults();
    
    // Load URL parameters
    loadSearchQuery();
    
    // Initialize review modal
    initializeReviewModal();
});

// ===== SEARCH DATA =====

const searchResultsData = {
    titles: [
        {
            id: 1,
            title: "Zootopia 2",
            year: 2025,
            duration: "1h 48m",
            rating: 7.7,
            votes: "12K",
            description: "Officers Judy Hopps and Nick Wilde return for another adventure in the animal metropolis, uncovering a conspiracy that threatens to unravel the delicate peace between predator and prey.",
            poster: "https://lumiere-a.akamaihd.net/v1/images/p_zootopia2_24631_7c37a1ce.jpeg",
            genres: ["Animation", "Adventure", "Comedy"],
            directors: ["Jared Bush", "Byron Howard"],
            stars: ["Ginnifer Goodwin", "Jason Bateman", "Ke Huy Quan", "Idris Elba"]
        },
        {
            id: 2,
            title: "Zootopia",
            year: 2016,
            duration: "1h 48m",
            rating: 8.0,
            votes: "601K",
            description: "In a city of anthropomorphic animals, a rookie bunny cop and a cynical con artist fox must work together to uncover a conspiracy.",
            poster: "https://lumiere-a.akamaihd.net/v1/images/p_zootopia_18529_8b7c0ce3.jpeg",
            genres: ["Animation", "Adventure", "Comedy", "Crime"],
            directors: ["Byron Howard", "Rich Moore"],
            stars: ["Ginnifer Goodwin", "Jason Bateman", "Idris Elba", "Jenny Slate"]
        },
        {
            id: 3,
            title: "Zoo",
            year: 2018,
            duration: "1h 36m",
            rating: 5.2,
            votes: "23K",
            description: "A zookeeper fights to save the animals in his care when a mysterious virus spreads through the city, turning animals against humans.",
            poster: "https://images.unsplash.com/photo-1546182990-dffeafbe841d?auto=format&fit=crop&w=400&q=80",
            genres: ["Thriller", "Action", "Drama"],
            directors: ["Colin McIvor"],
            stars: ["Art Parkinson", "Penelope Wilton", "Toby Jones", "Ian McElhinney"]
        }
    ],
    people: [
        {
            id: 1,
            name: "Zooey Deschanel",
            role: "Actress · Producer · Music Department",
            knownFor: "New Girl (2011–2018)",
            avatar: "https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?auto=format&fit=crop&w=200&q=80"
        },
        {
            id: 2,
            name: "James Franco",
            role: "Actor · Director · Producer",
            knownFor: "127 Hours (2010), Spider-Man (2002)",
            avatar: "https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=200&q=80"
        }
    ]
};

// ===== INITIALIZE SEARCH =====

function initializeSearchResults() {
    // Load titles
    renderSearchResults();
    
    // Load people
    renderPeopleResults();
}

function loadSearchQuery() {
    const searchTitle = document.getElementById('search-query');
    const resultCount = document.getElementById('result-count');
    
    if (!searchTitle) return;
    
    // Get query parameters from URL
    const urlParams = new URLSearchParams(window.location.search);
    const query = urlParams.get('q') || 'zoo';
    const filter = urlParams.get('filter') || 'all';
    
    // Update search title
    searchTitle.textContent = `Search "${query}"`;
    
    // Update result count
    if (resultCount) {
        resultCount.textContent = searchResultsData.titles.length + searchResultsData.people.length;
    }
    
    // Update search input if it exists
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.value = query;
    }
    
    // Update filter label if it exists
    const filterLabel = document.getElementById('filterLabel');
    if (filterLabel) {
        const filterText = getFilterText(filter);
        filterLabel.textContent = filterText;
    }
}

function getFilterText(filterValue) {
    const filterMap = {
        'all': 'All',
        'movie': 'Movie',
        'series': 'Series',
        'actor': 'Actor',
        'sutradara': 'Sutradara'
    };
    
    return filterMap[filterValue] || 'All';
}

// ===== RENDER SEARCH RESULTS =====

function renderSearchResults() {
    const searchResultsContainer = document.getElementById('search-results');
    if (!searchResultsContainer) return;
    
    let resultsHTML = '';
    
    if (searchResultsData.titles.length === 0) {
        resultsHTML = `
            <div class="no-results">
                <div class="no-results-icon">🔍</div>
                <div class="no-results-title">No movies found</div>
                <div class="no-results-text">Try adjusting your search or filter to find what you're looking for</div>
            </div>
        `;
    } else {
        searchResultsData.titles.forEach(item => {
            // Create genres string
            const genresString = item.genres.slice(0, 3).join(' · ');
            
            // Create director string
            const directorString = item.directors.slice(0, 2).join(', ');
            
            // Create stars string
            const starsString = item.stars.slice(0, 3).join(', ');
            
            resultsHTML += `
                <div class="search-movie-card" data-id="${item.id}">
                    <div class="card-content">
                        <div class="flex-container">
                            <!-- Poster -->
                            <div class="poster-container">
                                <img src="${item.poster}" 
                                     alt="${item.title} poster" 
                                     class="poster-image"
                                     onclick="showMovieDetails(${item.id})">
                            </div>
                            
                            <!-- Movie Info -->
                            <div class="movie-info">
                                <div class="movie-header">
                                    <div>
                                        <h3 class="movie-title" onclick="showMovieDetails(${item.id})">
                                            ${item.title} <span class="text-neutral-400 font-normal">(${item.year})</span>
                                        </h3>
                                        <div class="movie-meta">
                                            <span>${item.duration}</span>
                                            <span class="px-2 py-0.5 bg-neutral-800 rounded-full text-neutral-300 text-xs">SU</span>
                                            <span class="text-neutral-400">${genresString}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="movie-rating-section">
                                        <div class="movie-rating">
                                            <span class="rating-star">★</span>
                                            <span class="font-semibold">${item.rating}</span>
                                            <span class="text-xs text-neutral-400">(${item.votes})</span>
                                        </div>
                                        
                                        <!-- Rating actions under rating -->
                                        <div class="rating-actions">
                                            <button class="rate-action" onclick="openReviewModal(${item.id})">
                                                Rate
                                            </button>
                                            <button class="watch-action" onclick="markAsWatched(${item.id})">
                                                Mark as watched
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <p class="movie-description">
                                    ${item.description}
                                </p>
                                
                                <div class="movie-details">
                                    <div>
                                        <strong>Director:</strong>
                                        <span class="ml-2">${directorString}</span>
                                    </div>
                                    <div>
                                        <strong>Stars:</strong>
                                        <span class="ml-2">${starsString}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
    }
    
    searchResultsContainer.innerHTML = resultsHTML;
}

function renderPeopleResults() {
    const peopleResultsContainer = document.getElementById('people-results');
    if (!peopleResultsContainer) return;
    
    let peopleHTML = '';
    
    if (searchResultsData.people.length === 0) {
        peopleHTML = `
            <div class="no-results">
                <div class="no-results-icon">👤</div>
                <div class="no-results-title">No people found</div>
                <div class="no-results-text">Try a different search term</div>
            </div>
        `;
    } else {
        searchResultsData.people.forEach(person => {
            peopleHTML += `
                <div class="person-card" data-person-id="${person.id}">
                    <img src="${person.avatar}" 
                         alt="${person.name}" 
                         class="person-avatar">
                    <div class="person-info">
                        <h4 class="person-name">${person.name}</h4>
                        <div class="person-role">${person.role}</div>
                        <div class="person-known">${person.knownFor}</div>
                    </div>
                    <div class="person-actions">
                        <button class="follow-btn" onclick="followPerson(${person.id})">
                            Follow
                        </button>
                    </div>
                </div>
            `;
        });
    }
    
    peopleResultsContainer.innerHTML = peopleHTML;
}

// ===== REVIEW MODAL FUNCTIONALITY =====

function initializeReviewModal() {
    const reviewModal = document.getElementById('reviewModal');
    const closeReviewModal = document.getElementById('closeReviewModal');
    const cancelReview = document.getElementById('cancelReview');
    const reviewForm = document.getElementById('reviewForm');
    const ratingStars = document.querySelectorAll('.rating-star');
    const ratingValue = document.getElementById('ratingValue');
    const selectedRating = document.getElementById('selectedRating');

    let currentMovieId = null;

    // Open modal
    window.openReviewModal = function(movieId) {
        currentMovieId = movieId;
        const movie = searchResultsData.titles.find(m => m.id === movieId);
        
        if (movie) {
            reviewModal.classList.remove('hidden');
            reviewModal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            
            // Set movie title in form if available
            const reviewTitleInput = document.getElementById('reviewTitle');
            if (reviewTitleInput && !reviewTitleInput.value) {
                reviewTitleInput.value = `Review of ${movie.title}`;
            }
        }
    };

    // Close modal
    function closeReviewModalFunc() {
        reviewModal.classList.add('hidden');
        reviewModal.classList.remove('flex');
        document.body.style.overflow = '';
        resetReviewForm();
    }

    if (closeReviewModal) {
        closeReviewModal.addEventListener('click', closeReviewModalFunc);
    }

    if (cancelReview) {
        cancelReview.addEventListener('click', closeReviewModalFunc);
    }

    // Close modal on outside click
    reviewModal.addEventListener('click', (e) => {
        if (e.target === reviewModal) {
            closeReviewModalFunc();
        }
    });

    // Rating stars functionality
    if (ratingStars) {
        ratingStars.forEach(star => {
            star.addEventListener('click', () => {
                const value = parseInt(star.getAttribute('data-value'));
                selectedRating.value = value;
                ratingValue.textContent = `${value}/10`;
                
                // Update star display
                ratingStars.forEach(s => {
                    if (parseInt(s.getAttribute('data-value')) <= value) {
                        s.textContent = '★';
                        s.classList.add('active');
                        s.style.color = '#f5c518';
                    } else {
                        s.textContent = '☆';
                        s.classList.remove('active');
                        s.style.color = '';
                    }
                });
            });
            
            // Add hover effect
            star.addEventListener('mouseover', () => {
                const value = parseInt(star.getAttribute('data-value'));
                ratingStars.forEach(s => {
                    if (parseInt(s.getAttribute('data-value')) <= value) {
                        s.style.color = '#f5c518';
                    }
                });
            });
            
            star.addEventListener('mouseout', () => {
                const currentValue = parseInt(selectedRating.value);
                ratingStars.forEach(s => {
                    const starValue = parseInt(s.getAttribute('data-value'));
                    if (starValue > currentValue) {
                        s.style.color = '';
                    } else if (currentValue > 0) {
                        s.style.color = '#f5c518';
                    }
                });
            });
        });
    }

    // Review form submission
    if (reviewForm) {
        reviewForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const rating = selectedRating.value;
            const title = document.getElementById('reviewTitle').value;
            const content = document.getElementById('reviewContent').value;
            const movie = searchResultsData.titles.find(m => m.id === currentMovieId);
            
            if (!movie) {
                showNotification('Movie not found');
                return;
            }
            
            if (rating === '0') {
                showNotification('Please select a rating');
                return;
            }
            
            if (!title.trim()) {
                showNotification('Please enter a review title');
                return;
            }
            
            if (!content.trim()) {
                showNotification('Please enter your review content');
                return;
            }
            
            // Simulate API call
            showNotification(`Review submitted for "${movie.title}"! Rating: ${rating}/10`);
            
            // Update the movie's rating (demo only)
            const currentRating = parseFloat(movie.rating);
            const currentVotes = parseInt(movie.votes.replace('K', '') * 1000) || 12000;
            
            // Calculate new average (simplified)
            const newVotes = currentVotes + 1;
            const newRating = ((currentRating * currentVotes) + parseInt(rating)) / newVotes;
            
            // Update display
            movie.rating = newRating.toFixed(1);
            movie.votes = newVotes > 1000 ? `${(newVotes/1000).toFixed(1)}K` : newVotes.toString();
            
            // Update the card
            updateMovieRating(currentMovieId, movie.rating, movie.votes);
            
            // Close modal
            closeReviewModalFunc();
        });
    }

    function resetReviewForm() {
        if (reviewForm) reviewForm.reset();
        if (selectedRating) selectedRating.value = '0';
        if (ratingValue) ratingValue.textContent = 'Select rating';
        if (ratingStars) {
            ratingStars.forEach(star => {
                star.textContent = '☆';
                star.classList.remove('active');
                star.style.color = '';
            });
        }
    }

    function updateMovieRating(movieId, newRating, newVotes) {
        const movieCard = document.querySelector(`.search-movie-card[data-id="${movieId}"]`);
        if (movieCard) {
            const ratingElement = movieCard.querySelector('.movie-rating .font-semibold');
            const votesElement = movieCard.querySelector('.movie-rating .text-neutral-400');
            
            if (ratingElement) {
                ratingElement.textContent = newRating;
            }
            
            if (votesElement) {
                votesElement.textContent = `(${newVotes})`;
            }
        }
    }
}

// ===== SEARCH ACTIONS =====

function markAsWatched(itemId) {
    const item = searchResultsData.titles.find(i => i.id === itemId);
    if (!item) return;
    
    showNotification(`"${item.title}" marked as watched`);
}

function showMovieDetails(itemId) {
    const item = searchResultsData.titles.find(i => i.id === itemId);
    if (!item) return;
    
    // In a real app, this would redirect to the movie page
    showNotification(`Opening details for "${item.title}"...`);
    
    // For demo, redirect to konten.html
    setTimeout(() => {
        window.location.href = 'konten.html';
    }, 500);
}

function followPerson(personId) {
    const person = searchResultsData.people.find(p => p.id === personId);
    if (!person) return;
    
    showNotification(`Started following ${person.name}`);
}

// ===== HELPER FUNCTIONS =====

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

// Export functions for use in other modules
window.Search = {
    initializeSearchResults,
    loadSearchQuery,
    markAsWatched,
    showMovieDetails,
    followPerson
};